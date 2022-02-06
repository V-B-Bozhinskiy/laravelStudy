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
    .address-buttons{
        display: flex;
        justify-content: flex-start;
        line-height: 37px;
    }
    .btn-addr-setMain {
    border-radius: 100px;
    margin-left: 10px;
    margin-right: 10px;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 0px;
    padding-top: 0px;
    }

    .btn-addr-delete {
    border-radius: 100px;
    margin-left: 10px;
    margin-right: 10px;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 0px;
    padding-top: 0px;
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

    @if (session('profileSaved'))
        <div class="alert alert-success" role="alert">
            Изменения успешно применены
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
        <lable class="form-lable">Текущий пароль</lable>
        <input type="password" name="current_password" class="form-control">
    </div>

    <div class="mb-3">
        <lable class="form-lable">Новый пароль</lable>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <lable class="form-lable">Повторите новый пароль</lable>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Адрес</label>
        <input value="" class="form-control" name="new_address">
    </div>
    
    <div class="mb-3">
        <input type="checkbox" name="addAsMainAddress" value=1>Назначить основным</p>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    <br>
    <div class="mb-3">
        <label class="form-label">Список сохраненных адресов:</label>
        <ul>
            @forelse ($user->addresses as $address)
                <li @if($address->main) class="main-address" @endif>
                    <div class="address-buttons">
                        <form method="post" action="{{ route('setMainAddr') }}" >
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name='userId'>
                        <input type="hidden" value="{{ $address->id }}" name='addrId'>
                        <button type="submit" class="btn btn-primary btn-addr-setMain" title = "Установить основным">⌂</button>
                        </form>
                        {{$address->address}}
                        <form method="post" action="{{ route('deleteUserAddress') }}" >
                        @csrf
                        <input type="hidden" value="{{ $address->id }}" name='addrId'>
                        <button type="submit" class="btn btn-danger btn-addr-delete" title = "Удалить сохраненный адрес">🗑</button>
                        </form>
                    </div>
                </li>
            @empty
                <em>Адресов ранее не сохранено</em>
            @endforelse
        </ul>
    </div>
@endsection