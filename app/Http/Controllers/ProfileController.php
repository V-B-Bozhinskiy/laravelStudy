<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

    public function save (Request $request)
    {
        $input = request()->all();
        $name = $input['name'];
        $email = $input['email'];
        $userId = $input['userId'];
        $picture = $input['picture'] ?? null;
        $newAddress = $input['new_address'];
        $user = User::find($userId);
        // dd(request());

        request()->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            'picture' => 'mimes:jpg,bmp,webp'
       ]);
       
       if ($newAddress){
           Address::where('user_id', $user->id)->update([
                'main' => 0
           ]);
           Address::create([
               'user_id' => $user->id,
               'address' => $newAddress,
               'main' => 1
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

       return back();
    }
}
