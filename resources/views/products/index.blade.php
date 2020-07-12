@extends("layouts.app")

@section("content")
  <div class="big-padding text-center blue-grey white-text">
    <h1>Productos</h1>
  </div>
  <div class="container pt-2">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Descripcion</td>
          <td>Precio</td>
          <td>Accion</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->pricing}}</td>
            <td>Accion</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection