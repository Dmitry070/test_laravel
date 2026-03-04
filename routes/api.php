<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TestController;

/**
 * ==============================================
 * API МАРШРУТЫ ДЛЯ CRUD ПОСТОВ
 * ==============================================
 *
 * Все маршруты имеют префикс /api и используют middleware 'api'
 * который автоматически преобразует ответы в JSON
 *
 * ❌ Так НЕ работает для API (в контроллере):
 * return view('test');           // Вернёт HTML вместо JSON!
 * return response('', 200);      // Вернёт текст вместо JSON!
 *
 * ✅ Правильно для API:
 * return response()->json($data);           // Вернёт JSON с данными
 * return response()->json($data, 201);      // JSON с кодом 201 (Created)
 * return response(null, 204);               // Пустой JSON 204 (No Content)
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

/**
 * ==============================================
 * МАРШРУТ ДЛЯ ТЕСТИРОВАНИЯ (ПОЛНЫЙ CRUD)
 * ==============================================
 *
 * GET    /api/test       - Получить все посты
 * POST   /api/test       - Создать новый пост
 * GET    /api/test/{id}  - Получить один пост
 * PUT    /api/test/{id}  - Обновить пост
 * DELETE /api/test/{id}  - Удалить пост
 */
Route::apiResource('test', TestController::class, [
    'parameters' => ['test' => 'post']
]);

