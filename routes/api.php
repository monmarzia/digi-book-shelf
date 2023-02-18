<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;

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
Route::middleware(['cors'])->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);

    Route::get('user/{id}', [UserController::class, 'getUser']);
    Route::get('user/{id}/books/', [UserController::class, 'getBooks']); // Lista di tutti i libri aggiunti alla libreria dell'utente
    Route::post('user/{id}/books/add', [UserController::class, 'addBooks']); // Aggiunta di un libro alla libreria con $id
    Route::post('user/{id}/books/remove', [UserController::class, 'removeBook']); // Impostazione "rimosso" a un libro della libreria con $id
    
    Route::get('book/{book_id}/details', [BookController::class, 'bookDetails']); // Lista di tutti i libri aggiunti alla libreria dell'utente
    Route::post('book/{book_id}/readed', [BookController::class, 'endBook']); // Impostazione "letto" a un libro della libreria con $id
});