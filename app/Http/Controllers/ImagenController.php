<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');

        $nombreImagen = Str::uuid() . '.' . $image->extension();

        $imagenServidor = Image::make($image);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads/' . $nombreImagen);
        $imagenServidor->save($imagenPath);

        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}
