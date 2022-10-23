<?php

namespace App\GraphQL\InputObject;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class PostInput extends InputType
{
    protected $inputObject = true;
    protected $attributes = [
        'name' => 'PostInput',
        'description' => 'A post information',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
            ],
            'materials' => [
                'type' => Type::string(),
            ],
            'purpose' => [
                'type' => Type::string(),
            ],
            'fullname' => [
                'type' => Type::string(),
            ],
            'address' => [
                'type' => Type::string(),
            ],
            'contact' => [
                'type' => Type::string(),
            ],
            'project_id' => [
                'type' => Type::string(),
            ]
        ];
    }
}

?>
