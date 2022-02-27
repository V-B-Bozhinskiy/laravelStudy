@extends('layouts.app')

@section('styles')
<style>
    .product-buttons {
        display: flex;
        justify-content: space-evenly;
        line-height: 37px;
    }
</style>
@endsection

@section('content')
<!--
@if (session('orderCreatedSuccess'))
<div class="alert alert-success">
    Заказ успешно создан.
</div>
@endif

@if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }} 
                @if (!$loop->last) <br> @endif
            @endforeach
        </div>
@endif
-->
    <cart-component 
        :prods="{{$products}}"
        @if($user)
        :user="{{$user}}"
        @endif
        address="{{$address}}"
    >
    </cart-component>
    <!--
    @if ($products)
    <form method="post" action="{{ route('createOrder') }}">
        @csrf
        <input placeholder="Имя" class="form-control mb-2" name="name" value="{{ $user->name ?? ''}}">
        <input placeholder="email" class="form-control mb-2" name="email" value="{{ $user->email ?? ''}}">
        <input placeholder="Адрес" class="form-control mb-2" name="address" value="{{ $address }}">
        <h5>Оформляя заказ нажимая на кнопку "Оформить заказ", вы даете согласие на обработку своих персональных данных согласно <a href="TEST">документам и соглашениям по обработке персональных данных</a> и даёте своё согласие на автоматическую регистрацию себя как пользователя нашего интернет-магазина по предоставленным данным.</h5>
        <button type="submit" class="btn btn-success">Оформить заказ</button>
    </form>
    @endif
    -->
@endsection