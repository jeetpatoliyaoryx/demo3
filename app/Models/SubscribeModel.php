<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeModel extends Model
{
    use HasFactory;

    protected $table = "subscribe";

    static function get_single($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/subscribe/'.$this->image))
        {
                return url('upload/subscribe/'.$this->image);
        }
        else
        {
            return url('upload/subscribe/newsletter.jpg');   
        }
    }

}