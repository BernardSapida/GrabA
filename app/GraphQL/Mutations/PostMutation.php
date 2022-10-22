<?php
namespace App\GraphQL\Mutations;
use Closure;
use App\Models\Project;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class PostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'post',
    ];

    public function type(): Type
    {
        return GraphQL::type('ResponseFrontType');
    }

    public function args(): array
    {
        return [
            'project' => ['type' => GraphQL::type('ProjectInput')],
        ];
    }

    protected function rules(array $args = []): array
    {
        $rules = [];
        $project = $args['project'];
        $projectId = $project['id'];

        $rules['project.siteLocation'] = ['required'];
        $rules['project.materialCost'] = ['required', 'numeric', 'min:0'];
        if ($projectId == 0) {
            $rules['project.projectName'] = ['required', 'unique:projects,name'];
        } else {
            $rules['project.projectName'] = ['required', 'unique:projects,name,' . $projectId . ',id'];
        }

        return $rules;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'project.projectName.required' => 'Please enter your project name',
            'project.projectName.unique' => 'Project name already exist',
            'project.siteLocation.required' => 'Please enter your site location',
            'project.materialCost.required' => 'Please enter your material cost',
            'project.materialCost.numeric' => 'Material cost must be numeric',
            'project.materialCost.min' => 'Material cost must be greater than 0',
        ];
    }

    public function resolve($root, $args)
    {
        $project = $args['project'];

        $projectModel = new Project();

        $response_obj = $projectModel->saveProject($project);

        return $response_obj;
    }
}
