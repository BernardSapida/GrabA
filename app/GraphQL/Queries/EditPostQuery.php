<?php
    namespace App\GraphQL\Queries;

    use GraphQL;
    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Query;
    use App\Models\Post;

    class EditPostQuery extends Query
    {
        protected $attributes = [
            'name' => 'EditPostQuery query',
        ];

        public function type(): Type
        {
            return GraphQL::type('PostType');
        }

        public function args(): array
        {
            return [
                'postId' => ['type' => Type::int()],
                'projectId' => ['type' => Type::int()],
            ];
        }
        
        public function resolve($root, $args)
        {
            $post = new Post();
            $postData = $post->getEditPost($args['postId'], $args['projectId']);

            return $postData;
        }
    }
?>