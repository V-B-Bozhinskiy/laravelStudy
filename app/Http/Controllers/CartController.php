<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart() {
        $cart = session('cart');
        $products = Product::whereIn('id', array_keys($cart))
            ->get()
            ->transform(function ($product) use ($cart){
                $product->quantity = $cart[$product->id];
                return $product;
            });
        return view('cart', compact('products'));
    }

    public function removeFromCart () {
        $productId = request('id');
        $cart = session('cart') ?? [];
        
        if (!isset($cart[$productId]))
        return back();

        $quantity = $cart[$productId];
        if ($quantity > 1){
            $cart[$productId] = --$quantity;
        } else {
            unset($cart[$productId]);
        }

        session()->put('cart',$cart);
        return back();
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
        return back();
    }
}
