@extends('layouts.app')

@section('title', 'Shopfy')
@section('content')
<div class="container text-center">
  <h1>Bienvenidos Shopfy, el mejor eCommerce</h1>
</div>
  <div class="container">
    <p>Aqui podras elegir los mejores productos </p>
      {{$name}}
  </div>
@endsection