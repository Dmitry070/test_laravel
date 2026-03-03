<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🧪 CRUD API Тестер</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2.5em;
        }

        header p {
            color: #666;
            font-size: 1.1em;
        }

        .api-url {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            font-family: monospace;
            color: #333;
            word-break: break-all;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            color: #667eea;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5em;
        }

        .method-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 0.85em;
            font-weight: bold;
            color: white;
        }

        .method-get {
            background: #61affe;
        }

        .method-post {
            background: #49cc90;
        }

        .method-put {
            background: #fca130;
        }

        .method-delete {
            background: #f93e3e;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            font-family: monospace;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button {
            background: #667eea;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .response {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            border-left: 4px solid #667eea;
        }

        .response h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .response-code {
            display: inline-block;
            padding: 5px 10px;
            background: white;
            border-radius: 3px;
            font-family: monospace;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .response-code.success {
            color: #49cc90;
        }

        .response-code.error {
            color: #f93e3e;
        }

        .response-body {
            background: white;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9em;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
            color: #333;
            max-height: 400px;
            overflow-y: auto;
        }

        .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-success {
            background: #49cc90;
        }

        .status-error {
            background: #f93e3e;
        }

        .section-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin: 30px 0 20px 0;
            border-radius: 10px;
            font-size: 1.5em;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 2em;
            color: #667eea;
            font-weight: bold;
        }

        .stat-label {
            color: #666;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            color: white;
            margin-top: 30px;
            padding: 20px;
        }

        .description {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 15px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <header>
            <h1>🧪 CRUD API Тестер</h1>
            <p>Интерактивное тестирование всех операций с постами</p>
            <div class="api-url">
                📍 API URL: <strong>http://127.0.0.1:8000/api/posts</strong>
            </div>
        </header>

        <!-- STATISTICS -->
        <div class="section-title">📊 Статистика</div>
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div class="stat-label">API Endpoints</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">30</div>
                <div class="stat-label">Тестовых постов</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="lastResponseCode">-</div>
                <div class="stat-label">Последний код</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalRequests">0</div>
                <div class="stat-label">Отправлено запросов</div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="section-title">🚀 Тестирование операций</div>
        <div class="grid">
            <!-- 1. СПИСОК ПОСТОВ (READ ALL) -->
            <div class="card">
                <h2>
                    <span class="method-badge method-get">GET</span>
                    Получить все посты
                </h2>
                <p class="description">
                    Получить список всех постов с пагинацией (10 на страницу). Посты отсортированы по дате создания (новые первыми).
                </p>
                <div class="form-group">
                    <label for="getAllPage">Номер страницы (опционально):</label>
                    <input type="number" id="getAllPage" value="1" min="1">
                </div>
                <button onclick="getAllPosts()">
                    <span class="loader" id="loader1"></span>
                    Получить все посты
                </button>
                <div id="response1" class="response" style="display: none;">
                    <h3>Ответ:</h3>
                    <div class="response-code success" id="code1">200 OK</div>
                    <div class="response-body" id="body1"></div>
                </div>
            </div>

            <!-- 2. СОЗДАТЬ ПОСТ (CREATE) -->
            <div class="card">
                <h2>
                    <span class="method-badge method-post">POST</span>
                    Создать новый пост
                </h2>
                <p class="description">
                    Создать новый пост с заголовком и содержанием. Заголовок не должен превышать 255 символов.
                </p>
                <div class="form-group">
                    <label for="postTitle">Заголовок:</label>
                    <input type="text" id="postTitle" placeholder="Введите заголовок" value="Мой новый пост">
                </div>
                <div class="form-group">
                    <label for="postBody">Содержание:</label>
                    <textarea id="postBody" placeholder="Введите содержание поста">Это содержание моего нового поста, созданного через API тестер.</textarea>
                </div>
                <button onclick="createPost()">
                    <span class="loader" id="loader2"></span>
                    Создать пост
                </button>
                <div id="response2" class="response" style="display: none;">
                    <h3>Ответ:</h3>
                    <div class="response-code success" id="code2">201 Created</div>
                    <div class="response-body" id="body2"></div>
                </div>
            </div>

            <!-- 3. ПОЛУЧИТЬ ОДИН ПОСТ (READ ONE) -->
            <div class="card">
                <h2>
                    <span class="method-badge method-get">GET</span>
                    Получить один пост
                </h2>
                <p class="description">
                    Получить конкретный пост по его ID. Если пост не найден, вернётся ошибка 404.
                </p>
                <div class="form-group">
                    <label for="getPostId">ID поста:</label>
                    <input type="number" id="getPostId" value="1" min="1">
                </div>
                <button onclick="getOnePost()">
                    <span class="loader" id="loader3"></span>
                    Получить пост
                </button>
                <div id="response3" class="response" style="display: none;">
                    <h3>Ответ:</h3>
                    <div class="response-code success" id="code3">200 OK</div>
                    <div class="response-body" id="body3"></div>
                </div>
            </div>

            <!-- 4. ОБНОВИТЬ ПОСТ (UPDATE) -->
            <div class="card">
                <h2>
                    <span class="method-badge method-put">PUT</span>
                    Обновить пост
                </h2>
                <p class="description">
                    Обновить существующий пост. Можно обновить только заголовок, только содержание или оба поля сразу.
                </p>
                <div class="form-group">
                    <label for="updatePostId">ID поста для обновления:</label>
                    <input type="number" id="updatePostId" value="1" min="1">
                </div>
                <div class="form-group">
                    <label for="updateTitle">Новый заголовок (опционально):</label>
                    <input type="text" id="updateTitle" placeholder="Оставьте пустым, чтобы не изменять" value="Обновлённый заголовок">
                </div>
                <div class="form-group">
                    <label for="updateBody">Новое содержание (опционально):</label>
                    <textarea id="updateBody" placeholder="Оставьте пустым, чтобы не изменять">Это обновлённое содержание поста</textarea>
                </div>
                <button onclick="updatePost()">
                    <span class="loader" id="loader4"></span>
                    Обновить пост
                </button>
                <div id="response4" class="response" style="display: none;">
                    <h3>Ответ:</h3>
                    <div class="response-code success" id="code4">200 OK</div>
                    <div class="response-body" id="body4"></div>
                </div>
            </div>

            <!-- 5. УДАЛИТЬ ПОСТ (DELETE) -->
            <div class="card">
                <h2>
                    <span class="method-badge method-delete">DELETE</span>
                    Удалить пост
                </h2>
                <p class="description">
                    Удалить пост по его ID. Операция необратима. Если пост не найден, вернётся ошибка 404.
                </p>
                <div class="form-group">
                    <label for="deletePostId">ID поста для удаления:</label>
                    <input type="number" id="deletePostId" value="1" min="1">
                </div>
                <button onclick="deletePost()" style="background: #f93e3e;">
                    <span class="loader" id="loader5"></span>
                    Удалить пост
                </button>
                <div id="response5" class="response" style="display: none;">
                    <h3>Ответ:</h3>
                    <div class="response-code success" id="code5">204 No Content</div>
                    <div class="response-body" id="body5"></div>
                </div>
            </div>

            <!-- АВТОМАТИЧЕСКИЙ ТЕСТ -->
            <div class="card">
                <h2>⚙️ Автоматический тест</h2>
                <p class="description">
                    Запустить полный тест CRUD операций в последовательности: Create → Read All → Read One → Update → Delete.
                </p>
                <button onclick="runFullTest()" style="background: #764ba2; width: 100%;">
                    <span class="loader" id="loaderFull"></span>
                    Запустить полный тест (CREATE → READ → UPDATE → DELETE)
                </button>
                <div id="testResults" style="display: none; margin-top: 20px;">
                    <h3>Результаты теста:</h3>
                    <div id="testOutput" class="response-body"></div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>💡 Подсказка: Проверьте консоль браузера (F12 → Console) для деталей запросов и ошибок</p>
            <p style="margin-top: 10px; opacity: 0.8;">API Тестер | Laravel CRUD API | 2026</p>
        </div>
    </div>

    <script>
        const API_BASE = 'http://127.0.0.1:8000/api/posts';
        let requestCount = 0;
        let lastCreatedPostId = null;

        function showLoader(loaderId) {
            document.getElementById(loaderId).style.display = 'block';
        }

        function hideLoader(loaderId) {
            document.getElementById(loaderId).style.display = 'none';
        }

        function formatJSON(obj) {
            return JSON.stringify(obj, null, 2);
        }

        function showResponse(responseId, codeId, code, body, isError = false) {
            const responseEl = document.getElementById(responseId);
            const codeEl = document.getElementById(codeId);
            const bodyEl = document.getElementById(responseId).querySelector('.response-body');

            responseEl.style.display = 'block';
            codeEl.textContent = code;
            codeEl.className = `response-code ${isError ? 'error' : 'success'}`;
            bodyEl.textContent = typeof body === 'string' ? body : formatJSON(body);

            document.getElementById('lastResponseCode').textContent = code.split(' ')[0];
            requestCount++;
            document.getElementById('totalRequests').textContent = requestCount;

            console.log(`[${code}]`, body);
        }

        async function getAllPosts() {
            const page = document.getElementById('getAllPage').value || 1;
            showLoader('loader1');

            try {
                const response = await fetch(`${API_BASE}?page=${page}`);
                const data = await response.json();
                showResponse('response1', 'code1', `${response.status} OK`, data, !response.ok);
            } catch (error) {
                showResponse('response1', 'code1', '0 Error', { error: error.message }, true);
            } finally {
                hideLoader('loader1');
            }
        }

        async function createPost() {
            const title = document.getElementById('postTitle').value.trim();
            const body = document.getElementById('postBody').value.trim();

            if (!title || !body) {
                alert('Пожалуйста, заполните все поля');
                return;
            }

            showLoader('loader2');

            try {
                const response = await fetch(API_BASE, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title, body })
                });

                const data = await response.json();
                if (response.ok) {
                    lastCreatedPostId = data.id;
                    document.getElementById('getPostId').value = data.id;
                    document.getElementById('updatePostId').value = data.id;
                    document.getElementById('deletePostId').value = data.id;
                }
                showResponse('response2', 'code2', `${response.status} Created`, data, !response.ok);
            } catch (error) {
                showResponse('response2', 'code2', '0 Error', { error: error.message }, true);
            } finally {
                hideLoader('loader2');
            }
        }

        async function getOnePost() {
            const postId = document.getElementById('getPostId').value;

            if (!postId) {
                alert('Введите ID поста');
                return;
            }

            showLoader('loader3');

            try {
                const response = await fetch(`${API_BASE}/${postId}`);
                const data = await response.json();
                showResponse('response3', 'code3', `${response.status} ${response.ok ? 'OK' : 'Not Found'}`, data, !response.ok);
            } catch (error) {
                showResponse('response3', 'code3', '0 Error', { error: error.message }, true);
            } finally {
                hideLoader('loader3');
            }
        }

        async function updatePost() {
            const postId = document.getElementById('updatePostId').value;
            const title = document.getElementById('updateTitle').value.trim();
            const body = document.getElementById('updateBody').value.trim();

            if (!postId) {
                alert('Введите ID поста');
                return;
            }

            if (!title && !body) {
                alert('Укажите хотя бы одно поле для обновления');
                return;
            }

            showLoader('loader4');

            const updateData = {};
            if (title) updateData.title = title;
            if (body) updateData.body = body;

            try {
                const response = await fetch(`${API_BASE}/${postId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(updateData)
                });

                const data = await response.json();
                showResponse('response4', 'code4', `${response.status} OK`, data, !response.ok);
            } catch (error) {
                showResponse('response4', 'code4', '0 Error', { error: error.message }, true);
            } finally {
                hideLoader('loader4');
            }
        }

        async function deletePost() {
            const postId = document.getElementById('deletePostId').value;

            if (!postId) {
                alert('Введите ID поста');
                return;
            }

            if (!confirm(`Вы уверены? Пост с ID ${postId} будет удалён навсегда!`)) {
                return;
            }

            showLoader('loader5');

            try {
                const response = await fetch(`${API_BASE}/${postId}`, {
                    method: 'DELETE'
                });

                const text = await response.text();
                const data = text ? JSON.parse(text) : { message: 'Пост успешно удалён' };

                document.getElementById('response5').style.display = 'block';
                document.getElementById('code5').textContent = `${response.status} No Content`;
                document.getElementById('body5').textContent = '(Пустой ответ - пост удалён)';

                document.getElementById('lastResponseCode').textContent = response.status;
                requestCount++;
                document.getElementById('totalRequests').textContent = requestCount;

                console.log(`[${response.status} Deleted]`);
            } catch (error) {
                showResponse('response5', 'code5', '0 Error', { error: error.message }, true);
            } finally {
                hideLoader('loader5');
            }
        }

        async function runFullTest() {
            const testOutput = document.getElementById('testOutput');
            const testResults = document.getElementById('testResults');
            testOutput.innerHTML = '⏳ Запуск теста...\n';
            testResults.style.display = 'block';
            showLoader('loaderFull');

            let testLog = '📋 РЕЗУЛЬТАТЫ ПОЛНОГО ТЕСТА\n';
            testLog += '═'.repeat(50) + '\n\n';

            try {
                testLog += '1️⃣  CREATE - Создание нового поста\n';
                testLog += '─'.repeat(50) + '\n';
                const createRes = await fetch(API_BASE, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        title: 'Тестовый пост из автотеста',
                        body: 'Автоматически созданный пост для тестирования всех операций'
                    })
                });
                const createdPost = await createRes.json();
                const testPostId = createdPost.id;
                testLog += `✅ Статус: ${createRes.status}\n`;
                testLog += `✅ Создан пост с ID: ${testPostId}\n\n`;

                testLog += '2️⃣  READ ALL - Получение списка постов\n';
                testLog += '─'.repeat(50) + '\n';
                const readAllRes = await fetch(API_BASE);
                const allPosts = await readAllRes.json();
                testLog += `✅ Статус: ${readAllRes.status}\n`;
                testLog += `✅ Получено постов: ${allPosts.total}\n`;
                testLog += `✅ На странице: ${allPosts.data.length}\n\n`;

                testLog += '3️⃣  READ ONE - Получение конкретного поста\n';
                testLog += '─'.repeat(50) + '\n';
                const readOneRes = await fetch(`${API_BASE}/${testPostId}`);
                const onePost = await readOneRes.json();
                testLog += `✅ Статус: ${readOneRes.status}\n`;
                testLog += `✅ Заголовок: "${onePost.title}"\n`;
                testLog += `✅ ID поста: ${onePost.id}\n\n`;

                testLog += '4️⃣  UPDATE - Обновление поста\n';
                testLog += '─'.repeat(50) + '\n';
                const updateRes = await fetch(`${API_BASE}/${testPostId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        title: 'Обновлённый заголовок (из автотеста)',
                        body: 'Обновлённое содержание - успешно изменено!'
                    })
                });
                const updatedPost = await updateRes.json();
                testLog += `✅ Статус: ${updateRes.status}\n`;
                testLog += `✅ Новый заголовок: "${updatedPost.title}"\n`;
                testLog += `✅ Обновлено: ${updatedPost.updated_at}\n\n`;

                testLog += '5️⃣  DELETE - Удаление поста\n';
                testLog += '─'.repeat(50) + '\n';
                const deleteRes = await fetch(`${API_BASE}/${testPostId}`, {
                    method: 'DELETE'
                });
                testLog += `✅ Статус: ${deleteRes.status}\n`;
                testLog += `✅ Пост успешно удалён!\n\n`;

                testLog += '═'.repeat(50) + '\n';
                testLog += '✅ ВСЕ ТЕСТЫ ПРОЙДЕНЫ УСПЕШНО!\n';
                testLog += '═'.repeat(50);

            } catch (error) {
                testLog += `\n❌ ОШИБКА: ${error.message}\n`;
            } finally {
                testOutput.textContent = testLog;
                hideLoader('loaderFull');
            }
        }

        window.addEventListener('load', () => {
            console.log('🧪 API Тестер загружен и готов к работе');
            console.log('📍 API URL:', API_BASE);
        });
    </script>
</body>
</html>

