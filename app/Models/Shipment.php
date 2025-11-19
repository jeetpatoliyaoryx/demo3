<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $fillable = [
        'order_id','shiprocket_order_id','shiprocket_shipment_id',
        'awb_code','courier_name','label_url','pickup_id','raw_response'
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\OrdersModel::class, 'order_id');
    }

    protected $casts = [
        'raw_response' => 'array',
    ];
}


