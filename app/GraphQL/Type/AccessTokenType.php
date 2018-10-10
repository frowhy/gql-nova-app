<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class AccessTokenType extends BaseType
{
    protected $attributes = [
        'name'        => 'AccessTokenType',
        'description' => 'A type',
    ];

    public function fields()
    {
        return [
            'accessToken'       => [
                'type' => Type::string(),
            ],
            'authorizationType' => [
                'type' => Type::string(),
            ],
            'createdAt'         => [
                'type' => Type::int(),
            ],
            'ttl'               => [
                'type' => Type::int(),
            ],
        ];
    }
}
