<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index() {
        $usuarios = User::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.usuarios.index', compact('usuarios'));
    }

    public function create() {
        return view('Admin.usuarios.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,owner,user',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $usuario) {
        return view('Admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,owner,user',
        ]);

        $usuario->name = $data['name'];
        $usuario->email = $data['email'];
        $usuario->role = $data['role'];

        if (!empty($data['password'])) {
            $usuario->password = Hash::make($data['password']);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario) {
        if(auth()->id() === $usuario->id) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta administrativa.');
        }
        
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado permanentemente.');
    }
}