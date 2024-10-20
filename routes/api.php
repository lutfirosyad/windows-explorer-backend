<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/folders', [FolderController::class, 'index']);


// Route::get('/folders/{id}/subfolders', [FolderController::class, 'showSubfolders']);
Route::get('/folders/{id}/subfolders', [FolderController::class, 'subfolders']);

Route::post('/folders', [FolderController::class, 'store']);
Route::delete('/folders/{id}', [FolderController::class, 'destroy']);


Route::get('folders/{folderId}/files', [FileController::class, 'index']);
Route::post('folders/{folderId}/files', [FileController::class, 'store']);

// Route::get('/folders/{folder_id}/files', [FileController::class, 'index']);
// Route::post('/files', [FileController::class, 'store']);
// Route::delete('/files/{id}', [FileController::class, 'destroy']);