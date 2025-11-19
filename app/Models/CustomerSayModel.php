<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSayModel extends Model
{
    use HasFactory;

    protected $table = "customer_say";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getImage()
    {
        if(!empty($this->image) && file_exists('upload/customer_say/'.$this->image))
        {
                return url('upload/customer_say/'.$this->image);
        }
        else
        {
            return url('upload/customer_say/default.jpg');   
        }
    }

}