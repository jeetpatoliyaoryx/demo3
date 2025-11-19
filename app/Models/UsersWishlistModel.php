<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersWishlistModel extends Model
{
    use HasFactory;

    protected $table = "users_wishlist";

    static public function getWishlistProduct($user_id)
    {
        return ProductModel::select('product.*')
                ->join('users_wishlist','users_wishlist.product_id','=','product.id')
                ->where('users_wishlist.user_id','=',$user_id)
                ->orderBy('users_wishlist.id','desc')
                ->paginate(16);
    }

    static public function add_remove($product_id, $user_id)
    {
        $count = self::where('product_id','=',$product_id)->where('user_id','=',$user_id)->count();
        if($count == 0)
        {
            $save = new UsersWishlistModel;
            $save->product_id = $product_id;
            $save->user_id = $user_id;
            $save->save();
            return 1;
        }
        else
        {
            self::where('product_id','=',$product_id)->where('user_id','=',$user_id)->delete();
            return 0;
        }
    }
}
