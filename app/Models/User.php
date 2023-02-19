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

    public static function getUser($id)
    {
        return static::find($id);
    }

    public static function getBooks($user_id)
    {
        return static::getUser($user_id)->books;
    }

    public static function getBookDetails($user_id, $book_id) {
        $book = static::getUser($user_id)->books()->find($book_id);
        $bookDetails = [
            'details' => $book,
            'added' => $book->pivot->added,
            'removed' => $book->pivot->deleted
        ];
        return $bookDetails;
    }

    public static function addBooks($user_id, $book_ids)
    {
        $user = static::getUser($user_id);
        foreach ($book_ids as $id) {
            $user->books()->detach($id);
            $user->books()->attach($id, ['added' => now()]);
        }
        return $user->books;
    }

    public static function removeBook($user_id, $book_id)
    {
        $user = static::getUser($user_id);
        $book = $user->books()->find($book_id);
        if(!$book){
            // throw error
            return $user->books;
        }
        $user->books()->detach($book_id);
        $user->books()->attach($book_id, ['deleted' => now()]);  
        return $user->books;
    }


    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps()->withPivot(['added', 'deleted']);
    }
}