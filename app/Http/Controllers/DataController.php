<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sedes;
use App\Informacion;
use App\Preguntas;
use App\Galerias;
use App\Actividades;
use App\Carreras;



class DataController extends Controller
{
    protected $result      = false;
    protected $message     = 'Ocurrió un problema al procesar su solicitud';
    protected $records     = array();
    protected $status_code = 400;
    protected $consulta1   = array();
    protected $consulta2   = array();
    protected $consulta3   = array();
    protected $consulta4   = array();

	 public function consultarSedes() {

        try {
            $records           = Sedes::select('nombre', 'imagen')->get();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

     public function informacionUniversidad() {

        try {
            $records           = Informacion::select('descripcion', 'mision','vision')->get();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

       public function preguntas() {

        try {
            $records           = Preguntas::select('nombre', 'descripcion')->get();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

        public function galeria() {

        try {
            $records           = Galerias::select('imagenes', 'descripcion')->get();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

         public function ubicacionSedes() {

        try {
            $records           = Sedes::select('nombre', 'latitud', 'longitud')->get();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }


         public function informacionSedes(Request $request) {

        try {
        	
            $records           = Sedes::where('id', $request->input('id') )->first();

            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

       public function actividades(Request $request) {

        try {
        	
       		$records = Actividades::whereBetween('fecha_inicio', [
       			$request->input('fecha_inicio', date('Y-m-d')), 
       			$request->input('fecha_fin', date('Y-m-d')) ]
       		)->get();  
    
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;
        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

          public function listaCarreras(Request $request) {

        try {

            $consulta1= Carreras::select('nombre')->where('id_sede_extension',
            $request->input('id_sede_extension'))->where('plan', 'Sabado')->where('grado',['ING','LIC'])->get();

            $consulta2= Carreras::select('nombre')->where('id_sede_extension',$request->input('id_sede_extension'))->where('plan', 'Domingo')->where('grado',['ING','LIC'])->get();

        	$consulta3= Carreras::select('nombre')->where('id_sede_extension',$request->input('id_sede_extension'))->where('grado','POS')->get();

            $consulta4= Carreras::select('nombre')->where('id_sede_extension',$request->input('id_sede_extension'))->where('plan','Sabado')->where('grado',['ING','LIC'])->get();
       		
            $this->status_code = 200;
            $this->result      = true;
           // $this->message     = 'Registros consultados correctamente';
            $this->records     = $records;
            $this->$consulta1    = $consulta1;
            $this->$consulta2    = $consulta2;
            $this->$consulta3    = $consulta3;
            $this->$consulta4    = $consulta4;

        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
           // $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;

        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
                'consulta1' => $this->consulta1,
                'consulta2' => $this->consulta2,
                'consulta3' => $this->consulta3,
                'consulta4' => $this->consulta4,
            ];

            return response()->json($response, $this->status_code);
        }
    }
}
