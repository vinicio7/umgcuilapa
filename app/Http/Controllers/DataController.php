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

        //    dd ($request->input('id_sede_extension'));

            //explode devuelve un array
            $grados = explode(", ", $request->input("grado"));
            //$grados = ['ING', 'LIC']

            if($request->input("plan")=="Sabado" && $request->input("grado")!= "POS"){
                $consulta1= Carreras::select('nombre')->where('id_sede_extension', $request->input('id_sede_extension'))->where('plan', 'Sabado')->whereIn('grado', $grados)->get();
                $this->consulta1    = $consulta1;
            }

            if($request->input("plan")=="Domingo"){
                $consulta2= Carreras::select('nombre')->where('id_sede_extension',$request->input('id_sede_extension'))->where('plan', 'Domingo')->whereIn('grado', $grados)->get();
                $this->consulta2    = $consulta2;
            }

            if($request->input("plan")=="Sabado" && $request->input("grado")=="POS"){
                $consulta3= Carreras::select('nombre')->where('id_sede_extension',$request->input('id_sede_extension'))->where('grado','POS')->get();
                $this->consulta3    = $consulta3;
            }
            
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registros consultados correctamente';

        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG')?$e->getMessage():$this->message;

        }finally{
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'consulta1' => $this->consulta1,
                'consulta2' => $this->consulta2,
                'consulta3' => $this->consulta3,
                
            ];

            return response()->json($response, $this->status_code);
        }
    }

     public function informacionCarreras(Request $request) {

        try {
            
            $records = Carreras::select('nombre', 'imagen', 'plan', 'descripcion', 'ubicacion', 'duracion', 'horario')->where('id_sede_extension',$request->input('id_sede_extension'))
            ->where('id', $request->input('id'))->get();  
    
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
}
