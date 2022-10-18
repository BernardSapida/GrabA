<?php
namespace App\GraphQL\Types;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\CustomScalarType;
use App\Models\Member;
use Crypt;

class MemberType extends GraphQLType
{
    protected $attributes = [
        'name' => 'MemberType',
        'description' => 'A member type information',
        'model' => Member::class,
    ];

    public function fields(): array
    {
        return [
            'member_id' => [
                'type' => new CustomScalarType([
                    'name' => 'member_id',
                    'serialize' => function ($value) {
                        $result = Crypt::encryptString($value);
                        return $result;
                    },
                ]),
                'alias' => 'id',
            ],
            'id' => [
                'type' => Type::int(),
                'alias' => 'id',
            ],
            'firstname' => [
                'type' => Type::string(),
                'alias' => 'firstname',
            ],
            'lastname' => [
                'type' => Type::string(),
                'alias' => 'lastname',
            ],
            'position' => [
                'type' => Type::string(),
                'alias' => 'position',
            ],
            'email' => [
                'type' => Type::string(),
                'alias' => 'email',
            ],
        ];
    }
}
?>
