<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class UserType extends BaseType
{
    protected $attributes = [
        'name'        => 'UserType',
        'description' => 'A type',
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'        => Type::id(),
                'description' => 'The id of the user',
            ],
            'email' => [
                'type'        => Type::string(),
                'description' => 'The email of user',
            ],
            'token' => [
                'type'        => Type::string(),
                'description' => 'The token of the user',
            ],
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
