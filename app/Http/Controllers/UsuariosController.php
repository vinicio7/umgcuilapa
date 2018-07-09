<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;

class UsuariosController extends Controller
{
    protected $result      = false;
    protected $message     = 'Ocurrió un problema al procesar su solicitud';
    protected $records     = array();
    protected $status_code = 400;

    public function index() {
        try {
            $records           = Usuarios::all();
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

    public function store(Request $request) {
        try {
            $validacion = Usuarios::where('usuario',$request->input('usuario'))->first();
            if ($validacion) {
                throw new \Exception('Ya existe un registro con la mismo usuario');
            } else {
                    $record = Usuarios::create([
                            'nombre' => $request->input('nombre'),
                            'telefono' => $request->input('telefono'),
                            'correo' => $request->input('correo'),
                            'genero' => $request->input('genero'),
                            'usuario' => $request->input('usuario'),
                            'password' => $request->input('password'),
                        ]);
                    if ($record) {
                        $this->status_code = 200;
                        $this->result      = true;
                        $this->message     = 'Datos creados correctamente';
                        $this->records     = $record;
                    } else {
                        throw new \Exception('Datos no pudieron ser creados');
                    }
            }
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

    public function show($id) {
        try {
            $record = Usuarios::find($id);
            if ($record) {
                $this->status_code = 200;
                $this->result      = true;
                $this->message     = 'Datos consultados correctamente';
                $this->records     = $record;
            } else {
                throw new \Exception('Registro no encontrado');
            }
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

    public function update(Request $request, $id) {
        try {
            $validacion = Usuarios::where('usuario',$request->input('usuario'))->first();   
            if ($validacion == true && $validacion->id != $id) {
                throw new \Exception('Ya existe un registro con el mismo usuario');
            } else {
                $record              = Usuarios::find($id);
                $record->nombre = $request->input('nombre', $record->nombre);
                $record->usuario = $request->input('usuario', $record->usuario);
                $record->telefono = $request->input('telefono', $record->telefono);
                $record->correo = $request->input('correo', $record->correo);
                $record->genero = $request->input('genero', $record->genero);
                $record->password = \Hash::make($request->input('password', $record->password));
                if ($record->save()) {
                    $this->status_code = 200;
                    $this->result      = true;
                    $this->message     = 'Datos actualizados correctamente';
                    $this->records     = $record;
                } else {
                    throw new \Exception('La descripción no pudo ser actualizada');
                }
            }
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

    public function destroy($id) {
        try {
            $record = Usuarios::find($id);
            if ($record) {
                $record->delete();
                $this->status_code = 200;
                $this->result      = true;
                $this->message     = 'Datos eliminados correctamente';
            } else {
                throw new \Exception('Datos no pudieron ser encontrados');
            }
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
