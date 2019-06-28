# Yii 2 CRUD application example project

This is example project implementing CRUD application created to help people learn Yii 2.0. It was created during my graduation project performed in Yekaterinburg, Russia. So application language is only Russian. The project showing how to deal with Gii, grids, filtering and other Yii 2.0 usage. It may contain bugs and etc.

It is built on top of basic Yii 2.0 template.

## Directory structure

```none
    .vscode/            VSCode debug and task files
    assets/             Assets definition
    commands/           Console commands (controllers)
    config/             Application configurations
    controllers/        Web controller classes
    docker/             Docker related files
    models/             Model classes
    runtime/            Files generated during runtime
    views/              View files for the Web application
    web/                The entry script and Web resources
    widgets/            Custom user created widgets
```

## Notice

Please notice that the application is currently running in development mode.

That can slow down the performance on Windows (because of xdebug).

## Requirements

Docker (Desktop) and Docker compose.

You can install Docker Desktop on [Windows](https://docs.docker.com/docker-for-windows/install/) and [MacOS](https://docs.docker.com/docker-for-mac/install/), or Docker CE on [Linux](https://docs.docker.com/install/linux/docker-ce/ubuntu/), but on Linux you must also install [Docker Compose](https://docs.docker.com/compose/install/).

## Installation

### Install via Composer

The following commands will be using Composer trough Docker.

You can then install the application using the following command:

```none
git clone https://github.com/f1amy/renovation-of-apartments.git
docker run --rm -it -v ${PWD}:/app -v composer-cache:/tmp composer:1.8 install
```

## Getting started

### The application

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `docker-compose build` to build PHP service with necessary extensions.
2. Run command `docker-compose up -d` to launch the application in detached console mode.

### Database

The next step is to load database using scripts in `docker/mysql/scripts` directory. You can do that using Adminer:

```none
docker run --rm -it -p 8080:8080 --network="reofap-net" -e ADMINER_DEFAULT_SERVER=mysql adminer:4.7
```

Then Adminer will be available at `localhost:8080`.

Use the following data to login:

1. Login: mysql.
2. Password: 157266.
3. Database: renovation_of_apartments.

Click at `SQL-command` button on the top left.

Put there text firstly from `create tables.sql`, then `test values.sql`.

### RBAC

And finally we must initialize RBAC using the following command:

```none
docker exec -it php-fpm bash docker/mysql/rbac-init.sh
```

Answer `yes` and the application will be available at `localhost`.

## Using the application

To login into the application, you should use the following credentials:

```none
LOGIN                 PASSWORD
head-of-accounting    acc0unt
brigadier             ch1ef
brigade-worker-1      work-1
brigade-worker-2      work-2
brigade-worker-3      work-3
brigade-worker-4      work-4
brigade-worker-5      work-5
```

The users are having different rights:

1. head-of-accounting role has all rights to the application.
2. brigadier role can't create records to many tables.
3. brigade-worker can only view some tables.

You can stop application using command `docker-compose down`.

And launch again using `docker-compose up`.
