@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('content')
<h1>
    Список категорий
</h1>

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