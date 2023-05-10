<?php

namespace App\Http\Controllers;

use App\Models\publicaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getPublicaciones(){
        $publicaciones = publicaciones::with('user')->get();
        return $publicaciones;
    }

    public function index($id = 0)
    {   
        // Condicional que nos hace saber si estamos viendo una sola publicacion o es mas de una
        if($id == 0){
            return Inertia::render('publicaciones/index');
        }else{
            $publicacion = publicaciones::with('user')->find($id);
            return Inertia::render('publicaciones/index', compact('publicacion'));
        }
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
            'titulo'=>'required',
            'contenido'=>'required'
        ]);

        $publicacion = publicaciones::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'fecha_publicacion' => $fecha_publicacion,
            'user_id' => $user->id
        ]);

        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show(publicaciones $publicaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(publicaciones $publicaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, publicaciones $publicaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(publicaciones $publicaciones)
    {
        //
    }

}
