# Laravel Challenge

The challenge is to develop somethign in Laravel.

## Requirements

* [Windows WSL](https://learn.microsoft.com/en-us/windows/wsl/install)
* Docker Desktop 4.18.0 or higher
* Docker Compose version v2.17.2 or higher

## Get started

* Make a copy of `.env.example`, and name it `.env`.
* For the purposes of this challenge, we will use `.env` as is.
* Next, we'll install the PHP packages.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

* Start the container, install and build Node packages.

```
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

* You can then access the application through the following URL:

```
http://localhost:8076
```

* Stop the container.

```
./vendor/bin/sail down
```

## Running the application

* `Register new account` from the login page.


## Run test

```
./vendor/bin/sail artisan test
```
