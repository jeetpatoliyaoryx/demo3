<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class EmailSubscribeModel extends Model
{
    use HasFactory;

    protected $table = 'email_subscribe';

    static public function checkEmail($email)
    {   
        return self::select('email_subscribe.*')
                    ->where('email', '=', $email)                    
                    ->first();
    }

}