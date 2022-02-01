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
    <table class="table">
        <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @php
                $summ = 0;
            @endphp
            @forelse ($products as $idx => $product)
            @php
                $productSumm = $product->price * $product->quantity;
                $summ += $productSumm;
            @endphp
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td class="product-buttons">
                        <form method="post" action="{{ route('removeFromCart') }}">
                            @csrf
                            <input name='id' hidden value="{{ $product->id }}">
                            <button @empty($product->quantity) disabled @endempty class="btn btn-danger">-</button>
                        </form>
                        {{ $product->quantity }}
                        <form method="post" action="{{ route('addToCart') }}">
                            @csrf
                            <input name='id' hidden value="{{ $product->id }}">
                            <button class="btn btn-success">+</button>
                        </form>
                </td>
                <td>{{ $productSumm }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="5">
                        Корзина пока пустая. <a href="{{route('home')}}">В каталог</a>
                </td>
            </tr>
            @endforelse
            <tr>
                <td colspan="4" class="text-end">Итого:</td>
                <td>
                    <strong>
                    {{ $summ }}
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
@endsection