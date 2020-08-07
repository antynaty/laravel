<div class="card product text-left">
    <div class="absolute actions" style="position: absolute;">
      <a href="{{url('/products/'.$product->id.'/edit')}}">Editar</a>
      @include('products.delete',['product' => $product])
    </div>
    <h1>{{$product->title}}</h1>
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        @if($product->extension)
          <img src="{{url("products/images/$product->id.$product->extension")}}" alt="Product_IMG" class="product-avatar">
        @endif
      </div>
      <div class="col-sm-6 col-xs-12">
        <p>
          <strong style="font-weight: bold">Descripción</strong>
        </p>
        <p>
          {{$product->description}}
        </p>
        <p>
          <!-- <a href="" class="btn btn-success"> Agregar al carrito</a> -->
          @include('product_shopping_carts.form',
          [
          'product'=> $product,
          'url'=>'/product_shopping_carts',
          ])
        </p>
      </div>
    </div>
  </div>