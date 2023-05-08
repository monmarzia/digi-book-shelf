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

    private static function setBooksParams($books) {
        $booksWithParams = [];
        foreach($books as $book) {
            $booksWithParams [] = [
                'details' => $book,
                'added' => $book->pivot->added,
                'removed' => $book->pivot->deleted,
                'ended' => $book->pivot->ended,
            ];
        }
        return $booksWithParams;
    }

    public static function getBooks($user_id)
    {
        return User::setBooksParams(static::getUser($user_id)->books);
    }

    public static function getBookDetails($user_id, $book_id)
    {
        $book = static::getUser($user_id)->books()->find($book_id);
        $bookWithParams = [
            'details' => $book,
            'added' => $book->pivot->added,
            'removed' => $book->pivot->deleted,
            'ended' => $book->pivot->ended
        ];
        return $bookWithParams;
    }

    public static function addBooks($user_id, $book_ids)
    {
        $user = static::getUser($user_id);
        foreach ($book_ids as $id) {
            $user->books()->syncWithoutDetaching($id);
            $user->books()->updateExistingPivot($id, ['added' => now()]);
        }
        return User::setBooksParams($user->books);
    }

    public static function removeBook($user_id, $book_id)
    {
        $user = static::getUser($user_id);
        $book = $user->books()->find($book_id);
        if (!$book) {
            // throw error
            return User::setBooksParams($user->books);
        }
        $user->books()->updateExistingPivot($book_id, ['deleted' => now()]);
        return User::setBooksParams($user->books);
    }

    public static function updateBooks($user_id, $book_ids)
    {
        $user = static::getUser($user_id);
        foreach ($book_ids as $id) {
            $user->books()->where('id', $id)->increment('reading', 1);
            $user->books()->updateExistingPivot($id, ['ended' => true]);
        }
        return User::setBooksParams($user->books);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps()->withPivot(['added', 'deleted', 'ended']);
    }
}