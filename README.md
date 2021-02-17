# Billie Mars date and time converter
Application to convert UTC to the Mars Sol Date (MSD) and the Martian Coordinated Time (MTC).

## How to start
```bash
git clone https://github.com/stafilokoks/billie_martian_time.git
cd billie_martian_time
cp .env.example .env
composer install
php -S localhost:8000 -t public
```
Service will start on http://localhost:8000

Tests can be run by
```bash
vendor/bin/phpunit
```


