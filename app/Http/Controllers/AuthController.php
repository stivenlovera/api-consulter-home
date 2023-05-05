<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $user = User::where('usuario', $request->usuario)->where('password', $request->password)->first();
            if ($user) {
                $token = $user->createToken($user)->plainTextToken;
                return response([
                    'status' => 1,
                    'message' => 'Iniciado correctamente',
                    'data' => [
                        'token' => $token,
                    ],
                ], 200);
            } else {
                return response([
                    'status' => 0,
                    'message' => 'Credenciales no validas',
                    'data' => null,
                ], 200);
            }

        } catch (\Throwable $th) {
            return response([
                'status' => 0,
                'message' => 'A ocurrido un error',
                'data' => null,
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->user()) {
                $persona = DB::table('persona')->where('persona_id', $request->user()->persona_id)->first();
                return response([
                    'status' => 1,
                    'message' => 'Iniciado correctamente',
                    'data' => [
                        'nombreCompleto' => "$persona->nombre $persona->apellidos",
                        'perfil' => '',
                        'modulos' => [],
                    ],
                ], 200);
            } else {
                return response([
                    'status' => 0,
                    'message' => 'Credenciales no validas',
                    'data' => null,
                ], 200);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => 0,
                'message' => 'A ocurrido un error',
                'data' => null,
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
