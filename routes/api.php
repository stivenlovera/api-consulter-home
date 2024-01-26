<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\EvaluacionPostulanteController;
use App\Http\Controllers\EvaluadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostulantesController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ResultadoEvaluacion;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestResultadoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*redirrecion de errores */
Route::get('/error',
    function (Request $request) {
        return response()->json([
            'status' => 0,
            'message' => 'no autorizado',
            'data' => null,
        ], 401);
    })->name('error');

/*rutas libres */
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/redirect', [PostulantesController::class, 'index']);
});

/*rutas protegidas */
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/auth', [AuthController::class, 'index']);
    Route::get('/auth-evaluador', [AuthController::class, 'indexEvaluador']);

    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'index']);
    });

    Route::prefix('empresa')->group(function () {
        Route::get('/', [EmpresaController::class, 'index']);
        Route::post('/', [EmpresaController::class, 'store']);
        Route::get('editar/{id}', [EmpresaController::class, 'edit']);
        Route::put('/{id}', [EmpresaController::class, 'update']);
        Route::delete('/{id}', [EmpresaController::class, 'destroy']);
    });
    Route::prefix('cargo')->group(function () {
        Route::get('/', [CargoController::class, 'index']);
        Route::post('/', [CargoController::class, 'store']);
        Route::get('editar/{id}', [CargoController::class, 'edit']);
        Route::put('/{id}', [CargoController::class, 'update']);
        Route::delete('/{id}', [CargoController::class, 'destroy']);
    });
    Route::prefix('postulantes')->group(function () {
        Route::get('/', [PostulantesController::class, 'index']);
        Route::get('/create', [PostulantesController::class, 'create']);
        Route::post('/', [PostulantesController::class, 'store']);
        Route::get('editar/{id}', [PostulantesController::class, 'edit']);
        Route::put('/{id}', [PostulantesController::class, 'update']);
        Route::delete('/{id}', [PostulantesController::class, 'destroy']);
    });
    Route::prefix('evaluacion-postulante')->group(function () {
        Route::get('/{id}', [EvaluacionPostulanteController::class, 'listaEvaluacion']);
        Route::get('/preview/{id}', [EvaluacionPostulanteController::class, 'listaPreview']);
        Route::get('/', [EvaluacionPostulanteController::class, 'index']);
        Route::post('/', [EvaluacionPostulanteController::class, 'store']);
        Route::get('editar/{id}', [EvaluacionPostulanteController::class, 'edit']);
        Route::put('/{id}', [EvaluacionPostulanteController::class, 'update']);
        Route::delete('/{id}', [EvaluacionPostulanteController::class, 'destroy']);
    });
    Route::prefix('enlace')->group(function () {
        Route::get('/', [EnlaceController::class, 'index']);
        Route::post('/', [EnlaceController::class, 'store']);
        Route::get('/{id}', [EnlaceController::class, 'show']);
        Route::put('/{id}', [EnlaceController::class, 'update']);
    });
    Route::prefix('evaluacion')->group(function () {
        Route::get('/', [EvaluacionController::class, 'index']);
        Route::get('/create', [EvaluacionController::class, 'create']);
        Route::post('/', [EvaluacionController::class, 'store']);
        Route::get('editar/{id}', [EvaluacionController::class, 'edit']);
        Route::put('/{id}', [EvaluacionController::class, 'update']);
        Route::delete('/{id}', [EvaluacionController::class, 'destroy']);
    });
    Route::prefix('evaluador')->group(function () {
        Route::get('/', [EvaluadorController::class, 'index']);
        Route::get('/create', [EvaluadorController::class, 'create']);
        Route::post('/', [EvaluadorController::class, 'store']);
        Route::get('editar/{id}', [EvaluadorController::class, 'edit']);
        Route::put('/{id}', [EvaluadorController::class, 'update']);
        Route::delete('/{id}', [EvaluadorController::class, 'destroy']);
    });
    Route::prefix('pregunta')->group(function () {
        Route::post('/', [PreguntaController::class, 'store']);
    });
    Route::prefix('test')->group(function () {
        Route::get('/', [TestController::class, 'index']);
        Route::get('/create', [TestController::class, 'create']);
        Route::post('/', [TestController::class, 'store']);
        Route::get('/edit/{id}', [TestController::class, 'show']);
        Route::get('/show/{id}', [TestController::class, 'edit']);
        Route::put('/{id}', [TestController::class, 'update']);
        Route::delete('/delete/{id}', [TestController::class, 'destroy']);
    });
    Route::prefix('test-resultado')->group(function () {
        Route::get('/', [TestResultadoController::class, 'index']);
        Route::get('/create/{test_id}/{postulante_id}/{evaluacion_id}', [TestResultadoController::class, 'create']);
        Route::get('/ejemplo/{test_id}/{postulante_id}/{evaluacion_id}', [TestResultadoController::class, 'ejemplo']);
        Route::post('/{test_id}/{postulante_id}', [TestResultadoController::class, 'store']);
        Route::get('/edit/{id}', [TestResultadoController::class, 'show']);
        Route::get('/show/{id}', [TestResultadoController::class, 'edit']);
        Route::put('/{id}', [TestResultadoController::class, 'update']);
        Route::delete('/delete/{id}', [TestResultadoController::class, 'destroy']);
    });
    Route::prefix('resultado-evaluacion')->group(function () {
        Route::post('/{test_id}/{postulante_id}', [ResultadoEvaluacion::class, 'store']);

        Route::get('/edit/{id}', [ResultadoEvaluacion::class, 'show']);
        Route::get('/show/{id}', [ResultadoEvaluacion::class, 'edit']);
        Route::put('/{id}', [ResultadoEvaluacion::class, 'update']);
        Route::delete('/delete/{id}', [ResultadoEvaluacion::class, 'destroy']);
        Route::get('/report_pdf/{tipo}', [ResultadoEvaluacion::class, 'report_pdf']);
        Route::get('/{evaluacion_id}/{postulante_id}', [ResultadoEvaluacion::class, 'index']);
        Route::get('/create/{test_id}/{postulante_id}', [ResultadoEvaluacion::class, 'create']);
    });
});
Route::prefix('resultado-report')->group(function () {
    Route::get('/report_pdf/{evaluacion_id}/{postulante_id}/{test_evaluacion_id}/{resultado_test_id}', [ResultadoEvaluacion::class, 'report_pdf']);
    Route::get('/report_excel/{evaluacion_id}/{postulante_id}/{test_evaluacion_id}/{resultado_test_id}', [ResultadoEvaluacion::class, 'report_excel']);
});
