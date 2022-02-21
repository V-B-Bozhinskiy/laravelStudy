@extends('layouts.app')

@section('content')

<categories-component 
    :categories="{{$categories}}" 
    route-category="{{route('category', '')}}"
    page-title='Список категорий!' 
    test='test'>
</categories-component> <!-- переменные для передачи нельзя указывать в camelCase нужно использовать kebab-case, но в самом компоненте они будут доступны по camelCase! -->

<div class="container">
<!--
@auth
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
@endauth

  <div class="row">
    @foreach ($categories as $category)
    <div class="card col-4">
    <img src="{{asset('storage')}}/{{$category->picture}}" class="card-img-top" alt="{{$category->name}}">
        <div class="card-body">
            <h5 class="card-title">
                {{$category->name}}
            </h5>
            <p class="card-text">
                {{$category->description}}
            </p>
            <a href="{{ route('category', $category->id) }}" class="btn btn-primary">Перейти</a>
        </div>
    </div>
    @endforeach
  </div>
</div>
-->
@endsection
