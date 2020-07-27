@extends("layouts.app")
@section("content")
@if(session('status'))
  <h3 class="text-xl md:text-2xl">
    {{session('status')}}
  </h3>
@endif
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
        <td>
          <a href="{{url('/products/'.$product->id.'/edit')}}">Editar</a>
          @include('products.delete',['product' => $product])
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="floating">
  <a href="{{url('/products/create')}}" class="btn btn-primary btn-fab">
    <i class="material-icons">add</i>
  </a>
</div>
@endsection