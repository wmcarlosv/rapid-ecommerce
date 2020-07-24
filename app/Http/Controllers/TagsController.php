<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tag::all();
        return view('tags.index', ['data' => $data, 'title' => 'Etiquetas']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.form',['type' => 'new', 'title' => 'Nueva Etiqueta']);
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

        if(Tag::create($request->all())){
            flash('Registro Incluido Con Exito!!')->success();
        }else{
            flash('Error al tratar de incluir el registro')->error();
        }

        return redirect()->route('tags.index');
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
        $data = Tag::findorfail($id);
        return view('tags.form',['data' => $data, 'type' => 'edit', 'title' => 'Editar Categoria']);
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

        $tag= Tag::findorfail($id);

        $tag->name = $request->input('name');

        if($tag->update()){
            flash('Registro modificado con Exito!!')->success();
        }else{
            flash('Error al tratar de modificar el registro!!')->error();
        }

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag= Tag::findorfail($id);
        if($tag->delete()){
            flash('Registro Eliminado con Exito!!')->success();
        }else{
            flash('Error al tratar de eliminar el Registro!!')->error();
        }
        return redirect()->route('tags.index');
    }
}
