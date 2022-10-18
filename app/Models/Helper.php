<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Log;
use Crypt;

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
}

?>
