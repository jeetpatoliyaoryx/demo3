<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyShopModel extends Model
{
    use HasFactory;

    protected $table = "why_shop";

    static function get_single($id)
    {
        return self::find($id);
    }

       public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/why_shop/'.$this->image))
        {
                return url('upload/why_shop/'.$this->image);
        }
        else
        {
            return url('upload/why_shop/default.jpg');   
        }
    }

}