@extends('layouts.app')

@section('title')
    Список продуктов
@endsection

@section('content')
<h1>
    Список продуктов
</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Изображение</th>
            <th>Дата создания</th>
            <th>Дата изменения</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            @foreach ($categories as $category)
                    @if ($category->id == $product->category_id)
                        <td>{{ $category->name }} ({{$category->id}})</td>
                    @endif
            @endforeach
            <td>{{ $product->picture }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="8">
                Продуктов не добавлено
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection