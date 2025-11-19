<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderModel extends Model
{
    use HasFactory;

    protected $table = "header";

    static function get_single($id)
    {
        return self::find($id);
    }

    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('upload/profile/'.$this->logo))
        {
                return url('upload/profile/'.$this->logo);
        }
        else
        {
            return url('backend/assets/images/logo.svg');   
        }
    }

     public function getFaviconLogo()
    {
        if(!empty($this->favicon_icon) && file_exists('upload/profile/'.$this->favicon_icon))
        {
                return url('upload/profile/'.$this->favicon_icon);
        }
        else
        {
            return url('backend/assets/images/logo.svg');   
        }
    }


}