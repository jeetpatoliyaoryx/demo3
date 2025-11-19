<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssuranceModel extends Model
{
    use HasFactory;

    protected $table = "assurance";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getIconName()
    {
        if(!empty($this->icon_name) && file_exists('upload/icon_name/'.$this->icon_name))
        {
                return url('upload/icon_name/'.$this->icon_name);
        }
        else
        {
            return url('upload/icon_name/default.jpg');   
        }
    }

}