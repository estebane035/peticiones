<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
  protected $table = 'peticiones';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'latitud', 'longitud', 'tipo', 'estatus', 'comentarios'
  ];

  public function Comentarios()
  {
    return $this->hasMany('App\Comentario', 'peticion_id', 'id');
  }
}
