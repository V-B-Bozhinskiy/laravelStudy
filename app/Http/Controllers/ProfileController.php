<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(User $user)
    {
        if (Auth::user()){
            if ( (Auth::user()->isAdmin()) || ($user->id == Auth::user()->id) ){
                return view('profile', compact('user'));
            }
        }
        return redirect()->route('home');
    }

    public function save (Request $request)
    {
        $input = request()->all();
        $name = $input['name'];
        $email = $input['email'];
        $userId = $input['userId'];
        $picture = $input['picture'] ?? null;
        $newAddress = $input['new_address'] ?? null;
        $addAsMainAddress = $input['addAsMainAddress'] ?? 0;
        $user = User::find($userId);
        // dd(request());

        request()->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            'picture' => 'mimes:jpg,bmp,webp',
            'current_password' => 'current_password|nullable',
            'password' => 'confirmed|min:8|nullable' //проверяет совпадение password_confirmation и password
       ]);

       if (isset($input['password'])){
        if ($input['current_password']){
            $user->password = Hash::make($input['password']);
            $user->save();
        }
       }
       
       if ($newAddress){
           if ($addAsMainAddress == 1){
                Address::where('user_id', $user->id)->update([
                'main' => 0
                ]);
           }
           Address::create([
               'user_id' => $user->id,
               'address' => $newAddress,
               'main' => $addAsMainAddress
           ]);
       }

       if ($picture){
           $ext = $picture->getClientOriginalExtension();
           $filename = time() . rand(10000,99999) . '.' . $ext;
           $picture->storeAs('public/users',$filename);
           $user->picture = "users/$filename";
       }

       $user->name = $name;
       $user->email = $email;
       $user->save();

       session()->flash('profileSaved');
       return back();
    }

    public function setMainAddr (Request $request)
    {
        $input = request()->all();
        $addrId = $input['addrId'];
        $userId = $input['userId'];
        $user = User::find($userId);
        Address::where('user_id', $user->id)->update([
            'main' => 0
        ]);
        Address::where('id', $addrId)->update([
            'main' => 1
        ]);
        return back();
    }
    public function deleteUserAddress (Request $request){
        $input = request()->all();
        $addrId = $input['addrId'];
        try{
            Address::find($addrId)->delete();
        } catch (Exception $e) {
            return back()->withErrors("Нельзя удалить этот адрес, так как с ним ранее уже был связан заказ!");
        }
        return back();
    }
    
    public function userOrders(User $user){
        if (Auth::user()){
            if ( (Auth::user()->isAdmin()) || ($user->id == Auth::user()->id) ){
                $orders = Order::where('user_id', $user->id)->get();
                $data = [
                    'orders' => $orders,
                    'user' => $user
                ];
                //dd($data);
                return view('orders',$data);
            }
        }
        return redirect()->route('home');
    }
}
