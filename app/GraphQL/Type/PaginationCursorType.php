<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Pagination\LengthAwarePaginator;
use Folklore\GraphQL\Support\Type as BaseType;

class PaginationCursorType extends BaseType
{
    protected $attributes = [
        'name' => 'PaginationCursor',
    ];

    public function fields()
    {
        return [
            'total'        => [
                'type'    => GraphQLType::nonNull(GraphQLType::int()),
                'resolve' => function (LengthAwarePaginator $paginator) {
                    return $paginator->total();
                },
            ],
            'perPage'      => [
                'type'    => GraphQLType::nonNull(GraphQLType::int()),
                'resolve' => function (LengthAwarePaginator $paginator) {
                    return $paginator->perPage();
                },
            ],
            'currentPage'  => [
                'type'    => GraphQLType::nonNull(GraphQLType::int()),
                'resolve' => function (LengthAwarePaginator $paginator) {
                    return $paginator->currentPage();
                },
            ],
            'hasMorePages' => [
                'type'    => GraphQLType::nonNull(GraphQLType::boolean()),
                'resolve' => function (LengthAwarePaginator $paginator) {
                    return $paginator->hasMorePages();
                },
            ],
        ];
    }
}
