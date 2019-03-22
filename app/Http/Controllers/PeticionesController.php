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

class PeticionesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      return view('dashboard.peticiones.index');
  }

  public function cargarTabla()
  {
    $registros = Peticion::all();
    return Datatables::of($registros)
      ->editColumn("coordenadas", function($registro){
        return "Latitud: ".$registro->latitud."<br> Longitud: ".$registro->longitud;
      })
      ->addColumn('actions', function ($registro) {
          $eliminar = $editar = $ver = "";
            $eliminar='<i onclick="eliminar('.$registro->id.')" style="margin-right: 10px;" class="fa fa-trash fa-lg col-xs-3 text-center pointer" title="Delete"></i>';
            $editar='<i onclick="editar('.$registro->id.')" style="margin-right: 10px;" class="fa fa-pencil fa-lg col-xs-3 text-center pointer" title="Edit"></i>';
            $ver='<a href="/peticiones/'.$registro->id.'"><i style="margin-right: 10px;" class="fa fa-search fa-lg col-xs-3 text-center pointer" title="Ver"></i></a>';
          return $editar.$eliminar.$ver;
      })
      ->rawColumns(['actions', 'coordenadas'])
      ->make(true);
  }

  public function cargarTablaNoAtendidas()
  {
    $registros = Peticion::where("estatus", "No Atendida")->get();
    return Datatables::of($registros)
      ->editColumn("coordenadas", function($registro){
        return "Latitud: ".$registro->latitud."<br> Longitud: ".$registro->longitud;
      })
      ->addColumn('actions', function ($registro) {

          $atender='<i onclick="atenderPeticion('.$registro->id.', '.$registro->latitud.', '.$registro->longitud.')" style="margin-right: 10px;" class="fa fa-check fa-lg col-xs-3 text-center pointer" title="Delete"></i>';

          return $atender;
      })
      ->rawColumns(['actions', 'coordenadas'])
      ->make(true);
  }

  public function cargarTablaHistorial()
  {
    $registros = Peticion::all();
    return Datatables::of($registros)
      ->editColumn("coordenadas", function($registro){
        return "Latitud: ".$registro->latitud."<br> Longitud: ".$registro->longitud;
      })
      ->addColumn('actions', function ($registro) {

          $eliminar = $editar = $ver = "";
            $eliminar='<i onclick="eliminar('.$registro->id.')" style="margin-right: 10px;" class="fa fa-trash fa-lg col-xs-3 text-center pointer" title="Delete"></i>';
            $editar='<i onclick="editar('.$registro->id.')" style="margin-right: 10px;" class="fa fa-pencil fa-lg col-xs-3 text-center pointer" title="Edit"></i>';
            $ver='<a href="/peticiones/'.$registro->id.'"><i style="margin-right: 10px;" class="fa fa-search fa-lg col-xs-3 text-center pointer" title="Ver"></i></a>';
          return $editar.$eliminar.$ver;
      })
      ->rawColumns(['actions', 'coordenadas'])
      ->make(true);
  }

  public function create()
  {
    $registro = new Peticion;
    return view('dashboard.peticiones.agregar', ['registro' => $registro]);
  }

  public function store(Request $request)
  {
    if($request->ajax())
    {
      $response = BD::crear("Peticion", $request);
      if($response->status() == 200) {
        return response()->json(['message' => 'Peticion creada'], 200);
      }
      return $response;
    }
    return response()->json(['message' => 'Petición incorrecta'], 500);
  }

  public function edit($id)
  {
    $registro = Peticion::findorfail($id);
    return view('dashboard.peticiones.agregar', ['registro' => $registro]);
  }

  public function update(Request $request, $id)
  {
    if($request->ajax())
    {
      $data = $request->input();
      $response = BD::actualiza($id,'Peticion', $request, $data);
      if($response->status() == 200) {
        return response()->json(['message' => 'Peticion actualizada'], 200);
      }
      return $response;
    }
    return response()->json(['message' => 'Petición incorrecta'], 500);
  }

  public function delete($id)
  {
    $registro = Peticion::findorfail($id);
    return view('dashboard.peticiones.eliminar', ['registro' => $registro]);
  }

  public function destroy(Request $request,$id)
  {
    if($request->ajax()) {
       $response = BD::elimina($id,'Peticion',$request);
       if($response->status() == 200) {
         return response()->json(['message' => 'Peticion eliminada'], 200);
       }
       return $response;
    }
    return response()->json(['message' => 'Petición incorrecta'], 500);
  }

  public function atender(Request $request, $id)
  {
    $registro = Peticion::findorfail($id);
    return view('dashboard.peticiones.atender', ['registro' => $registro]);
  }

  public function atenderPeticion(Request $request, $id)
  {
    if($request->ajax())
    {
      $request->merge(["estatus" => "En Proceso"]);
      $data = $request->input();
      $response = BD::actualiza($id,'Peticion', $request, $data);
      if($response->status() == 200) {
        return response()->json(['message' => 'Peticion actualizada'], 200);
      }
      return $response;
    }
    return response()->json(['message' => 'Petición incorrecta'], 500);
  }

  public function show($id)
  {
    $registro = Peticion::findorfail($id);
    return view('dashboard.peticiones.detalles', ['registro' => $registro]);
  }
}
