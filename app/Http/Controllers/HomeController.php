<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BookController;
use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Models\Book;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $users = UserResource::collection(User::all());
        $books = BookResource::collection(Book::all());
        
        return view("home", compact('users', 'books'));
    }
}
