<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUser($id) {
        return static::find($id);
    }

    public static function getBooks($user_id) {
        $user = static::getUser($user_id);
        return $user->books;
    }

    public static function addBooks($user_id, $book_ids) {
        $user = static::getUser($user_id);
        $user->books()->attach($book_ids);
        return $user->books;
        // if($user->books.contains($book_ids)) return;
    }

    public static function removeBook($user_id, $book_id) {
        $user = static::getUser($user_id);
        if(!$user->books->contains($book_id)) return;
        $book = $user->books->find($book_id);
        $book->removed_at(now());
    }

    public static function endBook($user_id, $book_id) {
        $user = static::getUser($user_id);
        if(!$user->books.contains($book_id)) return;
        $book = $user->books::find($book_id);
        $book->reading += 1;
        $book->save();
    }

    public function books() {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
