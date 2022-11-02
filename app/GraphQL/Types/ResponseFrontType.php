<?php
namespace App\GraphQL\Types;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ResponseFrontType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ResponseFrontType',
        'description' => 'A response type information',
    ];

    public function fields(): array
    {
        return [
            'error' => [
                'type' => Type::boolean(),
            ],
            'message' => [
                'type' => Type::string(),
            ],
            'token' => [
                'type' => Type::string(),
            ],
            'id' => [
                'type' => Type::string(),
            ]
        ];
    }
}
?>
