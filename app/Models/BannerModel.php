<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;

    protected $table = "banner";

    static function get_single($id)
    {
        return self::find($id);
    }

    
    public function getBannerImage()
    {
        if(!empty($this->banner_image) && file_exists('upload/banner_image/'.$this->banner_image))
        {
                return url('upload/banner_image/'.$this->banner_image);
        }
        else
        {
            return url('upload/banner_image/default.jpg');   
        }
    }

    public function getCategory()
    {
        return $this->belongsTo(CategoryModel::class, "category_id");
    }

     public function getCatalogue()
    {
        return $this->belongsTo(CatalogueModel::class, "catalogue_id");
    }

    

}