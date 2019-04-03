<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
  protected $table = 'comentarios';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'peticion_id', 'comentarios'
  ];

  
}
