@extends("layouts.app")
@section("content")
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Dashboard</h2>
    </div>
    <div class="panel-body">
      <h3>Estadisticas</h3>
      <div class="row top-space">
        <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
          <span>{{$total_month}} CL</span>
          Ingresos del Mes
        </div>
        <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
          <span>{{$total_month_count}} </span>
          Numero de Ventas
        </div>
      </div>
      <h3>Ventas</h3>
      <table class="table table-bordered">
        <tr>
          <td>Id venta</td>
          <td>Comprador</td>
          <td>Direccion</td>
          <td>No guia</td>
          <td>Estado</td>
          <td>Fecha venta</td>
          <td>Acciones</td>
        </tr>
        <thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->recipient_name}}</td>
            <td>{{$order->address()}}</td>
            <td>{{$order->guide_number}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->created_at}}</td>
            <td>Acciones</td>
          </tr>
          @endforeach

        </tbody>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection