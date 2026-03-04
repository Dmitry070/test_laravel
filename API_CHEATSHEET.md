# 🚀 Шпаргалка: API Ответы в Laravel

## ❌ ❌ ❌ НЕПРАВИЛЬНО

```php
// В API контроллере НЕ ИСПОЛЬЗУЙТЕ:

return view('posts');              // ❌ HTML вместо JSON
return response('', 200);          // ❌ Текст вместо JSON
return 'OK';                       // ❌ Строка вместо JSON
return $post;                      // ❌ Массив вместо JSON
```

---

## ✅ ✅ ✅ ПРАВИЛЬНО

```php
// В API контроллере ИСПОЛЬЗУЙТЕ:

// GET - Получить (код 200)
return response()->json($posts);
return response()->json($post);

// POST - Создать (код 201)
return response()->json($post, 201);

// PUT/PATCH - Обновить (код 200)
return response()->json($post);

// DELETE - Удалить (код 204 - без содержимого)
return response(null, 204);

// Ошибка валидации (код 422)
return response()->json(['errors' => $errors], 422);
```

---

## 🔧 Полезные команды

```bash
# Сбросить таблицу posts (очистить и ID=1)
php artisan posts:reset

# Очистить кэш
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Посмотреть маршруты
php artisan route:list --path=api
```

---

## 📋 Быстрая справка по HTTP кодам

```
200 ✅ OK             - GET/PUT/PATCH успех
201 ✅ Created        - POST успех (ресурс создан)
204 ✅ No Content     - DELETE успех (без тела ответа)

400 ❌ Bad Request    - Неправильные данные
401 ❌ Unauthorized   - Нет авторизации
404 ❌ Not Found      - Ресурс не найден
422 ❌ Unprocessable  - Ошибка валидации
500 ❌ Server Error   - Ошибка сервера
```

---

## 📝 Полный пример контроллера

```php
<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController
{
    // 1️⃣ GET /api/posts - Список
    public function index()
    {
        return response()->json(Post::paginate(10));
    }

    // 2️⃣ POST /api/posts - Создать
    public function store(Request $request)
    {
        $post = Post::create($request->validated());
        return response()->json($post, 201);  // ← Код 201!
    }

    // 3️⃣ GET /api/posts/{id} - Один
    public function show(Post $post)
    {
        return response()->json($post);
    }

    // 4️⃣ PUT /api/posts/{id} - Обновить
    public function update(Request $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    // 5️⃣ DELETE /api/posts/{id} - Удалить
    public function destroy(Post $post)
    {
        $post->delete();
        return response(null, 204);  // ← Код 204!
    }
}
```

---

## 📌 Файлы, исправленные в проекте

1. **routes/api.php** - добавлены комментарии о правильных ответах
2. **routes/web.php** - добавлены комментарии о разнице WEB и API
3. **app/Http/Controllers/Api/PostController.php** - добавлены пояснения

---

**Создано:** 2026-03-04

