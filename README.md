# basic-rest-api


## Prerequisites

- Docker and docker compose. ([Download Docker Community Edition](https://hub.docker.com/search/?type=edition&offering=community))
- Check current used ports on your machine (app is using port 80 and 3306 , change them in .env file in root DIR if required).


**Installation steps:** 
1. Run `docker-compose up -d` to start app containers.

2. Copy `.env.example` to `.env` in `backend` DIR.

3. Give `write` permissions to `storage` in `backend` DIR.

4. Run `docker exec -it basic-rest-api_app_1 bash` to start terminal in app container.
  - Initiate laravel app and run DB migrations:
    - Run `composer install`
    - Run `php artisan migrate:install`
    - Run `php artisan migrate`
  - Run `php artisan php artisan import-users-data:db-store DataProviderX` then enter file Url and resoures pointer.
  - Run `php artisan php artisan import-users-data:db-store DataProviderY` then enter file Url and resoures pointer.

**Run** 
- Just `GET` request to `localhost/api/v1/users`.

**API Filters** 
- `filter[status]`
- `filter[currency]`
- `filter[balanceMin]`
- `filter[balanceMax]`
- `filter[provider]`

**API Request Example** 
- `http://localhost/api/v1/users?filter%5Bcurrency%5D=aed`