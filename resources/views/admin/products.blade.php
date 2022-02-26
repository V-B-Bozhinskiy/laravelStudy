@extends('layouts.app')

@section('title')
    Список продуктов
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
        Добавить товар
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form method="post" action="{{route('adminAddProduct')}}" enctype="multipart/form-data">
            @csrf
            <input class="form-control mb-2" name='name' placeholder="Наименование товара">
            <textarea class="form-control mb-2" name='description' placeholder="Описание товара"></textarea>
            <input class="form-control mb-2" name='price' placeholder="Цена товара">
            <select class="form-control mb-2" name='category_id'>
                <option disabled selected>--Выберите категорию--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <label class="form-label">Изображение для товара</label>
            <input type="file" name="picture" class="form-control mb-2">
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
      </div>
    </div>
  </div>
</div>

@if (session('startExportProducts'))
<div class="alert alert-success">
    Выгрузка продуктов запущена
</div>
@endif

@if (session('startImportProducts'))
<div class="alert alert-success">
    Загрузка продуктов запущена
</div>
@endif

@if (session('Error with ImportProducts'))
<div class="alert alert-danger">
    При загрузке продуктов возникла ошибка
</div>
@endif

<div class="container">
    <form method="post" action="{{route('exportProducts')}}">
        @csrf
        <button type="submit" class="btn btn-link">Выгрузить продукты</button>
    </form>
</div>

<div class="container">
    <form method="post" action="{{route('importProducts')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mb-2">
        <button type="submit" class="btn btn-link">Загрузить продукты</button>
    </form>
</div>

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