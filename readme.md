# Nova

> A Nova application built by GraphQL

## Setup

``` bash
# pull submodule
$ git submodule init
$ git submodule update

# install dependencies
$ composer install

# install Nova's service provider and public assets
$ php artisan nova:install
$ php artisan migrate

# generate jwt secret
$ php artisan jwt:secret

# serve with hot reload at localhost:8000
$ php artisan serve
```

## Register GraphQL

```php
// Register Schema
GraphQL::addSchema('default', [
    'query'    => [
        'users' => '\App\GraphQL\Query\UsersQuery',
    ],
    'mutation' => [
        'signIn'   => '\App\GraphQL\Mutation\SignInMutation',
        'authTest' => '\App\GraphQL\Mutation\AuthTestMutation',
    ],
]);
// Register Types
GraphQL::addTypes([
                      'App\GraphQL\Type\UserType',
                      'App\GraphQL\Type\AuthTestType',
                      'App\GraphQL\Type\AccessTokenType',
                  ]);
```
