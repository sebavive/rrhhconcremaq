<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function edit(User $user){
        return view('user.edit', compact('user'));
    }

    public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El email ya se encuentra registrado',
            'password.required' => 'El campo contraseña es obligatorio'
        ]);
        if(!$validate){
            return response()->json($validate, 400);
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        return redirect()->route('user.edit',compact('user'))->with('success', 'Usuario guardado con éxito');
    }

    public function update(Request $request, User $user){
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El email ya se encuentra registrado'
        ]);
        if(!$validate){
            return response()->json($validate, 400);
        }
        if($request->password == ""){
            $request->request->remove('password');
        }else{
            $request->merge(['password' => bcrypt($request->password)]);
        }
        $user->update($request->all());
        return redirect()->route('user.edit',compact('user'))->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy(User $user){
        $total_admin = User::where('role', 'admin')->count();
        if($total_admin == 1 && $user->role == 'admin'){
            return response('No se puede eliminar el único administrador');
        }
        $user->delete();
        return response('Registro eliminado con éxito');
    }
}
