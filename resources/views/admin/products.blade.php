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

<div class="accordion" id="accordionEdit">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Изменить товар
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionEdit">
      <div class="accordion-body">
        <form method="post" action="{{route('adminEditProduct')}}" enctype="multipart/form-data">
            @csrf
            <select class="form-control mb-2" name='product_id'>
                <option disabled selected>--Выберите товар--</option>
                @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
            </select>
            Если оставить поле пустым, оно не будет обновлено
            <input class="form-control mb-2" name='newName' placeholder="Новое наименование товара">
            <textarea class="form-control mb-2" name='newDescription' placeholder="Новое описание товара"></textarea>
            <input class="form-control mb-2" name='newPrice' placeholder="Новая цена товара">
            <select class="form-control mb-2" name='newCategory_id'>
                <option disabled selected>--Выберите новую категорию--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <label class="form-label">Новое изображение для товара</label>
            <input type="file" name="newPicture" class="form-control mb-2">
            <button class="btn btn-success" type="submit">Изменить</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="accordionFilesActions">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Загрузка/Выгрузка через файл
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFilesActions">
      <div class="accordion-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Выгрузка</td>
                    <td>Загрузка</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form method="post" action="{{route('exportProducts')}}">
                            @csrf
                            <button type="submit" class="btn btn-link">Выгрузить продукты</button>
                            <br>Файл выгрузки будет доступен <br> на сервере по пути .\exportProducts.csv
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('importProducts')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control mb-2">
                            <button type="submit" class="btn btn-link">Загрузить продукты</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
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