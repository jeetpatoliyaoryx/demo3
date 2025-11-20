<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SizeGuideModel extends Model
{
    use HasFactory;

    protected $table = "size_guide";

    static function get_single($id)
    {
        return self::find($id);
    }
    public function get_size_guide_image()
    {
        if(!empty($this->image) && file_exists('upload/size_guide/'.$this->image))
        {
                return url('upload/size_guide/'.$this->image);
        }
        else
        {
            return url('upload/size_guide/default.jpg');   
        }
    }

}
