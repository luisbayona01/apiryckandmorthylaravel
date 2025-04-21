<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{  
    protected $table = 'personajes';
     protected $fillable = ['name', 'status', 'species','type', 'gender', 'origin_name', 'origin_url', 'image'];


    /*
    `name`, `status`, `species`, `type`, `gender`, `origin_name`, `origin_url`, `image`
    
    */
}
