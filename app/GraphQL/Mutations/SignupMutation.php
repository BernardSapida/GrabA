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
            'account.firstname.required' => 'Please enter your firstname',
            'account.lastname.required' => 'Please enter your lastname',
            'account.email.required' => 'Please enter your email',
            'account.email.email' => 'Please enter your valid email address',
            'account.jobPosition.required' => 'Please enter your job position',
            'account.password.required' => 'Please enter your password',
            'account.password_confirmation.required' => 'Please enter your password'
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
