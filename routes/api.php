<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'estudent'
], function () {

    Route::get('alumnos',[AlumnoController::class,'index']);
    Route::get('alumnos/{id}',[AlumnoController::class,'show']);
    Route::post('alumnos',[AlumnoController::class,'create']);
    Route::post('alumnos/edit/{id}',[AlumnoController::class,'update']);
    Route::post('alumnos/{id}',[AlumnoController::class,'destroy']);
    
});
/*
Route::controller(AlumnoController::class)->group(function(){
    Route::get("alumnos","index");
    Route::get("alumnos/{id}","show");
    Route::post("alumnos","create");
    Route::put("alumnos/edit/{id}","update");
    Route::delete("alumnos/{id}","destroy");
});
*/
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {

    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    
});

Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
});

