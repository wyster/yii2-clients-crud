# Запуск проекта

Проект можно запустить через docker-compose, для этого нужно

* Перейти в директорию `.docker` : `cd .docker`

* Запустить команду `make setup`

* Отредактировать `.env`, а именно порты по которым будет доступен веб сервер и бд

```
HTTP_PORT=80
DB_PORT=5432
````

* Запустить контейнеры

`make up`

Подьём может занят время, устанавливаются пакеты composer, выполняются миграции, 
отследить процесс можно через `make logs`

* Когда все контейнеры запущены, для заполнения таблиц городов и регионов выполнить 
`docker-compose exec php ./yii parser/regions-and-cities`

* После можно зайти на сайт по  `http://localhost:$HTTP_PORT`

* К базе можно подключиться по `localhost:$DB_PORT`, login: `root`, password: `1`