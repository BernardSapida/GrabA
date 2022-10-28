<?php
namespace App\GraphQL\Types;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProjectType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ProjectType',
        'description' => 'A project type information'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'alias' => 'id',
            ],
            'name' => [
                'type' => Type::string(),
                'alias' => 'name',
            ],
            'location' => [
                'type' => Type::string(),
                'alias' => 'location',
            ],
            'total_cost' => [
                'type' => Type::string(),
                'alias' => 'total_cost',
            ],
            'fullname' => [
                'type' => Type::string(),
                'alias' => 'fullname',
            ],
            'position' => [
                'type' => Type::string(),
                'alias' => 'position',
            ],
            'member' => [
                'type' => GraphQL::type('MemberType'),
            ]
        ];
    }
}
?>
