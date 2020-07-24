<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('categories.index', ['data' => $data, 'title' => 'Categorias']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.form',['type' => 'new', 'title' => 'Nueva Categoria']);
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
            'name' => 'required'
        ]);

        if(Category::create($request->all())){
            flash('Registro Incluido Con Exito!!')->success();
        }else{
            flash('Error al tratar de incluir el registro')->error();
        }

        return redirect()->route('categories.index');
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
        $data = Category::findorfail($id);
        return view('categories.form',['data' => $data, 'type' => 'edit', 'title' => 'Editar Categoria']);
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
            'name' => 'required'
        ]);

        $category = Category::findorfail($id);

        $category->name = $request->input('name');

        if($category->update()){
            flash('Registro modificado con Exito!!')->success();
        }else{
            flash('Error al tratar de modificar el registro!!')->error();
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        if($category->delete()){
            flash('Registro Eliminado con Exito!!')->success();
        }else{
            flash('Error al tratar de eliminar el Registro!!')->error();
        }
        return redirect()->route('categories.index');
    }
}
