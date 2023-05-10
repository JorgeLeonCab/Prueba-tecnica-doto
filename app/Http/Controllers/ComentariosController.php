<?php

namespace App\Http\Controllers;

use App\Models\comentarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getComentarios($pub_id){
        $comentarios = comentarios::with('user')->where('publicacion_id', $pub_id)->get();
        return $comentarios;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $fecha_publicacion = Carbon::now();

        $res = $request->validate([
            'contenido'=>'required',
            'publicacion_id' =>'required',
        ]);

        // Asignando los valores faltantes en el request
        $comentario = comentarios::create([
            'autor' => $user->name,
            'contenido' => $request->contenido,
            'fecha_publicacion' => $fecha_publicacion,
            'publicacion_id' => $request->publicacion_id,
            'user_id' => $user->id,
        ]);

        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show(comentarios $comentarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comentarios $comentarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comentarios $comentarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comentarios $comentarios)
    {
        //
    }
}
