<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $fillable = [
        'copy_id', 'editorial', 'pages', 'image_url', 'book_id'
    ];

    /** RELACIONES */

    // Una copia pertenece a un libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
