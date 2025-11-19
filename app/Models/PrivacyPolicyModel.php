<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicyModel extends Model
{
    use HasFactory;

    protected $table = "privacy_policy";

    static function get_single($id)
    {
        return self::find($id);
    }
}