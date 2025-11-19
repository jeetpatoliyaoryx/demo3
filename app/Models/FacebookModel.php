<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookModel extends Model
{
    use HasFactory;

    protected $table = "facebook";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/facebook/'.$this->image))
        {
                return url('upload/facebook/'.$this->image);
        }
        else
        {
            return url('upload/facebook/default.jpg');   
        }
    }

}