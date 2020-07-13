@extends("layouts.app")

@section("content")
<div class="container white">
  <h1> Agregar nuevo producto </h1>
  <!-- Formualrio -->
  @include('products.form',[
    'product'=>$product,
    'url'=>'/products',
    'method'=> 'POST'
    ])
</div>
@endsection