<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description']; #habilita campos para preenchimento em massa
    // protected $guarded = ['secret']; #campos que nao podem ser preenchidos em massa / oposto do fillable

}
