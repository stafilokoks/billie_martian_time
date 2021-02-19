# Billie Mars date and time converter
Application to convert UTC to the Mars Sol Date (MSD) and the Martian Coordinated Time (MTC).

## How to start
```bash
git clone https://github.com/stafilokoks/billie_martian_time.git
cd billie_martian_time
composer install
php -S localhost:8000 -t public
```
Service will start on http://localhost:8000

Tests can be run by
```bash
vendor/bin/phpunit
```

## API 
### GET localhost:8000/convert?date=2000-10-10T20:20:20Zd
Will return converted date and time

#### Query parameter
date - UTC date in ISO-8601 format. 

## Leap seconds
Date from https://www.ietf.org/timezones/data/leap-seconds.list is used as source of leap seconds
