@extends('layouts.app')

@section('title', 'Shopfy')
@section('content')
<div class="container text-center ">
  <h1>Bienvenidos Shopfy, el mejor eCommerce</h1>
</div>
  <div class="container product-container ">
    <p>Aqui podras elegir los mejores productos </p>
    <!-- <a href="{{url('/products')}}">Productos disponibles</a> -->
    @foreach ($products as $product)
      @include('products.product', ['product'=>$product])
    @endforeach
  </div>
@endsection