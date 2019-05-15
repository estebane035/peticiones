<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peticion;
use App\Comentario;
use App\Clases\BD;
use DataTables;
use Response;
use DB;
use Auth;
use Carbon\Carbon;
use App\Clases\Comun;

class ComentariosController extends Controller
{
	public function __construct()
  	{
    	$this->middleware('auth');
  	}

  	public function create($peticion_id)
	{
		$registro = new Comentario;
	   return view('dashboard.peticiones.comentarios.agregar', ['registro' => $registro, "peticion_id" => $peticion_id]);
	}

	public function store(Request $request)
	{
	    if($request->ajax())
	    {
				$request->merge(["user_id" => Auth::User()->id]);
	    	return BD::crear("Comentario", $request);
	    }
	    return response()->json(['message' => 'Petición incorrecta'], 500);
	}
}
