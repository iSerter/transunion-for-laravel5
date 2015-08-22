A Laravel 5.1 package for TransUnion API
======
This package provides a simplified facade to interact with the transunion API.

Add the Service Provider
---
`Iserter\Transunion\ServiceProvider::class,`

Add an alias to the service facade
---
`'Transunion' => Iserter\Transunion\Facades\Transunion::class,`

Publish Config File
---
`php artisan vendor:publish --provider="Iserter\Transunion\ServiceProvider" --tag=config`


