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

  	public function obtenerPeticiones($latitud, $longitud, $rango, $rango_alerta, $start, $end)
  	{
			$cantidadMaxima = 0;
			$alerta = array();
			$peticiones = DB::select(DB::raw('SELECT id, latitud, longitud, tipo, estatus, ( 3959 * acos( cos( radians(' . $latitud . ') ) * cos( radians( latitud ) ) * cos( radians( longitud ) - radians(' . $longitud . ') ) + sin( radians(' . $latitud .') ) * sin( radians(latitud) ) ) ) AS distance FROM peticiones WHERE CREATED_AT BETWEEN "'.$start.'" and  "'.$end.'" HAVING distance < ' . $rango . ' ORDER BY distance') );
			foreach ($peticiones as $peticion)
			{
				$peticionEspecifica = DB::select(DB::raw('SELECT id, latitud, longitud, tipo, estatus, ( 3959 * acos( cos( radians(' . $peticion->latitud . ') ) * cos( radians( latitud ) ) * cos( radians( longitud ) - radians(' . $peticion->longitud . ') ) + sin( radians(' . $peticion->latitud .') ) * sin( radians(latitud) ) ) ) AS distance FROM peticiones WHERE CREATED_AT BETWEEN "'.$start.'" and  "'.$end.'" AND id != '.$peticion->id.' HAVING distance < '.$rango_alerta.' ORDER BY distance') );
				$cantidad = count($peticionEspecifica);
				if ($cantidad >= $cantidadMaxima)
				{
					if ($cantidad > $cantidadMaxima)
					{
						$alerta = array();
						$cantidadMaxima = $cantidad;
					}

					 array_push($alerta, ["latitud" => $peticion->latitud, "longitud" => $peticion->longitud, "rango" => $rango_alerta, "cantidad" => $cantidadMaxima]);
				}
			}
			return ["alerta" => $alerta, "peticiones" => $peticiones];
  	}
}
