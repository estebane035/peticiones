<?php

namespace App\Clases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\NotificationsPoints;
use Session;
use Auth;

class BD
{
	public static function crear($modelo, $request){
		 	DB::beginTransaction();
      try {
				$model = 'App\\'.$modelo;
				$registro = $model::create($request->all());
				DB::commit();
			} catch(QueryException $e) {
        $error_code = $e->errorInfo[1];
        DB::rollback();
        $error = BD::descripcionDelError($error_code);
        if($error!='No se encontró la descripción del error.'){
            return response()->json(['error' => $error, 'message' => $e->getMessage()], 500);
        } else {
            return response()->json(['message' => $e->getMessage()], 500);
        }
      }
      return response()->json($registro, 200);
	}

	public static function actualiza($idActualizar,$modelo, $request,$data) {

		 	DB::beginTransaction();
      try {
				$model = 'App\\'.$modelo;
				$registro = $model::find($idActualizar);
				$registro->fill($data);
				$registro->save();
				if($modelo =='User'){
					if(Auth::user()->id == $registro->id){
						$request->session()->put('user', $registro);
					}
				}
				DB::commit();
			} catch(QueryException $e) {
        $error_code = $e->errorInfo[1];
        DB::rollback();
        $error = BD::descripcionDelError($error_code);
        if($error!='No se encontró la descripción del error.'){
            return response()->json(['error' => $error, 'message' => $e->getMessage()], 500);
        } else {
            return response()->json(['message' => $e->getMessage()], 500);
        }
      }
      return response()->json($registro, 200);
	}

	public static function elimina($idEliminar,$modelo, $request){

		 	DB::beginTransaction();
      try {
				$model = 'App\\'.$modelo;
				$registro = $model::find($idEliminar);
        		$registro->delete();
				if(Auth::user()->id == $idEliminar && $modelo =='User'){
					DB::rollback();
					return '-1|No es posible deshabilitar al usuario en sesión.';
				}
				DB::commit();
			} catch(QueryException $e) {
        $error_code = $e->errorInfo[1];
        DB::rollback();
        if($error_code==1451) {
        	$registro = $model::find($idEliminar);
        	$deshabilitado = '';
        	if (isset($registro->status)) // Si el registro tiene la opcion de deshabilitarse
        	{
        		if($registro->status=='Enabled'){
          		$registro->status= 'Disabled';
          		$deshabilitado = 'El registro fue deshabilitado.';
          		$registro->save();
          	} else {
          		$registro->status= 'Disabled';
          	}
          	$registro->save();
        	} else {
        		$deshabilitado = "Cambia las relaciones de tus registros antes de eliminar ".$modelo;
        	}
					return response()->json(['message' => 'El registro no pudo ser eliminado porque <br/>hay información relacionada a el.<br/>'.$deshabilitado], 400);
        } else {
        	$error = BD::descripcionDelError($error_code);
          if($error!='No se encontró la descripción del error.'){
							return response()->json(['error' => $error, 'message' => $e->getMessage()], 500);
          } else {
							return response()->json(['message' => $e->getMessage()], 500);
          }
        }
    	}
			return response()->json($registro, 200);
	}

	public static function descripcionDelError($code){

		$error = '';
		switch ($code) {
			case 1062:		$error = "Houston, ¡Tenemos un registro duplicado!.";	break;
			case 1451:		$error = "Houston, ¡No podemos eliminar el registro, hay información relacionada a el!.";	break;
			case 1452:		$error = "Houston, ¡Relación no encontrada al insertar o actualizar un registro!.";	break;
			case 1054:		$error = "Houston, ¡Columna no encontrada!.";	break;

			case 1654:		$error = "Houston, ¡Hay un campo que no concuerda con el tipo de dato en la base de datos!.";	break;
			case 1048:		$error = "Houston, ¡Hay información que no puede estar vacia en la base de datos!.";	break;
			case 1054:		$error = "Houston, ¡Hay un campo que no se identifica en la base de datos!.";	break;
			case 1166 :		$error = "Houston, ¡Hay una columna con nombre incorrecto en la base de datos!.";	break;
			case 1406:		$error = "Houston, ¡Hay información muy extensa para ser guardada. Revise los campos de información!.";	break;
			default:		$error = "No se encontró la descripción del error.";	break;
		}

		return $error;
	}
}
