<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\OrdersModel;
use App\Models\OrdersItemModel;

class OrdersController extends Controller
{
    public function list()
    {
        $data['meta_title'] = "Order List";
        $data['getRecord'] = OrdersModel::getRecord();
        return view('backend.orders.list', $data);
    }

    public function orders_item_old($id, Request $request)
    {
        $data['getRecord'] = OrdersItemModel::select('orders_item.*', 'color.name as color_name', 'product.title', 'size.name as size_name')
        ->join('color', 'color.id', '=', 'orders_item.color_id')
        ->join('product', 'product.id', '=', 'orders_item.product_id')
        ->join('size', 'size.id', '=', 'orders_item.size_id')
        ->where('orders_item.order_id', '=', $id)->get();
        return view('backend.orders.orders_item', $data);
    }

       public function orders_item($id, Request $request)
    {
        $data['getRecord'] = OrdersItemModel::select('orders_item.*', 'product.title', 'product_color.name as color_name', 'product_size.name as size_name')
         ->join('product', 'product.id', '=', 'orders_item.product_id')
         ->join('product_color', 'product_color.id', '=', 'orders_item.color_id', 'left')
         ->join('product_size', 'product_size.id', '=', 'orders_item.size_id', 'left')
        ->where('orders_item.order_id', '=', $id)->get();
        return view('backend.orders.orders_item', $data);
    }

}