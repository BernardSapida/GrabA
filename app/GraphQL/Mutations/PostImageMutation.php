<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Post;
use App\Models\Helper;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class PostImageMutation extends Mutation
{
    protected $attributes = [
        'name' => 'PostImage',
    ];

    public function args(): array
    {
        return [
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
        $rules['image'] = ['image', 'max:10240'];
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

        $image = $args['image'];
        $folderId = $postModel->checkLatestModelID('0');
        $profile = "member/image";
        $profile_name = $helper->uploadImage($image, $folderId - 1, $profile);
        $response_obj = $postModel->saveImagePost($profile_name, $folderId);

        return $response_obj;
    }
}
