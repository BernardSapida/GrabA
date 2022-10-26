<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rules\Password;

class SignupMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Signup',
    ];

    public function args(): array
    {
        return [
            'account' => ['type' => GraphQL::type('AccountInput')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('ResponseFrontType');
    }

    protected function rules(array $args = []): array
    {
        $rules = [];
        $rules['account.firstname'] = ['required', 'between:2,15'];
        $rules['account.lastname'] = ['required', 'between:2,15'];
        $rules['account.email'] = ['required', 'email', 'unique:users,email'];
        $rules['account.jobPosition'] = ['required'];
        $rules['account.password'] = [
            'required', 
            Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()
        ];
        $rules['account.password_confirmation'] = [
            'required',
            'required_with:account.password',
            'same:account.password'
        ];

        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'account.firstname.required' => 'Firstname is required',
            'account.lastname.required' => 'Lastname is required',
            'account.email.required' => 'Email address is required',
            'account.email.email' => 'Email address must be a valid email address',
            'account.jobPosition.required' => 'Job position is required',
            'account.password.required' => 'Password is required',
            'account.password_confirmation.required' => 'Confirm password is required'
        ];
    }

    public function resolve($root, $args)
    {
        $account = $args['account'];

        $accountModel = new User();

        $response_obj = $accountModel->saveAccount($account);

        return $response_obj;
    }
}
