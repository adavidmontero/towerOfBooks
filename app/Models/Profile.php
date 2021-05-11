<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'number_id', 'telephone', 'direction', 'user_id'
    ];

    /** RELACIONES */

    //1 perfil pertenece a 1 usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
