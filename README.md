<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Laravel boilerplate

Laravel boilerplate with my custom pre config command to help me generate DDD structure

## COMMANDS

```bash
# Create a new controller class under App/Domain namespace
php artisan domain:controller

# Create a new Eloquent model class under App/Domain namespace
php artisan domain:model

# Create a new form request class under App/Domain namespace
php artisan domain:request
```

## API DEBUG BAR

This is custom middleware that extends from debug bar to show results when making an API called

```bash
# enable/disable api debug bar in .env file
DEBUGBAR_API_ENABLED=true
```