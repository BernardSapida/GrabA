<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Post;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class PostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Post',
    ];

    public function args(): array
    {
        return [
            'post' => ['type' => GraphQL::type('PostInput')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('ResponseFrontType');
    }

    protected function rules(array $args = []): array
    {
        $rules = [];
        $rules['post.materials'] = ['required'];
        $rules['post.purpose'] = ['required'];
        $rules['post.fullname'] = ['required'];
        $rules['post.address'] = ['required'];
        $rules['post.contact'] = ['required'];
        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'post.materials.required' => 'Purpose is required',
            'post.purpose.required' => 'Purpose is required',
            'post.fullname.required' => 'Fullname is required',
            'post.address.required' => 'Address is required',
            'post.contact.required' => 'Contact is required',
        ];
    }

    public function resolve($root, $args)
    {
        $post = $args['post'];

        $postModel = new Post();

        $response_obj = $postModel->savePost($post);

        return $response_obj;
    }
}
