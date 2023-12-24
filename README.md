<p align="center">
    <h1 align="center">TVZ test image</h1>
    <br>
</p>

## About

This repository will build a [Nginx](https://www.nginx.org) w/[PHP-FPM](https://php.net) w/[VUE](https://vuejs.org/) w/[YII2](https://yiiframework.com)  docker image, suitable for serving PHP scripts with YII2 framework.

## Install prerequisites

For now, this project has been mainly created for Unix `(Linux/MacOS)`. Perhaps it could work on Windows.

All requisites should be available for your distribution. The most important are :

* [Git](https://git-scm.com/downloads)
* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)

### Images to use

* [Nginx](https://hub.docker.com/_/nginx/)
* [PHP-FPM](https://hub.docker.com/r/nanoninja/php-fpm/)
* [Composer](https://hub.docker.com/_/composer/)
* [Node]((https://hub.docker.com/_/node?ref=hackernoon.com))

This project use the following ports :

| Server     | Port |
|------------|------|
| MariaDB    | 3306 |
| PHP        | 9000 |
| Nginx      | 80   |
| Node       | 8080 |

## Run the application

1. Build docker-compose : 

    ```sh
    cd docker && docker-compose build
    ```

2. Start the application :

    ```sh
    docker-compose up -d
    ```

3. Open your favorite browser :

    * [http://localhost:8080](http://localhost:8080/) YII2
    * [http://localhost:8080](http://localhost:80/) VUE

4. Stop and clear services

    ```sh
    docker-compose down -v
    ```

---