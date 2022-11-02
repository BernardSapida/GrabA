<?php
namespace App\GraphQL\Types;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\CustomScalarType;

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
            'fullname' => [
                'type' => Type::string(),
                'alias' => 'fullname',
            ],
            'position' => [
                'type' => Type::string(),
                'alias' => 'position',
            ],
            'hardware' => [
                'type' => Type::string(),
                'alias' => 'hardware',
            ],
            'contact' => [
                'type' => Type::string(),
                'alias' => 'contact',
            ],
            'address' => [
                'type' => Type::string(),
                'alias' => 'address',
            ],
            'purpose' => [
                'type' => Type::string(),
                'alias' => 'purpose',
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
            'name' => [
                'type' => Type::string(),
                'alias' => 'name',
            ],
            'images' => [  
                'type' => new CustomScalarType([
                    'name' => 'images',
                    'serialize' => function($value) {
                        return unserialize($value);
                    } 
                ]),
               'alias' => 'images',      
            ],
        ];
    }
}
