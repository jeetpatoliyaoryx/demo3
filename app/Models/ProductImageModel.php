<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model
{
    use HasFactory;

    protected $table = "product_image";

    public function photo() {
        if (!empty($this->small) && file_exists('upload/' . $this->product_id . '/' . $this->small)) {
            return url('upload/' . $this->product_id . '/' . $this->small);
        } else {
            return '';
        }
    }

    public function photobig() {
        if (!empty($this->name) && file_exists('upload/' . $this->product_id . '/' . $this->name)) {
            return url('upload/' . $this->product_id . '/' . $this->name);
        } else {
            return '';
        }
    }

    public function getorignal() {
        if (!empty($this->orignal) && file_exists('upload/' . $this->product_id . '/' . $this->orignal)) {
            return url('upload/' . $this->product_id . '/' . $this->orignal);
        } else {
            return '';
        }
    }

}
