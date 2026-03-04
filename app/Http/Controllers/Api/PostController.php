<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * API контроллер для управления постами
 *
 * Этот контроллер реализует полный CRUD (Create, Read, Update, Delete) для постов.
 * Все методы возвращают JSON ответы.
 *
 * ❌ Так НЕ работает для API:
 * return view('test');           // Вернёт HTML вместо JSON
 * return response('', 200);      // Вернёт пустой текст вместо JSON
 *
 * ✅ Правильно для API контроллера:
 * return response()->json($data);           // JSON с данными и кодом 200
 * return response()->json($data, 201);      // JSON с кодом 201 (Created)
 * return response(null, 204);               // Пустой ответ с кодом 204 (No Content)
 */
class PostController extends Controller
{
    /**
     * Получить список всех постов с пагинацией
     *
     * GET /api/posts
     *
     * Пример ответа:
     * {
     *   "data": [{"id": 1, "title": "Заголовок", "body": "Текст", ...}],
     *   "current_page": 1,
     *   "total": 30
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    /**
     * Создать новый пост
     *
     * POST /api/posts
     *
     * Ожидаемые данные:
     * {
     *   "title": "Заголовок поста",
     *   "body": "Содержание поста"
     * }
     *
     * Пример успешного ответа (201 Created):
     * {
     *   "id": 1,
     *   "title": "Заголовок поста",
     *   "body": "Содержание поста",
     *   "created_at": "2026-03-03T12:00:00.000000Z",
     *   "updated_at": "2026-03-03T12:00:00.000000Z"
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'title' => 'required|string|max:255',  // title обязателен, максимум 255 символов
            'body' => 'required|string',           // body обязателен
        ]);

        // Создаём новый пост в базе данных
        $post = Post::create($validated);

        // Возвращаем созданный пост с кодом 201 (Created)
        return response()->json($post, Response::HTTP_CREATED);
    }

    /**
     * Получить конкретный пост по ID
     *
     * GET /api/posts/{id}
     *
     * Пример: GET /api/posts/1
     *
     * Ответ (200 OK):
     * {
     *   "id": 1,
     *   "title": "Заголовок",
     *   "body": "Содержание",
     *   "created_at": "2026-03-03T12:00:00.000000Z",
     *   "updated_at": "2026-03-03T12:00:00.000000Z"
     * }
     *
     * Если пост не найден: 404 Not Found
     *
     * @param \App\Models\Post $post (автоматически загружается из БД)
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        // Laravel автоматически находит пост по ID из URL
        // Если пост не найден, вернётся 404 ошибка
        return response()->json($post);
    }

    /**
     * Обновить существующий пост
     *
     * PUT/PATCH /api/posts/{id}
     *
     * Пример: PUT /api/posts/1
     *
     * Данные для обновления (можно отправить одно или оба поля):
     * {
     *   "title": "Новый заголовок",
     *   "body": "Новое содержание"
     * }
     *
     * Ответ (200 OK):
     * {
     *   "id": 1,
     *   "title": "Новый заголовок",
     *   "body": "Новое содержание",
     *   "created_at": "2026-03-03T12:00:00.000000Z",
     *   "updated_at": "2026-03-03T12:05:00.000000Z"
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        // Валидация: поля опциональны (sometimes), но если присутствуют - обязательны
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        // Обновляем пост в базе данных
        $post->update($validated);

        // Возвращаем обновлённый пост
        return response()->json($post);
    }

    /**
     * Удалить пост из базы данных
     *
     * DELETE /api/posts/{id}
     *
     * Пример: DELETE /api/posts/1
     *
     * Ответ: 204 No Content (пустой ответ, пост успешно удалён)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Удаляем пост из базы данных
        $post->delete();

        // Возвращаем пустой ответ с кодом 204 (No Content)
        return response(null, Response::HTTP_NO_CONTENT);
    }
}


