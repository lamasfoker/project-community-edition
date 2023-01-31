<p align="center">
    <a href="https://magento.example.com/" target="_blank">
        <img src="https://i.imgur.com/bsv172X.png" alt="Magento 2"/>
    </a>
</p>

<h1 align="center">Magento 2.4.5-p1 Community Edition</h1>

## Prerequisites

+ [Git](https://git-scm.com/downloads)
+ [Composer 2](https://getcomposer.org/download/)
+ [Docker Compose](https://docs.docker.com/compose/)
+ PHP 8.1

## Local Deploy - Development

All you have to do to start developing on this project is:

1. Clone this repository

```bash
git clone git@github.com:lamasfoker/project-community-edition.git && cd project-community-edition
```

2. Run `composer install`

3. If you need to change port mapping defined on `docker-compose.yml` create a `docker-compose.override.yml`

4. Create the environment variables file `.env.local`. Feel free to change it:

```bash
cat <<"EOT" > .env.local
APP_ENV=dev
CONFIG__DEFAULT__WEB__SECURE__BASE_URL=http://127.0.0.1:8080/
CONFIG__DEFAULT__WEB__UNSECURE__BASE_URL=http://127.0.0.1:8080/

ENV_PHP__BACKEND__FRONTENDNAME=admin
ENV_PHP__DB__HOST=127.0.0.1
ENV_PHP__DB__DBNAME=magento2
ENV_PHP__DB__USERNAME=magento2
ENV_PHP__DB__PASSWORD=magento2
ENV_PHP__SESSION__REDIS__HOST=127.0.0.1
ENV_PHP__SESSION__REDIS__PORT=6379
ENV_PHP__SESSION__REDIS__PASSWORD=
EOT
```  

5. Copy from production `app/etc/env.php`

```bash
scp user@magento.example.com:~/deployer_path/current/app/etc/env.php ./app/etc/
```

6. Apply changes to `app/etc/env.php` blanking `session.redis.password`, `session.cache.frontend.default.backend_options.password`, `session.cache.frontend.page_cache.backend_options.password` and running

```bash
php development-first-setup.php
```

7. Bring up services with

```bash
docker-compose up -d
```

8. Pull the DB and the Media from production:

```bash
vendor/bin/dep magento:db-pull
vendor/bin/dep magento:media-pull
```

9. Start the PHP's built-in webserver

```bash
php -S 127.0.0.1:8080 -t ./pub/ ./phpserver/router.php
```

## Useful Deployer Tasks

From the project's root directory, you can pull database and media from the production server with the following commands:

```bash
vendor/bin/dep magento:db-pull
vendor/bin/dep magento:media-pull
```