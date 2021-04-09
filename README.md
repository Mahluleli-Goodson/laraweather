<h1 align="center">LaraWeather</h1>

## About LaraWeather

<p>LaraWeather is an Laravel based API. The API fetches temperature of a place thats passed in the URL.</p>
 <p>To test, just run the following in postman or API tool: <pre>{your_url}/api/temp/berlin mitte</pre> </p>

## Environment
This project has been proved to work in the following environment:

* Laravel 7.30.4
* PHP 7.2
* Valet 2.4.2
* Composer 1.10.20

## Set up

* git clone project
* rename `.env.example` to `.env`
* generate your laravel APP_KEY
* add your API_KEY in `.env`
* run `composer install`
* run `npm i` (optional)
* php artisan migrate --seed

At this point, the project should be completely set up.
