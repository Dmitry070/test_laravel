# 🚀 Laravel CRUD API - Полный проект

Полнофункциональный REST API для управления постами в Laravel 12 с интерактивным HTML тестером.

---

## 📋 Быстрый старт

### 1. Запустить MySQL через Sail
```bash
./vendor/bin/sail up -d mysql
```

### 2. Запустить Laravel сервер
```bash
php artisan serve
```

### 3. Открыть в браузере тестер API
```
http://127.0.0.1:8000/api/test
```

---

## 🎯 API Endpoints

| Метод | URL | Описание |
|-------|-----|----------|
| **GET** | `/api/posts` | Получить все посты (10 на странице) |
| **POST** | `/api/posts` | Создать новый пост |
| **GET** | `/api/posts/{id}` | Получить конкретный пост |
| **PUT** | `/api/posts/{id}` | Обновить пост |
| **DELETE** | `/api/posts/{id}` | Удалить пост |

---

## 📝 Примеры использования

### Получить все посты
```bash
curl http://127.0.0.1:8000/api/posts
```

### Создать пост
```bash
curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"Заголовок","body":"Содержание"}'
```

### Получить пост
```bash
curl http://127.0.0.1:8000/api/posts/1
```

### Обновить пост
```bash
curl -X PUT http://127.0.0.1:8000/api/posts/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Новый заголовок","body":"Новое содержание"}'
```

### Удалить пост
```bash
curl -X DELETE http://127.0.0.1:8000/api/posts/1
```

---

## 🧪 Интерактивный HTML Тестер

Откройте в браузере: **http://127.0.0.1:8000/api/test**

### Возможности:
- ✅ Создавать, читать, обновлять и удалять посты
- ✅ Видеть JSON ответы в реальном времени
- ✅ Автоматический тест всех операций
- ✅ Счётчик запросов и статус-коды
- ✅ Адаптивный интерфейс

---

## 📂 Структура проекта

```
example-app/
├── README.md                          ← Этот файл
├── resources/
│   └── views/
│       └── test.blade.php            ← Интерактивный тестер API
├── routes/
│   ├── api.php                        ← API маршруты
│   └── web.php                        ← Маршрут /test
├── app/
│   ├── migrations/
│   │   └── 2026_03_03_173610_create_posts_table.php
│   ├── factories/
│   │   └── PostFactory.php            ← Генератор тестовых данных
│   └── seeders/
│       └── PostSeeder.php             ← Заполнение БД данными
└── ...другие файлы Laravel
```

---

## 📖 Важно: Правильные ответы для API

> ❌ Для API НЕ ИСПОЛЬЗУЙТЕ: `return view()` или `return response('', 200)`  
> ✅ ВСЕГДА ИСПОЛЬЗУЙТЕ: `return response()->json($data)`

Подробное руководство смотрите в файлах:
- **[API_RESPONSES_GUIDE.md](./API_RESPONSES_GUIDE.md)** - полное руководство
- **[API_CHEATSHEET.md](./API_CHEATSHEET.md)** - быстрая справка

---

## 🎓 Код с подробными комментариями

Все файлы полностью на русском с примерами:

### PostController.php
Содержит 5 методов CRUD:
- `index()` - GET список постов
- `store()` - POST создание
- `show()` - GET один пост
- `update()` - PUT обновление
- `destroy()` - DELETE удаление

Каждый метод имеет подробные комментарии с примерами запросов и ответов.

### Post.php
Модель данных с объяснением всех свойств:
- `$fillable` - защита от массового присваивания
- `$casts` - преобразование типов данных
- Аннотации @property для IDE

### api.php
RESTful маршруты с примерами curl команд для каждой операции.

---

## 🔧 Полезные команды

```bash
# Посмотреть все API маршруты
php artisan route:list --path=api

# Создать тестовые данные
php artisan db:seed --class=PostSeeder

# Пересоздать БД с данными
php artisan migrate:fresh --seed

# ✨ НОВОЕ: Очистить таблицу posts и сбросить ID на 1
php artisan posts:reset

# Очистить кэши
php artisan optimize:clear

# Интерактивная оболочка
php artisan tinker
```

---

## 📊 HTTP Коды ответов

| Код | Значение | Когда |
|-----|----------|-------|
| 200 | OK | Успешный GET/PUT |
| 201 | Created | Пост создан |
| 204 | No Content | Пост удалён |
| 404 | Not Found | Пост не найден |
| 422 | Validation Error | Ошибка валидации |

---

## ✨ Ключевые концепции

### Route Model Binding
Laravel автоматически загружает модель по ID из URL:
```php
public function show(Post $post) {
    // $post уже загружен из БД
}
```

### Валидация
```php
$request->validate([
    'title' => 'required|string|max:255',
    'body' => 'required|string'
]);
```

### Mass Assignment Protection
```php
protected $fillable = ['title', 'body'];
// Только эти поля разрешены!
```

---

## 🚀 Запуск тестов

### Через HTML Тестер
1. Откройте http://127.0.0.1:8000/test
2. Нажмите "Запустить полный тест"
3. Посмотрите результаты

### Через curl
```bash
# Создать пост
curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"Test","body":"Content"}'

# Получить все
curl http://127.0.0.1:8000/api/posts

# Обновить
curl -X PUT http://127.0.0.1:8000/api/posts/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Updated"}'

# Удалить
curl -X DELETE http://127.0.0.1:8000/api/posts/1
```

---

## 📖 Дополнительно

- [Laravel документация](https://laravel.com/docs)
- [REST API лучшие практики](https://restfulapi.net/)
- [HTTP методы](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods)

---

## ✅ Что реализовано

- ✓ Полный CRUD API для постов
- ✓ Валидация данных
- ✓ Route Model Binding
- ✓ Mass Assignment Protection
- ✓ Пагинация
- ✓ JSON ответы
- ✓ Подробные комментарии на русском
- ✓ Интерактивный HTML тестер
- ✓ Примеры во всех методах
- ✓ Красивый интерфейс тестера

---

**Версия:** Laravel 12.53.0  
**PHP:** 8.3.6  
**Дата:** 2026-03-03  

Готово к использованию! 🎉

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
