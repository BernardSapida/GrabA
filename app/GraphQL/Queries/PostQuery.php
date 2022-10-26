<?php
    namespace App\GraphQL\Queries;

    use GraphQL;
    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Query;
    use App\Models\Post;

    class PostQuery extends Query
    {
        protected $attributes = [
            'name' => 'PostQuery query',
        ];

        public function type(): Type
        {
            return Type::listOf(GraphQL::type('PostType'));
        }

        public function args(): array
        {
            return [
                'postId' => ['type' => Type::String()],
            ];
        }
        
        public function resolve($root, $args)
        {
            $post = new Post();
            $postData = $post->getPost($args['postId']);

            return $postData;
        }
    }
?>