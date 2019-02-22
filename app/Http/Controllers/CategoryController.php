<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id','name')->get();
        return view('categories.create', ['categories' => $categories]);
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
          'category_name'=>'required',
          'parent_id'=> 'required|integer'
        ]);
        $categories = new Categories([
          'name' => $request->get('category_name'),
          'parent_id'=> $request->get('parent_id')
        ]);
        $categories->save();
        return redirect('/categories')->with('success', 'Category has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $category = Categories::select('id','name')->get();
        // return view('categories.view', ['category' => $category]);
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
        $category = Categories::find($id);
        return view('categories.edit', compact('category'), ['categories' => $categories]);
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
          'category_name'=>'required',
          'parent_id'=> 'required|integer'
        ]);
        $category = Categories::find($id);
        $category->name = $request->get('category_name');
        $category->parent_id = $request->get('parent_id');
        $category->save();
        return redirect('/categories')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return json_encode(array(
            "status" => true,
            "message" => "Category has been deleted Successfully"
        ));
        // return redirect('/categories')->with('success', 'Category has been deleted Successfully');
    }

    public function getCategories(){
        $categories = Categories::select('id','name')->get();
        print_r(json_encode(
            array(
            "data"=> $categories
            )
        ));
    }
}
