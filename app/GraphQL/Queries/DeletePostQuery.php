<?php
    namespace App\GraphQL\Queries;

    use GraphQL;
    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Query;
    use App\Models\Post;

    class DeletePostQuery extends Query
    {
        protected $attributes = [
            'name' => 'DeletePostQuery query',
        ];

        public function type(): Type
        {
            return GraphQL::type('ResponseFrontType');
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
            $postData = $post->deletePost($args['postId']);

            return $postData;
        }
    }
?>