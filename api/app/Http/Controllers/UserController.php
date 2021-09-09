<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(6);;
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // VALIDACION DE CAMPOS
        $data = $request->only([
            'name', 'email', 'password'
        ]);

        $val = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);


        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'Nombre, Correo o Contraseña requeridas'
            ]);
        }

        $email = Validator::make($data, [
            'email' => ['email']
        ]);

        if($email->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'Correo electronico invalido'
            ]);
        }

        $unique = Validator::make($data, [
            'email' => ['unique:users'],
        ]);

        if($unique->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'El correo ya existe'
            ]);
        }
        
        // CREACION DE NUEVO USUARIO
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // REDIRECCIONAMIENTO
        return redirect()->route('user.index')->with([
            'message_type' => 'success',
            'message' => 'Usuario creado satisfactoriamente'
        ]);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {        
        // VALIDACION DE CAMPOS
        $data = $request->only([
            'name', 'email'
        ]);

        $val = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);

        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'Nombre, Correo o Contraseña requeridas'
            ]);
        }

        $email = Validator::make($data, [
            'email' => ['email']
        ]);

        if($email->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'Correo electronico invalido'
            ]);
        }

        $unique = Validator::make($data, [
            'email' => ['unique:users'],
        ]);

        if($unique->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'El correo ya existe'
            ]);
        }
        
        // ACTUALIZACION DE USUARIO
        $user->update($request->all());

        // REDIRECCIONAMIENTO
        return redirect()->route('user.index')->with([
            'message_type' => 'success',
            'message' => 'Usuario actualizado satisfactoriamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with([
            'message_type' => 'success',
            'message' => 'Usuario eleminado satisfactoriamente'
        ]);;
    }
}
