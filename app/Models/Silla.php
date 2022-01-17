<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Silla extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'sala_id'
    ];
}
