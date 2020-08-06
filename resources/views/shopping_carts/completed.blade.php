@extends('layouts.app')
@section('content')
@if(session('status'))
<h3 class="text-xl md:text-2xl">
  {{session('status')}}
</h3>
@endif
<div class="big-padding text-center blue-grey white-text">
  <h1> Estado de tu compra</h1>
</div>
{{$shopping_cart->shoppingCartID()}}
<div class="container">
  <div class="card large-padding">
    <h3>Tu pago ha sido procesado <span class="{{$order->status}}">{{$order->status}}</span> </h3>
    <p>Corrobora los detalles de tu envio</p>
    <div class="container">
      <div class="row large-padding">
        <div class="col-6">Correo</div>
        <div class="col-6">{{$order->email}}</div>
      </div>
      <div class="row large-padding">
        <div class="col-6">Dirección</div>
        <div class="col-6">{{$order->address()}}</div>
      </div>
      <div class="row large-padding">
        <div class="col-6">Código Postal</div>
        <div class="col-6">{{$order->postal_code}}</div>
      </div>
      <div class="row large-padding">
        <div class="col-6">Ciudad</div>
        <div class="col-6">{{ $order->city}}</div>
      </div>
      <div class="row large-padding">
        <div class="col-6">Pais</div>
        <div class="col-6">{{ $order->country_code}}</div>
      </div>
      <div class="text-center">
        <a href="{{url('/compras/'.$shopping_cart->custom_id)}}">Link de tu orden</a>
      </div>
    </div>

  </div>

</div>
@endsection