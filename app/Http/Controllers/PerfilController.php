<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index', [
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request)
    {
        // Modificar el Request
        $request->merge([
            'username' => Str::slug($request->username),
        ]);

        $request->validate([
            // 'username' => 'required|unique:users|min:3|max:20',
            'username' => ['required', 'unique:users,username,' . $request->user()->id, 'min:3', 'max:20'],
            'imagen' => 'image|required',
        ]);

        if($request->hasFile('imagen')) {
            $image = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $image->extension();

            $imagenServidor = Image::make($image);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles/' . $nombreImagen);
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find($request->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
