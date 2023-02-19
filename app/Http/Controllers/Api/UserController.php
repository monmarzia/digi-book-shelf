<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return UserResource::collection(User::all());
    }

    public function getUser($id) {
        return User::getUser($id);
    }

    public function getBooks($user_id) {
        return User::getBooks($user_id);
    }
    public function bookDetails($user_id, $book_id) {
        return User::getBookDetails($user_id, $book_id);
    }
    public function addBooks(Request $request, $user_id) {
        $book_ids = $request->collect('ids');
        return User::addBooks($user_id, $book_ids);
    }

    public function removeBook(Request $request, $user_id) {
        $book_id = $request->collect('bookId');
        return User::removeBook($user_id, $book_id);
    }

    public function endBook($request){
        User::endBook($request->id, $request->book_id);
        return User::getBooks($request->id);
    }
}
