# symfony-starter-kit

Заготовка для старта проектов на Symfony 7, PHP 8.3, Mysql 8

## Список модулей

- [Infrastructure - инфраструктура](backend/src/Infrastructure/README.md)

## Запуск

```shell
git clone git@github.com/rleekg/test.git your-folder-name

cd ./your-folder-name/

make init

```

Порты настраиваются в файле `./.env`

После настройки портов запустить `make init`

Документация OpenAPI доступна по адресу http://localhost:8088/docs

Тестирование писем http://localhost:8088/mailhog

## Запуск проверок исходного кода

Предварительно нужно выполнить настройку тестового окружения:
```shell
make install-test
```
Запуск проверок:
```shell
make check
```
Показать список доступных команд:
```shell
make help
```

## Генерация кода

[Maker](./backend/src-dev/Maker/README.md)

## Инструкция по очистке, для старта проектов

Для старта проекта необходимо удалить ненужные:
- Модули, т.е. все директории в `backend/src`, кроме `Infrastructure`
- Тесты из директорий:
  - `backend/tests/Command`
  - `backend/tests/Functional`, кроме `backend/tests/Functional/SDK/ApiWebTestCase.php`
  - `backend/tests/Unit`
- Все миграции из директории `backend/migrations` и сгенерировать новые.
- Переменные окружения из файла `docker/backend/.env.dist`
- Задания `cron` из файла `docker/backend/cron/crontab`
- Разделы документации из файла `backend/src-dev/openapi.yaml`
- Слои и правила `deptrac` из файла `backend/src-dev/deptrac.yaml`

### Copyright and license

