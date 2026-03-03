<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель поста
 *
 * Эта модель представляет запись в таблице 'posts' базы данных.
 * Содержит заголовок (title) и содержание (body) поста.
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять
     *
     * Эти поля разрешены для создания/обновления через Post::create() или $post->update()
     * Это защита от массового назначения (mass assignment protection)
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',  // Заголовок поста
        'body',   // Содержание поста
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в определённые типы
     *
     * Laravel автоматически преобразует created_at и updated_at в Carbon даты
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}


