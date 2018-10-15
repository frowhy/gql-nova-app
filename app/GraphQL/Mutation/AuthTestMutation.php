<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        try {
            return JWTAuth::parseToken()->authenticate() ? true : false;
        } catch (JWTException $exception) {
            return false;
        }
    }
}
