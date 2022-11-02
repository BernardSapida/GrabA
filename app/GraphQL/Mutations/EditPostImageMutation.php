<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Post;
use App\Models\Helper;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class EditPostImageMutation extends Mutation
{
    protected $attributes = [
        'name' => 'EditPostImage',
    ];

    public function args(): array
    {
        return [
            'postId' => ['type' => Type::int()],
            'image' => ['type' => GraphQL::type('[Upload!]')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('ResponseFrontType');
    }

    protected function rules(array $args = []): array
    {
        $rules = [];
        $rules['image'] = ['max:10240'];
        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'image.image' => 'Please upload an image only',
            'image.max' => 'Please upload an image of 10mb only',
        ];
    }

    public function resolve($root, $args)
    {
        $helper = new Helper();
        $postModel = new Post();
        $count = count($args['image']);

        $postId = $args['postId'];

        $images = array_filter($args['image']);
        $image = $images[$count - 1];
       
        $profile = "member/image";
        $profile_name = $helper->uploadImage($image, $postId, $profile);
       
        $response_obj = $postModel->saveEditImagePost($profile_name, $postId);

        return $response_obj;
    }
}
