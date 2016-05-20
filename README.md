[![Build Status](https://travis-ci.org/JacksonWebServices/laravel-user-suite.svg?branch=master)](https://travis-ci.org/JacksonWebServices/laravel-user-suite)
Laravel User Suite
==================

```
$ composer require jacksonwebservices/laravel-user-suite
```

### Connect the Service Provider
Register this provider `JWS\UserSuite\UserSuiteServiceProvider::class` in app.php


### Publish Files

```
$ php artisan vendor:publish
```

### Config file

If you want to change the migration schema to something other than the default change the `database` configuration setting.

This uses the default `App\User` model by default, but you can change that to whatever user model fits your project.  

### Migrate Files

```
$ php artisan vendor:migrate 
```

### Update User Model

Add UserSuite Trait to the user model

```
use JWS\UserSuite\UserSuite;

class User extends Authenticatable
{
     use UserSuite;
```



