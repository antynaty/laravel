<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth",[
            "except" => "show"
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("products.index",["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        return view("products.create",["product"=>$product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $itsFile = $request->hasFile('product_image') && $request->product_image->isValid();
        $extension = $request->product_image->extension();
        // if ( $itsFile ) {
        //     //
        // }
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->pricing = $request->pricing;
        $product->user_id = Auth::user()->id;
        
        /*   NOT WORKING    mensaje is not sending back or im not reading it well
        if( $extension === '.png' || $extension === '.jpeg' || $extension === '.jpg') {
            // 
            $product->extension = $extension;
        } else {
            $product = new Product;
            $mensaje = 'Extensión no permitda, prueba otra imagen.';
            return view("products.create",['product'=>$product, 'mensaje'=>$mensaje]);
        }
        */
        if($itsFile){
            $product->extension = $extension;
        }
        if($product->save() && $itsFile){
            $request->product_image->storeAs('images', "$product->id.$extension");  // ->sotre()   numero automatizado pero no tendre control de el dado mi modelo
            return redirect(("/products"));
        }else{
            return view("products.create");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
        $product = Product::find($id);
        return view('products.show',['product'=> $product]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $product = Product::find($id);
        return view("products.edit",["product"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->pricing = $request->pricing;

        if($product->save()){
            return redirect(("/products"));
        }else{
            return view("products.edit",["product"=>$product]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Product::destroy($id);
        return redirect(("/products"));
    }
}
