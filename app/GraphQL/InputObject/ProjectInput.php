<?php

namespace App\GraphQL\InputObject;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class ProjectInput extends InputType
{
    protected $inputObject = true;
    protected $attributes = [
        'name' => 'ProjectInput',
        'description' => 'A project information',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
            ],
            'projectName' => [
                'type' => Type::string(),
            ],
            'siteLocation' => [
                'type' => Type::string(),
            ],
            'materialCost' => [
                'type' => Type::string(),
            ]
        ];
    }
}

?>
