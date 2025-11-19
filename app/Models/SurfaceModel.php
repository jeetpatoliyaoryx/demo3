<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurfaceModel extends Model
{
    use HasFactory;

    protected $table = "surface";

    static function get_single($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/surface/'.$this->image))
        {
                return url('upload/surface/'.$this->image);
        }
        else
        {
            return url('upload/surface/default.png');   
        }
    }

}