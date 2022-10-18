<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(){
        try {
            $alumnos = Alumno::all();
            if (count($alumnos)== 0) {
                return response()->json([
                    "error" =>"No alumno found"
                ],404);
            }
            return response()->json($alumnos, 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try {
            $alumno = Alumno::find($id);
            return response()->json($alumno,200);
        } catch (\Exception $e) {
            return response()->json([
                "error"=> $e->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try {
            $request->validate([
                "name"=>"required|string",
                "lastName"=>"required|string",
                "email"=>"required|string",
                "cellphone"=>"required|string"
            ]);
            $alumno = Alumno::create($request->all());
            return response()->json([
                "message"=>"alumno created succesfully",
                "alumno "=>$alumno
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error"=>$e->getMessage()
            ],400);
        }
    }

    public function update(Request $request,$id){
        $request = $request->all();
        try {
            $alumno = Alumno::find($id);
            if (!$alumno) {
                return response()->json([
                    "error"=>"alumno not found"
                ]);
            }
            $alumno = Alumno::find($id)->update($request);
            return response()->json([
                "message"=>"alumno updated succesfully",
                "alumno" => $alumno
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error"=> $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        try {
            $alumno = Alumno::find($id);
            if (!$alumno) {
                return response()->json([
                    "error"=>"Alumno not found"
                ],400);
            }
            $alumno = Alumno::find($id)->destroy($id);
            return response()->json([
                "message" => "alumno deleted succesfully",
                "alumno"=>$alumno
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error"=>$e->getMessage()
            ]);
        }
    }
}
