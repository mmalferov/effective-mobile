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

1. Клонировать репозиторий https://github.com/mmalferov/effective-mobile.git
2. Запустить Docker из корня проекта:
```bash
docker-compose up -d```
3. Установить записимости в контейнере:
```bash
docker-compose exec app composer install```
4. Запустить миграции:
```bash
docker-compose exec app php artisan migrate```
