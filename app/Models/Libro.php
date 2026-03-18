<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    // Variables que el usuario puede controlar
    protected $fillable = ['nombre','autor','editorial','precio'];

}
