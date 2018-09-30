<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Error\AuthorizationError;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Support\Facades\Auth;

class SignMutation extends Mutation
{
    protected $attributes = [
        'name'        => 'SignMutation',
        'description' => 'A mutation for user login',
    ];

    public function type()
    {
        return GraphQL::type('UserType');
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
        if (!$token = \JWTAuth::attempt($credentials)) {
            throw new AuthorizationError('Invalid Credentials.');
        }
        $user        = Auth::user();
        $user->token = $token;
        return $user;
    }
}
