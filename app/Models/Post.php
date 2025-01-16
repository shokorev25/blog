<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Указываем поля, которые могут быть массово присвоены
    protected $fillable = ['title', 'content', 'is_published'];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}