@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('content')
<h1>
    Список категорий
</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th>Дата создания</th>
            <th>Дата изменения</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->picture }}</td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->updated_at }}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="6">
                Категорий не добавлено
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if (session('startExportCategories'))
<div class="alert alert-success">
    Выгрузка категорий запущена
</div>
@endif

<div class="container">
    <form method="post" action="{{route('exportCategories')}}">
        @csrf
        <button type="submit" class="btn btn-link">Выгрузить категории</button>
    </form>
</div>
@endsection