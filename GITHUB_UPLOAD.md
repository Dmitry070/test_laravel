# 📤 Как загрузить проект на GitHub

## Шаг 1: Создайте репозиторий на GitHub

1. Перейдите на [github.com](https://github.com)
2. Нажмите **"+"** в правом верхнем углу
3. Выберите **"New repository"**
4. Введите имя: `example-app` (или любое другое)
5. Описание: "Laravel CRUD API - Полный проект с интерактивным тестером"
6. Выберите **Public** (чтобы все могли видеть)
7. **НЕ** инициализируйте README, .gitignore или LICENSE (они уже есть)
8. Нажмите **"Create repository"**

## Шаг 2: Добавьте файлы в Git

```bash
cd /home/project/example-app

# Добавьте все файлы в staging
git add .

# Проверьте какие файлы будут добавлены
git status

# Создайте первый commit
git commit -m "Начальная загрузка: Laravel CRUD API с интерактивным тестером"
```

## Шаг 3: Добавьте remote и push

Замените `your-username` на ваше имя пользователя GitHub:

```bash
# Добавьте remote репозиторий
git remote add origin https://github.com/your-username/example-app.git

# Переименуйте ветку в main (опционально)
git branch -M main

# Загрузите код на GitHub
git push -u origin main
```

## Шаг 4: Проверьте на GitHub

1. Откройте https://github.com/your-username/example-app
2. Проверьте что все файлы загружены
3. README.md должен отобразиться на главной странице

## Что будет загружено:

✅ Все исходные коды  
✅ Конфигурация (`.env.example`)  
✅ Документация (`README.md`)  
✅ Лицензия (`LICENSE`)  
✅ Правила контрибьютинга (`CONTRIBUTING.md`)  
✅ Git attributes (`.gitattributes`)  

## Что НЕ будет загружено (благодаря .gitignore):

❌ `/vendor` (зависимости Composer)  
❌ `/node_modules` (зависимости npm)  
❌ `.env` (приватная конфигурация)  
❌ `/storage/logs`  
❌ Локальные кеши и сессии  

## Полезные команды после загрузки:

```bash
# Синхронизировать локальные изменения с GitHub
git add .
git commit -m "Описание изменений"
git push

# Проверить статус
git status

# Просмотреть историю commits
git log --oneline
```

## Клонирование проекта другими пользователями:

```bash
git clone https://github.com/your-username/example-app.git
cd example-app

# Установить зависимости
composer install
npm install

# Скопировать конфигурацию
cp .env.example .env
php artisan key:generate

# Запустить миграции и сидеры
php artisan migrate:fresh --seed

# Запустить сервер
php artisan serve
```

## Готово! 🎉

Ваш проект теперь на GitHub и доступен для всех!

Для дополнительной помощи смотрите:
- [GitHub Docs](https://docs.github.com)
- [Git Documentation](https://git-scm.com/doc)

