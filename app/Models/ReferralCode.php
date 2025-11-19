<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    protected $table = 'referral_codes';
   
    protected $fillable = [
        'code',
        'order_item_id',
        'order_id',
        'owner_user_id',
        'used_by_user_id',
        'used_order_id',
        'referral_amount',
        'product_id',
        'referral_id',
        'status',
        'used_at'
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrdersItemModel::class, 'order_item_id');
    }

    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_user_id');
    }

    public function usedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'used_by_user_id');
    }

      public function parentReferral()
    {
        return $this->belongsTo(ReferralCode::class, 'referral_id');
    }

    // The child referrals that reference this code
    public function childReferrals()
    {
        return $this->hasMany(ReferralCode::class, 'referral_id');
    }

}
