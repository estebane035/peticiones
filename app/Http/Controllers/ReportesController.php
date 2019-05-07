<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peticion;
use App\Clases\BD;
use DataTables;
use Response;
use DB;
use Auth;
use Carbon\Carbon;
use App\Clases\Comun;

class ReportesController extends Controller
{
	public function __construct()
  	{
      $this->middleware('auth');
  	}

  	public function index()
  	{
      return view('dashboard.reportes.index');
  	}

  	public function obtenerPeticiones($latitud, $longitud, $rango)
  	{
  		$peticiones = DB::select(DB::raw('SELECT id, latitud, longitud, tipo, estatus, ( 3959 * acos( cos( radians(' . $latitud . ') ) * cos( radians( latitud ) ) * cos( radians( longitud ) - radians(' . $longitud . ') ) + sin( radians(' . $latitud .') ) * sin( radians(latitud) ) ) ) AS distance FROM peticiones HAVING distance < ' . $rango . ' ORDER BY distance') );
    	return $peticiones;
  	}
}
