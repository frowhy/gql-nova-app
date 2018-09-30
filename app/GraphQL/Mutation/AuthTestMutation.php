<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class AuthTestMutation extends Mutation
{
    protected $attributes = [
        'name'        => 'AuthTestMutation',
        'description' => 'A mutation',
    ];

    public function type()
    {
        return GraphQL::type('AuthTestType');
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return [
            'status' => 'true',
        ];
    }

    public function authenticated($root, $args, $context)
    {
        return \JWTAuth::parseToken()->authenticate() ? true : false;
    }
}
