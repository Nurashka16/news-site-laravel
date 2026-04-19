<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Разрешаем заполнять все поля (или укажите конкретные)
    protected $fillable = [
        'title', 'description', 'content', 
        'preview_image', 'full_image', 'published_at'
    ];
}