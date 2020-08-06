@extends('layouts.app')
@section('content')
  @if(session('status'))
    <h3 class="text-xl md:text-2xl">
      {{session('status')}}
    </h3>
  @endif
  <div class="big-padding text-center blue-grey white-text">
    <h1> Tu carrito de compras </h1>
  </div>
  <div class="container pt-2">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Producto</td>
          <td>Precio</td>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{$product->title}}</td>
          <td>{{$product->pricing}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="container text-right">
      <a class="inline-block font-semibold bg-white py-2 px-4" href="{{url('carrito/checkout')}}">Pagar con PayPal</a>
      <h1>{{$total}}</h1>
  </div>

  <!-- <h1> Shopping cart id : {{$shopping_cart->shoppingCartId()}}</h1>
  <h1> {{$shopping_cart}}</h1> -->
@endsection  