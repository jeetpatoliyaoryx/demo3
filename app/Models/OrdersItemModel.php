<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItemModel extends Model
{
    use HasFactory;

    protected $table = "orders_item";

    public function product()
    {
        return $this->belongsTo(ProductModel::class, "product_id", "id");
    }

    public function color()
    {
        return $this->belongsTo(ProductColorModel::class, "color_id", "id");   
    }

    public function size()
    {
        return $this->belongsTo(ProductSizeModel::class, "size_id", "id");      
    }

    static public function get_user_order_item_old($user_id)
    {
          return self::select('orders_item.*','users.name as username', 'orders.id as order_tbl_id', 'product.referral_price')
          ->join('users', 'users.id', '=', 'orders_item.user_id')
          ->join('orders', 'orders.id', '=', 'orders_item.order_id')
          ->join('product', 'product.id', '=', 'orders_item.product_id')
          ->orderBy('orders_item.id','desc')
          ->where('orders.is_delete','=',0)
          ->where('orders.is_payment','=',1)
          ->where('orders_item.user_id','=', $user_id)
          ->get();

    }

    static public function get_user_order_item_single_old($id)
    {
          return self::find($id); 
    }

    static public function get_user_order_item($user_id)
    {
        return self::select(
                'orders_item.*',
                'users.name as username',
                'orders.id as order_tbl_id',
                'product.referral_price'
            )
            ->join('users', 'users.id', '=', 'orders_item.user_id')
            ->join('orders', 'orders.id', '=', 'orders_item.order_id')
            ->join('product', 'product.id', '=', 'orders_item.product_id')
            ->with('referralCodes') // eager load relation
            ->orderBy('orders_item.id', 'desc')
            ->where('orders.is_delete', '=', 0)
            ->where('orders.is_payment', '=', 1)
            ->where('orders_item.user_id', '=', $user_id)
            ->get();
    }


    static public function get_user_order_item_single_OOOD($id)
    {
        return self::with([
            'referralCodes.owner',
            'referralCodes.usedBy',
            'referralIDCodes.usedBy' 
        ])
        ->join('orders', 'orders.id', '=', 'orders_item.order_id')
        ->join('product', 'product.id', '=', 'orders_item.product_id')
        ->where('orders_item.id', $id)
        ->select(
            'orders_item.*',
            'orders.id as order_tbl_id',
            'product.referral_price',
            'product.title as product_name'
        )
        ->first();
    }

    static public function get_user_order_item_singless($id)
    {
        return self::with(['referralCodes.owner', 'referralCodes.usedBy'])
            ->join('orders', 'orders.id', '=', 'orders_item.order_id')
            ->join('product', 'product.id', '=', 'orders_item.product_id')
            ->where('orders_item.id', $id)
            ->select('orders_item.*', 'orders.id as order_tbl_id', 'product.referral_price','product.title as product_name' )
            ->first();
    }

    static public function get_user_order_item_single_odldss($id)
    {
        return self::with([
                'referralCodes.owner',
                'referralCodes.usedBy',
                'referralCodes.childReferrals', //  add this
            ])
            ->join('orders', 'orders.id', '=', 'orders_item.order_id')
            ->join('product', 'product.id', '=', 'orders_item.product_id')
            ->where('orders_item.id', $id)
            ->select('orders_item.*', 'orders.id as order_tbl_id', 'product.referral_price','product.title as product_name')
            ->first();
    }

    static public function get_user_order_item_single($id)
    {


        return self::with([
        'referralCodes.owner',
        'referralCodes.usedBy',
        'referralCodes.childReferrals.owner',
        'referralCodes.childReferrals.usedBy'
        ])
        ->join('orders', 'orders.id', '=', 'orders_item.order_id')
        ->join('product', 'product.id', '=', 'orders_item.product_id')
        ->where('orders_item.id', $id)
        ->select(
            'orders_item.*',
            'orders.id as order_tbl_id',
            'product.referral_price',
            'product.title as product_name'
        )
        ->first();

    }

    public function referralCodes()
    {
        return $this->hasMany(\App\Models\ReferralCode::class, 'order_item_id');
    }

    public function referralIDCodes()
    {
        return $this->hasMany(\App\Models\ReferralCode::class, 'referral_id');
    }




}
