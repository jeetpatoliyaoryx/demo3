<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class OrdersModel extends Model
{
    use HasFactory;

    protected $table = "orders";

    static public function get_single($id)
    {
        return self::find($id);
    }

    public static function get_user_order($user_id)
    {
        return self::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('is_delete', '=', 0)
            ->whereIn('payment_method', ['Razorpay', 'Cash'])
            ->orderBy('id', 'desc')
            ->get();
    }


    static public function get_user_order_count($user_id)
    {
        return self::select('orders.*')->where('user_id','=',$user_id)->orderBy('id','desc')
        ->where('is_delete','=',0)->where('is_payment','=',1)->count();
    }


    static public function get_user_order_single($order_id, $user_id)
    {
        return self::select('orders.*')->where('id','=',$order_id)->where('user_id','=',$user_id)->orderBy('id','desc')
        ->where('is_delete','=',0)->whereIn('payment_method', ['Razorpay', 'Cash'])->first();
    }


    static public function get_user_order_uncompleted($user_id)
    {
        return self::select('orders.*')->where('user_id','=',$user_id)->orderBy('id','desc')
        ->where('is_delete','=',0)->where('is_payment','=',1)->where('status', '!=', 4)->get();
    }

    

    public function get_item()
    {
         return $this->hasMany(OrdersItemModel::class, "order_id")->join('product','product.id','=','orders_item.product_id');
    }

    public function getStatus()
    {
        return $this->belongsTo(OrdersStatusModel::class, "status", "id");
    }

    public function country()
    {
        return $this->belongsTo(CountryModel::class, "country_id", "id");
    }

    static public function getRecord_old()
    {
          return self::select('orders.*','users.name as username', 'countries.name as country_name')
          ->join('users', 'users.id', '=', 'orders.user_id')
          ->join('countries', 'countries.id', '=', 'orders.country_id')
          ->orderBy('orders.id','desc')
          ->where('orders.is_delete','=',0)
          ->get();
    }

    static public function getRecord()
    {
      
        $return = self::select('orders.*','users.name as username')->join('users', 'users.id', '=', 'orders.user_id');
                if(!empty(Request::get('id')))
                {
                    $return = $return->where('orders.id', '=', Request::get('id'));
                }

                if(!empty(Request::get('first_name')))
                {
                    $return = $return->where('orders.first_name','like','%'.Request::get('first_name').'%');
                }

                if(!empty(Request::get('last_name')))
                {
                    $return = $return->where('orders.last_name','like','%'.Request::get('last_name').'%');
                }

                   if(!empty(Request::get('email')))
                {
                    $return = $return->where('orders.email','like','%'.Request::get('email').'%');
                }


                if(!empty(Request::get('is_payment'))){
                    $status = Request::get('is_payment');
                    if (Request::get('is_payment') == '1000') {
                        $status = '0';
                    }
                    $return = $return->where('orders.is_payment', '=', $status);
                }
               
                $return = $return->orderBy('orders.id','desc')->where('orders.is_delete','=',0)->whereNotNull('orders.payment_method')
                ->paginate(50);

        return $return;

          // return self::select('orders.*','users.name as username')
          // ->join('users', 'users.id', '=', 'orders.user_id')
          // ->orderBy('orders.id','desc')
          // ->where('orders.is_delete','=',0)
          // ->paginate(10);
    }



        public function buildOrderPayload($order): array
        {
            // adapt field names to your schema! This is an example.
            $items = $order->items->map(function($i) {
                return [
                    'name' => $i->product_name,
                    'sku' => $i->sku ?? 'SKU'.$i->id,
                    'units' => (int) $i->quantity,
                    'selling_price' => (float) $i->price,
                    'discount' => 0,
                    'tax' => 0,
                    'hsn' => ''
                ];
            })->toArray();

            return [
                'order_id' => $order->transaction_id ?? 'ORDER-'.$order->id,
                'order_date' => $order->created_at->format('Y-m-d H:i:s'),
                'billing_customer_name' => trim($order->first_name.' '.$order->last_name),
                'billing_address' => trim($order->street_address . ' ' . ($order->flat_other ?? '')),
                'billing_city' => $order->city ?? 'Unknown',
                'billing_pincode' => $order->pin_code,
                'billing_state' => $order->state ?? 'Unknown',
                'billing_country' => 'India',
                'billing_email' => $order->email,
                'billing_phone' => $order->phone_number,
                'shipping_is_billing' => true, // set false if you have separate shipping fields
                'order_items' => $items,
                'length' => 10, // cm - update with real packing dimensions
                'breadth' => 10,
                'height' => 10,
                'weight' => $order->weight ?? 0.5, // kgs
                'payment_method' => $order->is_payment == 0 ? 'COD' : 'Prepaid',
                'sub_total' => $order->total,
            ];
        }


    static public function getSumOrderTotal($start_date, $end_date, $user_id, $sale_type)
    {
        $return =  self::select('orders.*')
                    ->whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date)
                    ->where('is_payment', '=', 1);
                     $return = $return->sum('total');
        return $return;
    }

    // OrdersModel.php
    static public function getSumProfit($start_date, $end_date)
    {
        $orders = self::whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date)
                    ->where('is_payment', 1)
                    ->get();

        $profit = 0;

        foreach ($orders as $order) {
            // get all order items with related product purchase price
            $items = \App\Models\OrdersItemModel::where('order_id', $order->id)
                        ->with('product') // make sure relation exists
                        ->get();

            $purchaseTotal = 0;
            foreach ($items as $item) {
                $purchaseTotal += (float)$item->product->purchase_price;
            }

            // calculate profit
            $profit += (float)$order->total - ((float)$order->shipments_price + $purchaseTotal);
        }

        return $profit;
    }


    // OrdersModel.php
    public function items()
    {
        return $this->hasMany(\App\Models\OrdersItemModel::class, 'order_id', 'id');
    }

    
}
