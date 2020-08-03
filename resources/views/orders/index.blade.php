@extends("layouts.app")
@section("content")
<div class="big-padding text-center blue-grey white-text">
      <h1>Dashboard</h1>
    </div>
<div class="container">
  <div class="panel panel-default">
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
            <td>
              <a href="#"
              class="set-guide-number" 
              data-type="text" 
              data-value="{{$order->guide_number}}" 
              data-name="guide_number" 
              data-pk="{{$order->id}}" 
              data-title="Numero Guia" 
              data-url="{{ url("/ordenes/$order->id")}}"
              >
            </a>
            </td>
            <td>
              <a href="#" 
              class="select-status" 
              data-type="select" 
              data-value="{{$order->status}}" 
              data-name="status" 
              data-pk="{{$order->id}}" 
              data-title="Status" 
              data-url="{{ url("/ordenes/$order->id")}}"
              >
            </a>
            </td>
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