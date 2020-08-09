<form action="{{url('/product_shopping_carts')}}" method="POST" class=" add-to-cart inline-block">
  @csrf
  <input type="hidden" name="product_id" value="{{$product->id}}">
  <input type="submit" value="Agregar al carrito" class="btn btn-info">
</form>