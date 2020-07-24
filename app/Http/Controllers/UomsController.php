<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uom;

class UomsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Uom::all();
        return view('uoms.index', ['data' => $data, 'title' => 'Unidades de Medidas']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uoms.form',['type' => 'new', 'title' => 'Nueva Unidad de Medida']);
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
            'code' => 'required',
            'measure_type' => 'required'
        ]);

        if(Uom::create($request->all())){
            flash('Registro Incluido Con Exito!!')->success();
        }else{
            flash('Error al tratar de incluir el registro')->error();
        }

        return redirect()->route('uoms.index');
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
        $data = Uom::findorfail($id);
        return view('uoms.form',['data' => $data, 'type' => 'edit', 'title' => 'Editar Categoria']);
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
            'code' => 'required',
            'measure_type' => 'required'
        ]);

        $uom= Uom::findorfail($id);

        $uom->name = $request->input('name');

        if($uom->update()){
            flash('Registro modificado con Exito!!')->success();
        }else{
            flash('Error al tratar de modificar el registro!!')->error();
        }

        return redirect()->route('uoms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uom= Uom::findorfail($id);
        if($uom->delete()){
            flash('Registro Eliminado con Exito!!')->success();
        }else{
            flash('Error al tratar de eliminar el Registro!!')->error();
        }
        return redirect()->route('uoms.index');
    }
}
