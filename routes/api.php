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
    Route::get('user/{id}/books/{book_id}', [BookController::class, 'bookDetails']); // Lista di tutti i libri aggiunti alla libreria dell'utente
    Route::post('user/{id}/books/add', [UserController::class, 'addBook']); // Aggiunta di un libro alla libreria con $id
    Route::post('user/{id}/books/{book_id}/add', [UserController::class, 'addBook']); // Aggiunta di un libro alla libreria con $id
    Route::post('user/{id}/books/{book_id}/remove', [UserController::class, 'removeBook']); // Impostazione "rimosso" a un libro della libreria con $id
    Route::post('user/{id}/books/{book_id}/readed', [UserController::class, 'endBook']); // Impostazione "letto" a un libro della libreria con $id
});