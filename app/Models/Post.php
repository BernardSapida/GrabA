<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Expception;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getPost($id)
    {
        // $member = new Member();
        // $user_id = $member->getLoggedInMember()->id;
        // $project_id = Project::where('user_id', $user_id)->get('id');
        // return self::where('project_id', $project_id)->get('id');

        $member = new Member();
        $user_id = $member->getLoggedInMember()->id;
        return self::where('user_id', $user_id)->get();
    }

    public function savePost($args)
    {
        $response_obj = new \stdClass();
        try {
            $post = new self();
            $response_obj->message = 'Post was uploaded successfully';
            $response_obj->error = false;
            $post->materials = $args['materials'];
            $post->purpose = $args['purpose'];
            $post->fullname = $args['fullname'];
            $post->address = $args['address'];
            $post->contact = $args['contact'];
            $post->project_id = $args['project_id'];
            $post->save();
        } catch (Exception $e) {
            Log::debug(print_r($e->getMessage(), true));
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }
}
