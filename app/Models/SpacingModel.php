<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpacingModel extends Model
{
    use HasFactory;

    protected $table = "spacing";

    static function get_single($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/spacing/'.$this->image))
        {
                return url('upload/spacing/'.$this->image);
        }
        else
        {
            return url('upload/spacing/default.jpg');   
        }
    }

    public function getImage1()
    {
        if(!empty($this->image_1) && file_exists('upload/spacing/'.$this->image_1))
        {
                return url('upload/spacing/'.$this->image_1);
        }
        else
        {
            return url('upload/spacing/default_1.jpg');   
        }
    }

    public function getImage2()
    {
        if(!empty($this->image_2) && file_exists('upload/spacing/'.$this->image_2))
        {
                return url('upload/spacing/'.$this->image_2);
        }
        else
        {
            return url('upload/spacing/default_2.jpg');   
        }
    }

}