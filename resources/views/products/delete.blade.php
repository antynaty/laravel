<form action="{{url('/products/'.$product->id)}}" method="POST" style="display: inline-block">
  @csrf
  @method('DELETE')
  <input 
    type="submit" 
    class="btn btn-link red-text no-padding no-margin producto no-transform"
    style="text-transform:capitalize"
    value="Eliminar">
</form>