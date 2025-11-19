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


    public function get_desktop_banner()
    {
        $banner = $this->desktop_banner;

        if (is_array($banner)) {
            $banner = $banner[0] ?? null;
        }

        if (!empty($this->desktop_banner) && file_exists('upload/desktop_banner/' . $this->desktop_banner)) {
            return url('upload/desktop_banner/' . $this->desktop_banner);
        }

        return url('upload/desktop_banner/default.jpg');
    }

    public function get_mobile_banner()
    {
        $banner = $this->mobile_banner;

        if (is_array($banner)) {
            $banner = $banner[0] ?? null;
        }


        if (!empty($this->mobile_banner) && file_exists('upload/mobile_banner/' . $this->mobile_banner)) {
            return url('upload/mobile_banner/' . $this->mobile_banner);
        }
        return url('upload/mobile_banner/default.jpg');
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