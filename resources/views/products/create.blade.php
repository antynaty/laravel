@extends("layouts.app")
@section("content")

<div class="container white">
  <h1> Agregar nuevo producto </h1>
  @if( session('mensaje'))
<h3 class="text-xl md:text-2xl">
  {{$mensaje}}
</h3>
@endif
  <!-- Formualrio -->
  @include('products.form',[
    'product'=>$product,
    'url'=>'/products',
    'method'=> 'POST'
    ])
</div>
@endsection