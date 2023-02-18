<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function getBook($id) {
        return static::find($id);
    }
    
    public static function endBook($book_id) {
        $book = self::getBook($book_id)->reading += 1;
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
