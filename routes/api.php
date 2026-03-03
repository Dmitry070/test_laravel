<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

/**
 * ==============================================
 * API МАРШРУТЫ ДЛЯ CRUD ПОСТОВ
 * ==============================================
 *
 * Все маршруты имеют префикс /api и используют middleware 'api'
 * который автоматически преобразует ответы в JSON
 */

/**
 * RESTful API маршруты для управления постами
 *
 * apiResource автоматически создаёт все CRUD маршруты:
 *
 * GET    /api/posts           - index()   - Получить список всех постов (с пагинацией)
 * POST   /api/posts           - store()   - Создать новый пост
 * GET    /api/posts/{id}      - show()    - Получить конкретный пост по ID
 * PUT    /api/posts/{id}      - update()  - Обновить пост (полное обновление)
 * PATCH  /api/posts/{id}      - update()  - Обновить пост (частичное обновление)
 * DELETE /api/posts/{id}      - destroy() - Удалить пост
 *
 * Примеры использования:
 *
 * 1. Получить все посты:
 *    curl http://127.0.0.1:8000/api/posts
 *
 * 2. Создать новый пост:
 *    curl -X POST http://127.0.0.1:8000/api/posts \
 *      -H "Content-Type: application/json" \
 *      -d '{"title":"Мой пост","body":"Содержание"}'
 *
 * 3. Получить пост с ID=1:
 *    curl http://127.0.0.1:8000/api/posts/1
 *
 * 4. Обновить пост:
 *    curl -X PUT http://127.0.0.1:8000/api/posts/1 \
 *      -H "Content-Type: application/json" \
 *      -d '{"title":"Новый заголовок","body":"Новое содержание"}'
 *
 * 5. Удалить пост:
 *    curl -X DELETE http://127.0.0.1:8000/api/posts/1
 */
Route::apiResource('posts', PostController::class);

