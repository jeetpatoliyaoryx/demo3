<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSettingModel extends Model
{
    use HasFactory;

    protected $table = "contact_setting";

    static function get_single($id)
    {
        return self::find($id);
    }
}