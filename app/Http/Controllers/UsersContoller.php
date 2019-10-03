<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
class UsersContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all()->pluck('name','id');

        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario=new User;
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=bcrypt($request->password);


if($usuario->save()){
$usuario->assignRole($request->rol);
return redirect('/usuarios');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=User::findOrFail($id);
        $roles=Role::all()->pluck('name','id');
        return view('usuarios.edit', compact('usuario','roles'));

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
        $usuario=User::findOrFail($id);
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        if($request->password != null){
            $usuario->password=$request->password;
        }
        $usuario->syncRoles($request->rol);

        $usuario->save();
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);

        #Eliminar el rol 

$usuario->removeRole($usuario->roles->implode('name',','));
        #Eliminar usuario
if($usuario->delete()){
    return redirect('/usuarios');
}else{
    return response()->json(['mensaje'=>'Error al eliminar el usuario']);
}

    }
}
