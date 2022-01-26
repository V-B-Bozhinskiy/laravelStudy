@extends('layouts.app')

@section('styles')
    <style>
        .product-price {
            border-top: 1px solid grey;
            border-bottom: 1px solid grey;
            font-size: 23px;
            text-align: center;
            margin-bottom: 10px;
        }

        .card-text{
            height: 46px;
        }

        .card-title{
            height: 44px;
        }
        
        .product-buttons{
            display: flex;
            justify-content: space-between;
            line-height: 37px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="card col-4">
        <img src="{{asset('storage')}}/{{$product->picture}}" class="card-img-top" alt="{{$product->name}}">
            <div class="card-body">
                <h5 class="card-title">
                    {{$product->name}}
                </h5>
                <p class="card-text">
                    {{$product->description}}
                </p>
                <div class="product-price">
                    {{$product->price}} руб.
                </div>
                <div class="product-buttons">
                    <button class="btn btn-danger">-</button>
                    0
                    <button class="btn btn-success">+</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection