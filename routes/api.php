<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ColaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\GrupoEstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PlanEstudioController;
use App\Http\Controllers\RabbitMQController;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes();

Route::post('/login', [AuthController::class, 'login']);

Route::post('colas/', [ColaController::class, 'asignarWorkers']);
Route::post('colas/estado', [ColaController::class, 'estado']);
Route::get('colas/estado-hilos', [ColaController::class, 'estadoHilos']);
Route::post('colas/estado-un-hilo', [ColaController::class, 'cambiarEstadoHilo']);
Route::post('colas/eliminar', [ColaController::class, 'eliminarCola']);

Route::get('/rabbitmq/info-colas', [RabbitMQController::class, 'getInfoColas']);
Route::get('/rabbitmq/longitudes-colas', [RabbitMQController::class, 'getLongitudesColas']);
Route::post('/rabbitmq/crear-cola', [RabbitMQController::class, 'crearCola']);

//Hola mundo
Route::get('/hola', function () {
    return response()->json(['message' => 'Hola tópicos Postgres']);
});

// Route::get('/plan-estudio/{carrera}', [PlanEstudioController::class, 'getMaterias']);
Route::get('/materias', [MateriaController::class, 'index']);

Route::apiResource('facultades', FacultadController::class)->parameters(['facultades' => 'facultad']);
Route::apiResource('carreras', CarreraController::class);
Route::apiResource('planes-estudio', PlanEstudioController::class);

// Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Route::get('/plan-estudio/{carrera}', [PlanEstudioController::class, 'getMaterias']);
    Route::get('/materias-carrera/{carrera}', [MateriaController::class, 'obtenerMateriasUltimoPlan']);
    // Route::get('/materias', [MateriaController::class, 'index']);
    Route::post('/materias', [MateriaController::class, 'store']);
    Route::get('/materias/{id}', [MateriaController::class, 'show']);
    Route::put('/materias/{id}', [MateriaController::class, 'update']);
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy']);

    // CRUD Estudiantes
    Route::get('/estudiantes', [EstudianteController::class, 'index']);
    Route::post('/estudiantes', [EstudianteController::class, 'store']);
    Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);
    Route::put('/estudiantes/{id}', [EstudianteController::class, 'update']);
    Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy']);

    // CRUD Docentes
    Route::get('/docentes', [DocenteController::class, 'index']);
    Route::post('/docentes', [DocenteController::class, 'store']);
    Route::get('/docentes/{id}', [DocenteController::class, 'show']);
    Route::put('/docentes/{id}', [DocenteController::class, 'update']);
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy']);

    // CRUD Gestiones
    Route::get('/gestiones', [GestionController::class, 'index']);
    Route::post('/gestiones', [GestionController::class, 'store']);
    Route::get('/gestiones/{id}', [GestionController::class, 'show']);
    Route::put('/gestiones/{id}', [GestionController::class, 'update']);
    Route::delete('/gestiones/{id}', [GestionController::class, 'destroy']);

    // CRUD Aulas
    Route::get('/aulas', [AulaController::class, 'index']);
    Route::post('/aulas', [AulaController::class, 'store']);
    Route::get('/aulas/{id}', [AulaController::class, 'show']);
    Route::put('/aulas/{id}', [AulaController::class, 'update']);
    Route::delete('/aulas/{id}', [AulaController::class, 'destroy']);

    // CRUD Módulos
    Route::get('/modulos', [ModuloController::class, 'index']);
    Route::post('/modulos', [ModuloController::class, 'store']);
    Route::get('/modulos/{id}', [ModuloController::class, 'show']);
    Route::put('/modulos/{id}', [ModuloController::class, 'update']);
    Route::delete('/modulos/{id}', [ModuloController::class, 'destroy']);

    // CRUD Grupos
    Route::get('/grupos', [GrupoController::class, 'index']);
    Route::post('/grupos', [GrupoController::class, 'store']);
    Route::get('/grupos/{id}', [GrupoController::class, 'show']);
    Route::put('/grupos/{id}', [GrupoController::class, 'update']);
    Route::delete('/grupos/{id}', [GrupoController::class, 'destroy']);

    // CRUD Horarios
    Route::get('/horarios', [HorarioController::class, 'index']);
    Route::post('/horarios', [HorarioController::class, 'store']);
    Route::get('/horarios/{id}', [HorarioController::class, 'show']);
    Route::put('/horarios/{id}', [HorarioController::class, 'update']);
    Route::delete('/horarios/{id}', [HorarioController::class, 'destroy']);

    // CRUD Inscripciones
    Route::get('/inscripciones', [InscripcionController::class, 'index']);
    Route::post('/inscripciones', [InscripcionController::class, 'store']);
    Route::get('/inscripciones/{id}', [InscripcionController::class, 'show']);
    Route::put('/inscripciones/{id}', [InscripcionController::class, 'update']);
    Route::delete('/inscripciones/{id}', [InscripcionController::class, 'destroy']);

    // CRUD Grupo-Estudiante (tabla pivot)
    Route::get('/grupo-estudiante', [GrupoEstudianteController::class, 'index']);
    Route::post('/grupo-estudiante', [GrupoEstudianteController::class, 'store']);
    Route::get('/grupo-estudiante/{id}', [GrupoEstudianteController::class, 'show']);
    Route::put('/grupo-estudiante/{id}', [GrupoEstudianteController::class, 'update']);
    Route::delete('/grupo-estudiante/{id}', [GrupoEstudianteController::class, 'destroy']);

    // Rutas especiales para consultas específicas
    Route::get('/estudiantes/{estudiante_id}/notas', [GrupoEstudianteController::class, 'notasEstudiante']);
// });


use Illuminate\Support\Facades\Artisan;
Route::get('/procesar-cola/{cola}', function($cola) {
    Artisan::call('queue:work', [
        '--queue' => $cola,
        '--once' => true,
    ]);

    return "Cola '$cola' procesada.";
});

Route::get('/detener-cola', function() {
    Artisan::call('queue:restart');
    return "Worker de la cola detenido.";
});

use App\Http\Controllers\EstadoController;
Route::get('/estado/{uuid}', [EstadoController::class, 'consultarEstado']);


