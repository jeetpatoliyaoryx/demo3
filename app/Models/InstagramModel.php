<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramModel extends Model
{
    use HasFactory;

    protected $table = "instagram";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getInstagramImage()
    {
        if(!empty($this->instagram_image) && file_exists('upload/instagram_image/'.$this->instagram_image))
        {
                return url('upload/instagram_image/'.$this->instagram_image);
        }
        else
        {
            return url('upload/instagram_image/default.jpg');   
        }
    }

}