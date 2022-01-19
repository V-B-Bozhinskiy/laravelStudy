@extends('layouts.app')

@section('title')
    Список пользователей
@endsection

@section('content')
<h1>
    {{ $title }}
</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>login</th>
            <th>Почта</th>
            <th>Админ?</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->is_admin }}</th>
            <th class="text-center">
                <a href="{{ route('enterAsUser', $user->id) }}">Войти как</a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection