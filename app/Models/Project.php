<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Post;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';

    public function member()
    {
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'project_id', 'id');
    }

    public function getProject()
    {
        $member = new Member();
        $user_id = $member->getLoggedInMember()->id;
        return self::where('user_id', $user_id)->get();
    }

    public function saveProject($args)
    {
        $response_obj = new \stdClass();
        $member = new Member();
        $member_id = $member->getLoggedInMember()->id;
        $id = $args['id'];
        
        try {
            if ($id == 0) {
                $project = new self();
                $response_obj->message = 'Project was added successfully';
            } else {
                $project = self::find($id);
                $response_obj->message = 'Project was updated successfully';
            }
            $response_obj->error = false;
            $project->name = $args['projectName'];
            $project->location = $args['siteLocation'];
            $project->total_cost = $args['materialCost'];
            $project->fullname = $args['fullname'];
            $project->position = $args['position'];
            $project->user_id = $member_id;
            $project->save();
        } catch (Exception $e) {
            Log::debug(print_r($e->getMessage(), true)); 
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }
    
    public function deleteProject($id)
    {
        try {
            $project = self::find($id);
            if ($project) {
                $project->delete();
            }
        } catch (Expception $e) {
            Log::debug(print_r($e->getMessage(), true));
        }
    }
}
