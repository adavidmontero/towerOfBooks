<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /** RELACIONES */

    // 1 prestamo pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 prestamo pertenece a un copia
    public function copy()
    {
        return $this->belongsTo(Copy::class);
    }
}