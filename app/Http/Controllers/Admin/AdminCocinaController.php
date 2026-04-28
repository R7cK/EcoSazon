<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cocina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCocinaController extends Controller
{
    public function index() {
        $cocinas = Cocina::with('user')->paginate(10);
        return view('Admin.cocinas.index', compact('cocinas'));
    }

    public function create() {
        $owners = User::where('role', 'owner')->get();
        return view('Admin.cocinas.create', compact('owners'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nombre' => 'required|unique:cocinas',
            'zona' => 'required',
            'categoria' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'estatus' => 'required|in:activa,inactiva',
        ]);
        $data['slug'] = Str::slug($data['nombre']);
        Cocina::create($data);
        return redirect()->route('admin.cocinas.index')->with('success', 'Cocina creada.');
    }

    public function edit(Cocina $cocina) {
        $owners = User::where('role', 'owner')->get();
        return view('Admin.cocinas.edit', compact('cocina', 'owners'));
    }

    public function update(Request $request, Cocina $cocina) {
        $data = $request->validate([
            'nombre' => 'required|unique:cocinas,nombre,' . $cocina->id,
            'zona' => 'required',
            'user_id' => 'nullable|exists:users,id'
        ]);
        $cocina->update($data);
        return redirect()->route('admin.cocinas.index')->with('success', 'Cocina actualizada.');
    }

    public function destroy(Cocina $cocina) {
        $cocina->delete();
        return back()->with('success', 'Cocina eliminada.');
    }
}