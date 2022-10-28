<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Post;
use App\Models\Helper;
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
            'image' => ['type' => GraphQL::type('Upload')],
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
        $rules['post.contact'] = ['required', 'starts_with:09', 'size:11'];
        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'post.materials.required' => 'List of materials are required',
            'post.purpose.required' => 'Purpose is required',
            'post.fullname.required' => 'Fullname is required',
            'post.address.required' => 'Address is required',
            'post.contact.required' => 'Contact is required',
        ];
    }

    public function resolve($root, $args)
    {
        $helper = new Helper();
        $postModel = new Post();

        $post = $args['post'];

        $response_obj = $postModel->savePost($post);

        return $response_obj;
    }
}
