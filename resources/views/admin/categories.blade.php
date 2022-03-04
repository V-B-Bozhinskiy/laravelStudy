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

<div class="accordion" id="accordionAddCategory">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Добавить категорию
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionAddCategory">
      <div class="accordion-body">
        <form method="post" action="{{route('adminAddCategory')}}" enctype="multipart/form-data">
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

<div class="accordion" id="accordionEditCategory">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Изменить категорию
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionAddCategory">
      <div class="accordion-body">
        <form method="post" action="{{route('adminEditCategory')}}" enctype="multipart/form-data">
            @csrf
            <select class="form-control mb-2" name='category_id'>
                <option disabled selected>--Выберите категорию--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            Если оставить поле пустым, оно не будет обновлено
            <input class="form-control mb-2" name='newName' placeholder="Новое наименование категории">
            <textarea class="form-control mb-2" name='newDescription' placeholder="Новое описание категории"></textarea>
            <label class="form-label">Новое изображение для категории</label>
            <input type="file" name="newPicture" class="form-control mb-2">
            <button class="btn btn-success" type="submit">Изменить</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="accordionFilesActions">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Загрузка/Выгрузка через файл
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFilesActions">
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
                        <form method="post" action="{{route('exportCategories')}}">
                            @csrf
                            <button type="submit" class="btn btn-info">Выгрузить категории</button>
                            <br>Файл выгрузки будет доступен <br> на сервере по пути .\exportCategories.csv
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('importCategories')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Загрузить категории</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
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

@if (session('startImportCategories'))
<div class="alert alert-success">
    Загрузка категорий запущена
</div>
@endif

@if (session('Error with App\Jobs\ImportCategoties'))
<div class="alert alert-danger">
    При загрузке категорий возникла ошибка
</div>
@endif

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
            <td>{{ $category->picture }} </td>
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