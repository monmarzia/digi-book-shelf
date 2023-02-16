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
        $user = User::getUser($id);
        
        return $user;
    }

    public static function getBooks($user_id) {
        return User::getBooks($user_id);
    }

    public static function addBooks($request) {
        User::addBooks($request->id, $request->book_id);
        return User::getBooks($request->id);
    }

    public static function removeBook($request) {
        User::removeBook($request->id, $request->book_id);
        return User::getBooks($request->id);
    }

    public static function endBook($request){
        User::endBook($request->id, $request->book_id);
        return User::getBooks($request->id);
    }
}
