<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Expception;

use DB;
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
        $member = new Member();
        $user_id = $member->getLoggedInMember()->id;
        $user_position = $member->where('id', $user_id)->get();
        $project_id = Project::where('user_id', $user_id)->where('id', $id)->get();

        $posts = self::where('project_id', $project_id[0]['id'])->orderBy('id', 'DESC')->get();

        foreach($posts as $post) {
            $images= [];
            if ($post->imageName) {
                foreach(unserialize($post->imageName) as $image) {
                    array_push($images, "/uploads/member/image/" . $post->id  . "/" . $image);
                }
            }

            if(count($images) != 0) {
                $post->images = serialize($images);
            } else {
                $post->images = null;
            }
        }
        return $posts;
    }
    
    public function getEditPost($postId, $projectId) {
        $post = self::where('id', $postId)->where('project_id', $projectId)->first();
        $images= [];
        foreach(unserialize($post->imageName) as $image) {
            array_push($images, "/uploads/member/image/" . $post->id  . "/" . $image);
        }
        $post->images = serialize($images);
        return $post;
    }

    public function savePost($args)
    {
        $response_obj = new \stdClass();
        try {
            $post = new self();
            $post->materials = $args['materials'];
            $post->name = $args['fullname'];
            $post->position = $args['position'];
            $post->fullname = $args['hardware'];
            $post->contact = $args['contact'];
            $post->address = $args['address'];
            $post->purpose = $args['purpose'];
            $post->project_id = $args['project_id'];
            $post->save();
            $response_obj->message = 'Post was uploaded successfully';
            $response_obj->error = false;
            $response_obj->id =  DB::getPdo()->lastInsertId();
        } catch (Exception $e) {
            Log::debug(print_r($e->getMessage(), true));
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }

    public function saveEditPost($args) {
        $response_obj = new \stdClass();
        try {
            $post = self::where('id', $args['id'])->where('project_id', $args['project_id'])->first();
            $response_obj->message = 'Post was updated successfully';
            $response_obj->error = false;
            $post->materials = $args['materials'];
            $post->name = $args['fullname'];
            $post->position = $args['position'];
            $post->fullname = $args['hardware'];
            $post->contact = $args['contact'];
            $post->address = $args['address'];
            $post->purpose = $args['purpose'];
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

    public function deletePost($postId) {
        try {
            $project = self::find($postId);
            if ($project) {
                $project->delete();
            }
        } catch (Expception $e) {
            Log::debug(print_r($e->getMessage(), true));
        }
    }

    public function checkLatestModelID($id) {
        if($id == 0) {
            $count = self::count();
            if($count > 0) {
                $post = self::orderBy('id', 'DESC')->first();
                // $current_increment = DB::select("SHOW TABLE STATUS LIKE 'posts'");
                $nextId = $post->id + 1;
                $foldeId = $nextId;
            } else {
                $foldeId = 1;
                self::truncate();
            }
          } else {
            $foldeId = $id;
          }
          return $foldeId;
    }

    public function saveImagePost($name, $id) {
        $postName = self::find($id);
        $postName->imageName = serialize($name);
        $postName->save();
        
    }
    public function saveEditImagePost($name, $id) {
        $postName = self::find($id);
        $postName->imageName = null;
        $postName->save();
        $postName->imageName = serialize($name);
        $postName->save();
    }
}
