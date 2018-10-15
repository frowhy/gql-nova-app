<?php

namespace App\GraphQL\Query;

use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersQuery extends Query
{
    protected $attributes = [
        'name'        => 'UsersQuery',
        'description' => 'A query',
    ];

    public function type()
    {
        return GraphQL::pagination(GraphQL::type('UserType'));
    }

    public function args()
    {
        return [
            [
                'name'        => 'take',
                'type'        => Type::int(),
                'description' => '每页数量',
            ],
            [
                'name'        => 'page',
                'type'        => Type::int(),
                'description' => '页码',
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return User::paginate($args['take'] ?? 20, ['*'], 'page', $args['page'] ?? 0);
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
