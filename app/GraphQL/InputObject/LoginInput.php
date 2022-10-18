<?php

namespace App\GraphQL\InputObject;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class LoginInput extends InputType
{
    protected $inputObject = true;
    protected $attributes = [
        'name' => 'LoginInput',
        'description' => 'A login information',
    ];

    public function fields(): array
    {
        return [
            'code' => [
                'type' => Type::string(),
            ],
            'secret_key' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'password' => [
                'type' => Type::string(),
            ],
            'type' => [
                'type' => Type::string(),
            ],
        ];
    }
}

?>
