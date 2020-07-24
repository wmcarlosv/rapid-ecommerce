<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
    }

    public function profile(){  
        return view('users.profile',['title' => 'Perfil de Usuario']);
    }

    public function change_profile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::findorfail(Auth::user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($user->Update()){
            flash('Perfil Actualizado Con Exito!!')->success();
        }else{
            flash('Error al tratar de Actualizar el Perfil')->error();
        }

        return redirect()->route('profile');
    }

    public function change_password(Request $request){
        $request->validate([
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        $user = User::findorfail(Auth::user()->id);

        $user->password = bcrypt($request->input('password'));

        if($user->Update()){
            flash('Clave Cambiada Con Exito!!')->success();
        }else{
            flash('Error al intentar Cambiar la Clave!!')->error();
        }

        return redirect()->route('profile');
    }
}
