<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogueModel extends Model
{
    use HasFactory;

    protected $table = "catalogue";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getCatalogueImage()
    {
        if(!empty($this->catalogue_image) && file_exists('upload/catalogue/'.$this->catalogue_image))
        {
                return url('upload/catalogue/'.$this->catalogue_image);
        }
        else
        {
            return url('upload/catalogue/default.jpg');   
        }
    }

}