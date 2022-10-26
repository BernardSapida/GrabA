<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Member;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

use Log;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Login',
    ];

    public function args(): array
    {
        return [
            'member' => ['type' => GraphQL::type('LoginInput')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('ResponseFrontType');
    }

    protected function rules(array $args = []): array
    {
        $rules = [];
        $rules['member.email'] = ['required', 'email'];
        $rules['member.password'] = ['required'];

        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'member.email.required' => 'Email address is required',
            'member.email.email' => 'Email address must be a valid email address',
            'member.password.required' => 'Password is required'
        ];
    }

    public function resolve($root, $args)
    {
        $member = $args['member'];

        $memberModel = new Member();

        $response_obj = $memberModel->checkBasicAuthentication($member);

        return $response_obj;
    }
}

?>
