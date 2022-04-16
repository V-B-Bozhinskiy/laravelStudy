<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function info() {
        $cart = json_decode(request('products'), true);
        //dd($cart);

        $products = Product::whereIn('id', array_keys($cart))
            ->get()
            ->transform(function ($product) use ($cart){
                $product->quantity = $cart[$product->id];
                return $product;
            });

        $user = Auth::user();
        $address = $user ? $user->addresses()->where('main', 1)->first()->address ?? '' : '';
        
        return [
            'products' => $products,
            'user' => $user,
            'address' => $address
        ];
    }

    public function productsQuantity(){
        return array_sum(session('cart') ?? []);
    }

    public function removeFromCart () {
        $productId = request('id');
        $cart = session('cart') ?? [];
        
        if (!isset($cart[$productId]))
        return 0;
        //return back();

        $quantity = $cart[$productId];
        if ($quantity > 1){
            $cart[$productId] = --$quantity;
        } else {
            unset($cart[$productId]);
        }

        session()->put('cart',$cart);
        return [
            'productQuantity'=> $cart[$productId] ?? 0,
            'cartProductsQuantity' => array_sum($cart)
        ];
        //return $cart[$productId] ?? 0;
        //return back();
    }

    public function addToCart () {
        $productId = request('id');
        $cart = session('cart') ?? [];

        if (isset($cart[$productId])){
            $cart[$productId] = ++$cart[$productId];
        } else {
            $cart[$productId] = 1;
        }

        session()->put('cart',$cart);
        return [
            'productQuantity'=> $cart[$productId] ?? 0,
            'cartProductsQuantity' => array_sum($cart)
        ];
        //return $cart[$productId];
        //return back();
    }

    public function createOrder(){
        //sleep(1);
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required'
            //'register_confirmation' => 'accepted'
        ]);
        //try{
        DB::transaction(function () {
            $user = Auth::user();
                $password = '';
                if (!$user){
                    $password = Str::random(8);
                    $user = User::create([
                        'name' => request('name'),
                        'email' => request('email'),
                        'password' => Hash::make($password)
                    ]);

                    $address = Address::create([
                        'user_id' => $user->id,
                        'address' => request('address'),
                        'main' => 1
                    ]);

                    Auth::loginUsingId($user->id);
                }

                $address = $user->getMainAddress();
                    
                    $cart = request('products');//session('cart');
                    
                    $order = Order::create([
                        'user_id' => $user->id,
                        'address_id' => $address->id
                    ]);

                    foreach ($cart as $id => $quantity){
                        $product = Product::find($id);
                        $order->products()->attach($product, [
                            'quantity' => $quantity,
                            'price' => $product->price
                        ]);
                    }

                //Подготовка письма.
                $data = [
                    'products' => $order->products,
                    'name' => $user->name
                ];
                if ($password){
                    $data['password'] = $password;
                }
                Mail::to($user->email)->send(new OrderCreated($data));
        });
        session()->forget('cart');
        $user = Auth::user();
        //session()->flash('orderCreatedSuccess');
        //return back();
        return $user->id;
        //} catch (Exception $e) {
            //dd($e);
        //    return back();
            //return false;        
        //}   
    }

    public function retryOrder(){
        $orderId = request('id');
        $order = Order::find($orderId);
        foreach ( $order->products as $product){
            for ($i = 0; $i < $product->pivot->quantity; $i++){
                //! Почти дублирует addToCart() кроме передачи productId
                $productId = $product->id;
                $cart = session('cart') ?? [];

                if (isset($cart[$productId])){
                    $cart[$productId] = ++$cart[$productId];
                } else {
                    $cart[$productId] = 1;
                }

                session()->put('cart',$cart);
                //!
            }
        }
        return redirect()->route('cart');
    }

}
