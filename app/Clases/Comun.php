<?php

namespace App\Clases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
use Mail;
use PDF;
Use Image;
Use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Comun
{
	public static function tienePermiso($permiso)
	{
		if (Auth::user()->role_id == "7")
			return true;
		$permisos = Auth::user()->Role->permits;
		if($permisos==null){
			$permisos = array();
		}else {
			$permisos = explode("|", decrypt($permisos));
		}
		if(in_array($permiso, $permisos))
			return true;
		else
			return false;
	}

	public static function get_random_string($length = 6){
    $cons = array('b','c','d','f','g','h','j','k','l',
                  'm','n','p','r','s','t','v','w','x','y','z');
    $voca = array('a','e','i','o','u');

    srand((double)microtime()*1000000);

    $max = $length/2;
    $password = '';
    for($i=1;$i<=$max;$i++){
        $password .= $cons[rand(0,count($cons)-1)];
        $password .= $voca[rand(0,count($voca)-1)];
    }

    if(($length % 2) == 1) $password .= $cons[rand(0,count($cons)-1)];

    return $password;
	}

	public static function subirImagen($request, $nombreInput, $nombreImagen, $ruta, $height = null, $width = null)
	{
		if ($request->hasFile($nombreInput)) {
	       if(!File::exists(public_path($ruta))) {
	          File::makeDirectory(public_path($ruta));
	        }
	        $image = $request->file($nombreInput);
	        //$extension = $request->$nombreInput->extension();
	        $image_resize = Image::make($image->getRealPath());
	        $image_resize->resize($height, $width, function ($constraint) {
	            $constraint->aspectRatio();
	        });
	        $image_resize->save(public_path($ruta.$nombreImagen));
	        return true;
        }
        return false;
	}

	public static function subirImagenDropzone($image, $nombreImagen, $ruta, $height = null, $width = null){
		try{
			$image_resize = Image::make($image->getRealPath());
			$image_resize->resize($height, $width, function ($constraint) {
					$constraint->aspectRatio();
			});
			$image_resize->save(public_path($ruta.$nombreImagen));
			return true;
		} catch(FileNotFoundException $e) {
			return false;
		}
	}

	public static function eliminarArchivo($ruta)
	{
		\File::Delete(public_path($ruta));
	}


}
