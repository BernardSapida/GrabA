<?php
    namespace App\GraphQL\Queries;

    use GraphQL;
    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Query;
    use App\Models\Post;
    use App\Models\Outreach;

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
                'projectId' => ['type' => Type::String()],
            ];
        }
        
        public function resolve($root, $args)
        {
            $post = new Post();
            $postData = $post->getPost();

            if (isset($args['projectId'])) {
                $post->deleteProject($args['projectId']);
            }

            return $postData;
        }
    }
?>
