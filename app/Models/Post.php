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
            $post->imageName =  "/uploads/member/image/" . $post->id  . "/" . $post->imageName;
        }
    
        return $posts;
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
        // $imageName = $name . '-folder'. $id-1;
        $imageName = $name;
        $postName = self::find($id-1);
        $postName->imageName = $imageName;
        $postName->save();

    }
}
