<?php
    namespace App\GraphQL\Queries;

    use GraphQL;
    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Query;
    use App\Models\Project;
    use App\Models\Outreach;

    class ProjectQuery extends Query
    {
        protected $attributes = [
            'name' => 'ProjectQuery query',
        ];

        public function type(): Type
        {
            return Type::listOf(GraphQL::type('ProjectType'));
        }

        public function args(): array
        {
            return [
                'projectId' => ['type' => Type::String()],
            ];
        }
        
        public function resolve($root, $args)
        {
            $project = new Project();
            $projectData = $project->getProject();

            if (isset($args['projectId'])) {
                $project->deleteProject($args['projectId']);
            }

            return $projectData;
        }
    }
?>