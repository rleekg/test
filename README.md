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

/calculate-price
```
curl -X 'POST' \
  'http://localhost:8088/api/calculate-price' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "product": "018e7808-14b9-7c07-8a74-e02f1f0f110d",
  "taxNumber": "DE123456789",
  "couponCode": "D15"
}'
```

/purchase
```
curl -X 'POST' \
  'http://localhost:8088/api/calculate-price' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "product": "018e7808-14b9-7c07-8a74-e02f1f0f110d",
  "taxNumber": "DE123456789",
  "couponCode": "D15"
}'
```

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
