<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutImageModel extends Model
{
    use HasFactory;

    protected $table = "about_image";

    static function get_single($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/about_image/'.$this->image))
        {
                return url('upload/about_image/'.$this->image);
        }
        else
        {
            return url('upload/about_image/default.jpg');   
        }
    }

}