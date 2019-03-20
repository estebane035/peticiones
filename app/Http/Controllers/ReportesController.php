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
  public function index()
  {
      return view('dashboard.reportes.index');
  }

  public function obtenerPeticiones($latitud, $longitud)
  {
    $peticiones = Peticion::all();
    return $peticiones;
  }
}
