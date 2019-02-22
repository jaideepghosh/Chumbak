<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('products/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id','name')->get();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'category'=>'required|integer',
            'price'=>'required|numeric|between:0,999999.99',
            'is_on_sale'=>'required',
            'image_aspect_ratio'=>'required'
        ]);
        $product = new Products([
          'name' => $request->get('product_name'),
          'category' => $request->get('category'),
          'price' => $request->get('price'),
          'special_price' => ($request->get('special_price'))?$request->get('special_price'):0.00,
          'is_special_price'=> ($request->get('special_price'))?1:0,
          'is_sale_flag' => ($request->get('is_on_sale'))?$request->get('is_on_sale'):0,
          'image_aspectratio_code' => $request->get('image_aspect_ratio'),
        ]);
        $product->save();
        return redirect('/products')->with('success', 'Product has been added.');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::select('id','name','parent_id')->get();
        $product = Products::find($id);
        return view('products.edit', compact('product'), ['categories' => $categories]);
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
        $request->validate([
            'product_name'=>'required',
            'category'=>'required|integer',
            'price'=>'required|numeric|between:0,999999.99',
            'is_on_sale'=>'required',
            'image_aspect_ratio'=>'required'
        ]);
        $product = Products::find($id);        
        $product->name = $request->get('product_name');
        $product->category = $request->get('category');
        $product->price = $request->get('price');
        $product->special_price = ($request->get('special_price'))?$request->get('special_price'):0.00;
        $product->is_special_price= ($request->get('special_price'))?1:0;
        $product->is_sale_flag = ($request->get('is_on_sale'))?$request->get('is_on_sale'):0;
        $product->image_aspectratio_code = $request->get('image_aspect_ratio');
        $product->save();
        return redirect('/products')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        return json_encode(array(
            "status" => true,
            "message" => "Product has been deleted Successfully"
        ));
    }

    public function getProducts(){
        $products = Products::select('id','name','price')->get();
        print_r(json_encode(
            array(
            "data"=> $products
            )
        ));
    }
}
