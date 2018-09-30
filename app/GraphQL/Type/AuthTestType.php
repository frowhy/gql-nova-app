<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class AuthTestType extends BaseType
{
    protected $attributes = [
        'name'        => 'AuthTestType',
        'description' => 'A type',
    ];

    public function fields()
    {
        return [
            'status' => [
                'type'        => Type::string(),
                'description' => 'Test status',
            ],
        ];
    }
}
