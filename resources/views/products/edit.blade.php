@extends('layouts.app')

@section('content')

<div class="container white">
  <h1>Editar un producto</h1>
  <!-- Formualrio -->
  @include('products.form',[
    'product'=>$product,
    'url'=>'/products/'.$product->id,
    'method'=>'PUT'
  ])
</div>
@endsection