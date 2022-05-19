# Laravel 9 - Tutorials

I'm working with a little playlist showing how to work with Laravel, can you show on:

https://www.youtube.com/playlist?list=PLidvkUdZtockQmjYdn7OYJPvdP3_79m4o

This is a simple repository with implementations about my videos, with tests and samples.

# Setup - Docker is required

```
composer install
vendor/bin/sail up -d
```

## Stubs Crud Simplify

To create a fast crud with tests and open-api documentation with stubs customized:

`php artisan make:model -c -f -m --api -R --test Product`
