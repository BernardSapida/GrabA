<?php

namespace App\GraphQL\InputObject;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class AccountInput extends InputType
{
    protected $inputObject = true;
    protected $attributes = [
        'name' => 'AccountInput',
        'description' => 'An account information',
    ];

    public function fields(): array
    {
        return [
            'firstname' => [
                'type' => Type::string(),
            ],
            'lastname' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'jobPosition' => [
                'type' => Type::string(),
            ],
            'password' => [
                'type' => Type::string(),
            ],
            'password_confirmation' => [
                'type' => Type::string(),
            ]
        ];
    }
}

?>
