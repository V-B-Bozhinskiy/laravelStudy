{{ date('d.m.Y H:i:s') }}

<h1>
    {{ $title }}
</h1>

@if($number > 5)
    Ваше число больше 5.
@else
    Ваше число меньше или равно 5.
@endif

<ul>
@foreach ($numbers as $number)
    <li>    
        {{ $number }}
        @if ($loop->first)
            (Это первая запись)
        @endif
        @if ($loop->last)
            (Это последняя запись)
        @endif
    </li>
@endforeach
</ul>

<ul>
@for ($i = 0; $i < 10; $i++)
    <li>
        {{ $i }}
    </li>
@endfor
</ul>

@empty ($cities)
    Список городов не получен
@endempty

<br>

@isset($number)
    Переменная number определена
@endisset

<br>

@auth
    Вы авторизованы
@endauth

<br>

@guest
    Вы гость
@endguest