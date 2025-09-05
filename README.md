# EffectiveMobile Test Task API

REST API для управления задачами на Laravel 12.

## Что сделал

- CRUD-операции для задач с релевантными HTTP-статусами ответа
- Валидация данных (в рамках требований)
- Пагинация списка задач
- Единый формат ответов JSON для согласованности объектов-ответов
- Docker-окружение

## API-ручки

| Метод | URL | Описание |

* GET    | `/api/tasks`      | Получить список задач (с пагинацией)
* POST   | `/api/tasks`      | Создать новую задачу
* GET    | `/api/tasks/{id}` | Получить задачу по ID
* PUT    | `/api/tasks/{id}` | Обновить задачу по ID
* DELETE | `/api/tasks/{id}` | Удалить задачу по ID

## Установка и запуск

1. Клонировать репозиторий:

    `bash
    https://github.com/mmalferov/effective-mobile.git`

3. Запустить Docker из корня проекта:

    `bash docker-compose up -d`

4. Установить записимости в контейнере:

    `bash docker-compose exec app composer install`

5. Запустить миграции:

    `bash docker-compose exec app php artisan migrate`

## Готовые curl-запросы для проверки
### Успешные

* Создать задачу

    `curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "Первая задача", "description": "Описание первой задачи"}' http://localhost/api/tasks; echo`

* Получить список задач с пагинацией

    `curl -X GET -H "Accept: application/json" "http://localhost/api/tasks?page=1"; echo`

* Получить одну задачу по ID

    `curl -X GET -H "Accept: application/json" http://localhost/api/tasks/1; echo`

* Обновить все поля задачи

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "Обновленный заголовок", "description": "Новое описание", "status": "in_progress"}' http://localhost/api/tasks/1; echo`

* Обновить только заголовок

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "Только заголовок"}' http://localhost/api/tasks/1; echo`

* Обновить только статус

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"status": "completed"}' http://localhost/api/tasks/1; echo`

* Удалить задачу

    `curl -X DELETE -H "Accept: application/json" http://localhost/api/tasks/1; echo`

### Ошибочные

* Создать без заголовка

    `curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" -d '{"description": "Без заголовка"}' http://localhost/api/tasks; echo`

* Создать с пустым заголовком

    `curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "", "description": "Пустой заголовок"}' http://localhost/api/tasks; echo`

* Неправильный статус при обновлении

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"status": "wrong_status"}' http://localhost/api/tasks/1; echo`

* Попытка получить задачу, которую не содержит БД

    `curl -X GET -H "Accept: application/json" http://localhost/api/tasks/9999; echo`

* Обновить несущ. задачу

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "test"}' http://localhost/api/tasks/9999; echo`

* Удалить несущ. задачу

    `curl -X DELETE -H "Accept: application/json" http://localhost/api/tasks/9999; echo`

* Неправильный тип глагола

    `curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"title": "test"}' http://localhost/api/tasks; echo`
