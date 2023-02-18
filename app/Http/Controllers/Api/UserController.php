<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
        $books =  User::getBooks($user_id);
        // dd($books);
        return $books;
    }

    public function addBooks(Request $request, $user_id) {
        // dd($request->collect('ids'));
        $book_ids = $request->collect('ids');
        User::addBooks($user_id, $book_ids);
        $books =  User::getBooks($user_id);
        // dd($books);
        return $books;
    }

    public function removeBook($request) {
        User::removeBook($request->id, $request->book_id);
        return User::getBooks($request->id);
    }

    public function endBook($request){
        User::endBook($request->id, $request->book_id);
        return User::getBooks($request->id);
    }
}
