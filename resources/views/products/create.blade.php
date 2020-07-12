@extends("layouts.app")

@section("content")
<div class="container">
  <h1> Agregar nuevo producto </h1>
  <!-- Formualrio -->
  <form action="{{route('formProduct')}}" method="GET">
    <input type="text" name="title" placeholder="Nombre">
    <input type="text" name="description" placeholder="Descripcion">
    <input type="number" name="pricing" placeholder="Precio">
    <input type="submit" value="Crear">
  </form>
</div>
@endsection