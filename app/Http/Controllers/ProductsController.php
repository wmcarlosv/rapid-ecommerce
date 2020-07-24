<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Uom;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('products.index', ['data' => $data, 'title' => 'Productos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $uoms = Uom::all();
        $tags = Tag::all();
        return view('products.form',['type' => 'new', 'title' => 'Nuevo Producto', 'categories' => $categories, 'uoms' => $uoms, 'tags' => $tags]);
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
            'name' => 'required',
            'category_id' => 'required',
            'uom_id' => 'required',
            'price' => 'required'
        ]);

        DB::beginTransaction();

        $errors = 0;
        $product = new Product();

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->uom_id = $request->input('uom_id');

        if($request->hasFile('photo')){
            $product->photo = $request->photo->store('public/products');
        }else{
            $product->photo = NULL;
        }

        $product->prices = $request->input('price');

        if($product->save()){
            $product->tags()->attach($request->input('tags'));
        }else{
            $errors++;
            
        }

        if($errors > 0){
            DB::rollBack();
            flash('Error al tratar de incluir el registro')->error();
        }else{
            DB::commit();
            flash('Registro Incluido Con Exito!!')->success();
        }   

        return redirect()->route('products.index');
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
        $data = Product::findorfail($id);
        $categories = Category::all();
        $uoms = Uom::all();
        $tags = Tag::all();
        return view('products.form',['data' => $data, 'type' => 'edit', 'title' => 'Editar Producto', 'categories' => $categories, 'uoms' => $uoms, 'tags' => $tags]);
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
            'name' => 'required',
            'category_id' => 'required',
            'uom_id' => 'required',
            'price' => 'required'
        ]);

        DB::beginTransaction();
        $errors = 0;

        $product = Product::findorfail($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->uom_id = $request->input('uom_id');

        if($request->hasFile('photo')){
            Storage::delete($product->photo);
            $product->photo = $request->photo->store('public/products');
        }

        $product->prices = $request->input('price');

        if($product->update()){
            $product->tags()->detach();
            foreach($request->input('tags') as $itag){
                $product->tags()->attach($itag);
            }
            
        }else{
            $errors++;
            print "Products";
        }

        if($errors > 0){
            DB::rollBack();
            flash('Error al tratar de actualizar el registro')->error();
        }else{
            DB::commit();
            flash('Registro actualiazado Con Exito!!')->success();
        } 

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $product->tags()->detach();
        Storage::delete($product->photo);

        if($product->delete()){
            flash('Registro Eliminado con Exito!!')->success();
        }else{
            flash('Error al tratar de eliminar el Registro!!')->error();
        }
        return redirect()->route('products.index');
    }
}
