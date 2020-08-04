<form action="{{url($url)}}" method="POST">
  @csrf
  @method($method)
  <div class="container">
    <div class="form-group">
      <input class="form-control" value="{{$product->title}}" type="text" name="title" placeholder="Nombre">
    </div>
    <div class="form-group">
      <textarea class="form-control" rows="5" id="description" name="description" placeholder="Descripcion">{{$product->description}}</textarea>
    </div>
    <div class="form-group">
      <input class="form-control" value="{{$product->pricing}}" type="number" name="pricing" placeholder="Precio">
    </div>
    <div class="form-group">
      <input type="submit" value="Crear" class="btn btn-success">
    </div>
  </div>

</form>