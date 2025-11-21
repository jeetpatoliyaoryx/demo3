<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationPolicyModel extends Model
{
    use HasFactory;

    protected $table = "cancellation_policy";

    static function get_single($id)
    {
        return self::find($id);
    }
}
