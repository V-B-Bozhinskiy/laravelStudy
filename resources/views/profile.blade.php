@extends('layouts.app')

@section('title')
 Profile
@endsection

@section('styles')
<style>
    .user-picture{
        width: 100px;
        border-radius: 100px;
        display: block;
    }
    .main-address{
        font-weight: bold;
    }
</style>
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

    <form method="post" action="{{ route('saveProfile') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $user->id }}" name='userId'>
    <div class="mb-3">
        <label class="form-label">Изображение</label>
        <image class="user-picture mb-2" src="{{asset('storage/')}}/{{$user->picture}}">
        <input type="file" name="picture" class="form-control">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" value="{{ $user->email }}" class="form-control" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Имя</label>
        <input value="{{ $user->name }}" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Список адресов:</label>
        <ul>
            @forelse ($user->addresses as $address)
                <li @if($address->main) class="main-address" @endif>
                    {{$address->address}}
                </li>
            @empty
                <em>Адресов ранее не сохранено</em>
            @endforelse
        </ul>
    </div>
    <div class="mb-3">
        <label class="form-label">Новый адрес</label>
        <input value="" class="form-control" name="new_address">
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection