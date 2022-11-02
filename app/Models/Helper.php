<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Log;
use Crypt;
use Str;

class Helper extends Eloquent
{
    public function encryptValue($value)
    {
        return Crypt::encryptString($value);
    }
    public function decryptValue($value)
    {
        return Crypt::decryptString($value);
    }
    public function parseID($id)
    {
        if (strlen($id) == 1) {
            $new_id = $id;
        } else {
            $new_id = self::decryptValue($id);
        }
        return $new_id;
    }
    public function uploadImage($images, $id, $model) {
        if($images) {
            $final_path = [];
            foreach($images as $image) {
                $path =  'uploads/'.$model.'/'.$id.'/';
                $original_name = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$image->getClientOriginalExtension();
                $image->move('public/'.$path, $original_name);
                array_push($final_path, $original_name);
            }
        } else {
            $final_path = "";
        }
        return $final_path;
    }
}

?>
