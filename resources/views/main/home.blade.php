@extends('layouts.app')

@section('title', 'Shopfy')
@section('content')
<div class="container text-center ">
  <h1>Bienvenidos Shopfy, el mejor eCommerce</h1>
</div>
<div class="container text-center product-container ">
  <p>Aqui podras elegir los mejores productos </p>
  <!-- <a href="{{url('/products')}}">Productos disponibles</a> -->
  <div class="row">
    @foreach ($products as $product)
      <div class="col-6">
        @include('products.product', ['product'=>$product])
      </div>
    @endforeach
  </div>
  <div class="product-pagination container text-center ">{{ $products->links() }}</div>
</div>
@endsection