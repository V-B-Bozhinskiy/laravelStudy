@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('content')

@if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }} 
                @if (!$loop->last) <br> @endif
            @endforeach
        </div>
@endif

<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Добавить категорию
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form method="post" action="{{route('adminAddCategory')}}" class="mb-4" enctype="multipart/form-data">
            @csrf
            <input class="form-control mb-2" name='name' placeholder="Наименование категории">
            <textarea class="form-control mb-2" name='description' placeholder="Описание категории"></textarea>
            <label class="form-label">Изображение для категории</label>
            <input type="file" name="picture" class="form-control mb-2">
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
      </div>
    </div>
  </div>
</div>

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

<div class="container">
    <form method="post" action="{{route('importCategories')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mb-2">
        <button type="submit" class="btn btn-link">Загрузить категории</button>
    </form>
</div>

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

@endsection