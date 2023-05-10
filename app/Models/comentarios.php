<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'autor', 'contenido', 'fecha_publicacion', 'publicacion_id', 'user_id'];

    public function publicaciones(){
        return $this->belongsTo(publicaciones::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
