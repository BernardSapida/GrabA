<?php
namespace App\GraphQL\Types;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'A post type information'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'alias' => 'id',
            ],
            'materials' => [
                'type' => Type::string(),
                'alias' => 'materials',
            ],
            'purpose' => [
                'type' => Type::string(),
                'alias' => 'purpose',
            ],
            'fullname' => [
                'type' => Type::string(),
                'alias' => 'fullname',
            ],
            'address' => [
                'type' => Type::string(),
                'alias' => 'address',
            ],
            'contact' => [
                'type' => Type::string(),
                'alias' => 'contact',
            ],
            'created_at' => [
                'type' => Type::string(),
                'alias' => 'created_at',
            ],
            'project' => [
                'type' => GraphQL::type('ProjectType'),
            ],
            'imageName' => [
                'type' => Type::string(),
            ],
        ];
    }
}
