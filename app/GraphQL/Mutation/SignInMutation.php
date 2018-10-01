<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Error\AuthorizationError;
use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class SignInMutation extends Mutation
{
    protected $attributes = [
        'name'        => 'SignInMutation',
        'description' => 'A mutation for user sign in',
    ];

    public function type()
    {
        return GraphQL::type('AccessTokenType');
    }

    public function args()
    {
        return [
            'email'    => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function rules()
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * @param                                      $root
     * @param                                      $args
     * @param                                      $context
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     *
     * @return mixed
     * @throws \Folklore\GraphQL\Error\AuthorizationError
     */
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $credentials = [
            'email'    => $args['email'],
            'password' => $args['password'],
        ];
        if (!$accessToken = JWTAuth::attempt($credentials)) {
            throw new AuthorizationError('Invalid Credentials.');
        }

        return [
            'accessToken'       => $accessToken,
            'authorizationType' => 'Bearer',
            'createdAt'         => time(),
            'ttl'               => JWTAuth::factory()->getTTL(),
        ];
    }
}
