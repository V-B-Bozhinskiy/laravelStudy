@extends('layouts.app')

@section('title')
    Все заказы
@endsection

@section('content')
<div class="accordion accordion-flush" id="accordionFlushExample">
  @forelse($orders as $order)
    @php
        $summ = 0;
        $products = $order->products
    @endphp
    @foreach ($products as $idx => $product)
    @php
        $productSumm = $product->pivot->price * $product->pivot->quantity;
        $summ += $productSumm;
    @endphp
    @endforeach
  <div class="accordion-item">
    <h2 class="accordion-header" id="{{$order->id}}">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$order->id}}" aria-expanded="false" aria-controls="flush-{{$order->id}}">
        Заказ {{$order->id}} от {{$order->created_at}} на {{$summ}} руб.
      </button>
    </h2>
    <div id="flush-{{$order->id}}" class="accordion-collapse collapse" aria-labelledby="{{$order->id}}" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                </tr>
              </thead>
            <tbody>
              @foreach($order->products as $idx => $product)
              <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->price }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->pivot->price * $product->pivot->quantity }}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="4" class="text-end">Итого:</td>
                    <td>
                        <strong>
                        {{ $summ }}
                        </strong>
                    </td>
                </td>
               </tr>
            </tbody>
          </table>
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Пользователь</th>
                    <th>Почта</th>
                    <th>Адрес доставки</th>
                </tr>
            </thead>
            @php
                $linkUser = '';
                foreach($users as $user){
                    if($order->user_id == $user->id){
                        $linkUser = $user;
                        break;
                    }
                }
                $linkAdress = '';
                foreach($linkUser->addresses as $address){
                    if($order->address_id == $address->id){
                        $linkAdress = $address;
                        break;
                    }
                }
            @endphp
            <tbody>
                <td>{{ $linkUser->name }}</td>
                <td>{{ $linkUser->email }}</td>
                <td>{{ $linkAdress->address }}</td>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  @empty
            <tr>
                <td class="text-center" colspan="5">
                        Заказы ещё не размещены.
                </td>
            </tr>
  @endforelse
</div>
@endsection