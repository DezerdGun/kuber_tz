#Тестовое задание
“Балансы пользователей”

## 1. Добавление в hosts
Добавьте следующую строку в файл hosts:
- **Linux / Mac OS**: `/etc/hosts`
- **Windows**: `c:\Windows\System32\Drivers\etc\hosts`

```sh
127.0.0.1   dd.local
```

## 2. Запуск Docker
Перейдите в каталог `.docker`:
```sh
cd .docker
```

- **Сборка и запуск контейнеров**:
```sh
docker-compose up --build
```
- **Остановка контейнеров**:
```sh
docker-compose down
# или нажмите Ctrl + C в терминале
```

## 3. MySQL
Доступ к базе данных:
- **URL**: [http://localhost:9009](http://localhost:9009)
- **Сервер**: `database`
- **Пользователь**: `root`
- **Пароль**: `root`

## 4. Доступ к приложению
- **URL**: [http://dd.local/](http://dd.local/)
- **Логин / Пароль**: `alif / secret`

## 5. Ошибка 500 в Linux
Если при открытии маршрута возникает ошибка 500, раскомментируйте строки в `cmd.sh`:
```sh
# sudo chmod -R 755 laravel_blog
# chmod -R o+w laravel/storage
```

## 6. Ошибки миграций
Если миграции зависают, увеличьте задержку в `cmd.sh`:
```sh
sleep 40  # Измените на sleep 70, 80 или 90 в зависимости от производительности системы
```

---

## 7. Установка зависимостей
```sh
composer install
npm install
```

## 8. Настройка `.env`
Скопируйте шаблон `.env.example` в `.env`:
```sh
cp .env.example .env
```
Настройте подключение к БД:
```ini
DB_CONNECTION=mysql  # Или pgsql
DB_HOST=127.0.0.1
DB_PORT=3306  # Или 5432 для PostgreSQL
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

## 9. Генерация ключа приложения
```sh
php artisan key:generate
```

## 10. Миграции и начальное заполнение БД
```sh
php artisan migrate --seed
```

## 11. Запуск сервера Laravel
```sh
php artisan serve
```

---

# Основные команды

## Добавление пользователя
```sh
php artisan users:create {name} {email} {password}
```
**Пример:**
```sh
php artisan users:create "SJortan" SH@example.com secret123
```

## Операции с балансом
```sh
php artisan transactions:add {email} {amount} {type} {description}
```
- `email` – почта пользователя
- `amount` – сумма
- `type` – `deposit` (начисление) или `withdrawal` (списание)
- `description` – описание

**Пример:**
```sh
php artisan transactions:add SH@example.com 500 deposit "Бонус за регистрацию"
```
> ⚠ **Баланс не может уходить в минус!**

---

## Очереди (Laravel Queues)
Для обработки фоновых задач запустите воркер:
```sh
php artisan queue:work
```

---

# API

## Авторизация
**POST /api/login**  
**Пример запроса:**
```json
{
    "email": "SH@example.com",
    "password": "secret123"
}
```

## Получение текущего баланса
**GET /api/balance**

## Получение истории операций
**GET /api/transactions**

---

# Frontend (Vue 3)

## Запуск проекта
```sh
npm run dev
```
Если используется Laravel Mix:
```sh
npm run watch
```

