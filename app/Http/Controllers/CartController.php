<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\OrdersItemModel;
use App\Models\CountryModel;
use App\Models\User;
use App\Models\ReferralCode;
use App\Models\Wallet;
use App\Models\DiscountCodeModel;
use App\Models\DiscountCodeUsedModel;
use App\Models\WalletTransaction;
use App\Mail\UserPurchaseProductMail;
use Session;
use Throwable;

use Exception;
use Razorpay\Api\Api;
use Auth;
use Cart;
use Hash;
use Str;
use DB;
use Mail;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function apply_discount_code_old(Request $request)
    {


        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);




        if (!empty($getDiscount)) {
            $total = \Cart::getSubTotal();
            if ($getDiscount->type == 1) {
                $discount_amount = $getDiscount->discount_price;
                $payable_total = $total - $getDiscount->discount_price;
            } else {
                $discount_amount = ($total * $getDiscount->discount_price) / 100;
                $payable_total = $total - $discount_amount;
            }


            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";
        } else {
            $json['status'] = false;
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = \Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid";
        }


        echo json_encode($json);
    }


    public function apply_discount_code_olds(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

        // Check for invalid code first
        if (!$getDiscount) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'Coupon Code Invalid',
            ]);
        }

        // Now it's safe to use $getDiscount->id
        $checkCodeDB = DiscountCodeUsedModel::where('user_id', Auth::id())
            ->where('discount_code_id', $getDiscount->id)
            ->first();

        if ($checkCodeDB) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'This Coupon Code Already Used',
            ]);
        }

        $total = \Cart::getSubTotal();


        if ($getDiscount->type == 1) {
            $discount_amount = $getDiscount->discount_price;
        } else {
            $discount_amount = ($total * $getDiscount->discount_price) / 100;
        }

        $payable_total = $total - $discount_amount;

        return response()->json([
            'status' => true,
            'discount_amount' => number_format($discount_amount, 2),
            'payable_total' => $payable_total,
            'message' => 'success',
        ]);
    }


    public function apply_discount_code_olsds(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

        // 🔹 1. Check for invalid code
        if (!$getDiscount) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'Coupon Code Invalid',
            ]);
        }

        // 🔹 2. Check if user already used this code
        $checkCodeDB = DiscountCodeUsedModel::where('user_id', Auth::id())
            ->where('discount_code_id', $getDiscount->id)
            ->first();

        if ($checkCodeDB) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'This Coupon Code Has Already Been Used',
            ]);
        }

        // 🔹 3. Get cart total and discount settings
        $total = \Cart::getSubTotal();
        $maximumPrice = $getDiscount->maximum_price ?? null;
        $minimumPrice = $getDiscount->minimum_price ?? null;

        // 🔹 4. Optional minimum order amount check
        if ($minimumPrice && $total < $minimumPrice) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => $total,
                'message' => "Coupon valid only for orders above " . number_format($minimumPrice, 2),
            ]);
        }

        // 🔹 5. Optional maximum limit check (e.g., if discount shouldn’t apply over certain total)
        if ($maximumPrice && $total > $maximumPrice) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => $total,
                'message' => "Coupon not applicable for orders above " . number_format($maximumPrice, 2),
            ]);
        }

        // 🔹 6. Calculate discount
        if ($getDiscount->type == 1) {
            // Fixed discount
            $discount_amount = $getDiscount->discount_price;
        } else {
            // Percentage discount
            $discount_amount = ($total * $getDiscount->discount_price) / 100;
        }

        // 🔹 7. Ensure discount doesn’t exceed total or defined max discount
        if ($discount_amount > $total) {
            $discount_amount = $total;
        }

        $payable_total = $total - $discount_amount;

        // 🔹 8. Return success response
        return response()->json([
            'status' => true,
            'discount_amount' => number_format($discount_amount, 2),
            'payable_total' => number_format($payable_total, 2),
            'message' => 'Discount applied successfully!',
        ]);
    }


    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

        // 🔹 1. Check for invalid code
        if (!$getDiscount) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'Coupon Code Invalid',
            ]);
        }

        // 🔹 2. Check if user already used this code
        $checkCodeDB = DiscountCodeUsedModel::where('user_id', Auth::id())
            ->where('discount_code_id', $getDiscount->id)
            ->first();

        if ($checkCodeDB) {
            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => \Cart::getSubTotal(),
                'message' => 'This Coupon Code Has Already Been Used',
            ]);
        }

        // 🔹 3. Get cart total and maximum price limit

        $total = \Cart::getSubTotal();
        $maximumPrice = (float) ($getDiscount->maximum_price ?? 0);

        // 🔹 4. Check if cart total exceeds maximum allowed for this coupon
        if ($maximumPrice && $total < $maximumPrice) {

            return response()->json([
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => number_format($total, 2),
                'message' => 'Coupon not applicable for orders above ' . number_format($maximumPrice, 2),
            ]);
        }


        // 🔹 5. Calculate discount
        if ($getDiscount->type == 1) {
            // Fixed discount
            $discount_amount = $getDiscount->discount_price;

        } else {
            // Percentage discount
            $discount_amount = ($total * $getDiscount->discount_price) / 100;
        }

        // 🔹 6. Prevent discount from exceeding total
        if ($discount_amount > $total) {
            $discount_amount = $total;
        }

        $payable_total = $total - $discount_amount;

        // 🔹 7. Return success response
        return response()->json([
            'status' => true,
            'discount_amount' => number_format($discount_amount, 2),
            'payable_total' => number_format($payable_total, 2),
            'message' => 'Coupon applied successfully!',
        ]);
    }


    public function cart(Request $request)
    {
        $data['meta_title'] = "Cart";
        return view('cart', $data);
    }

    public function add_cart_product(Request $request)
    {

        $getProduct = ProductModel::get_single($request->product_id);

        if (!empty($getProduct)) {
            $price = $request->final_price;
            $color_id = !empty($request->color_id) ? $request->color_id : '';
            $size_id = !empty($request->size_id) ? $request->size_id : '';

            $existingItem = Cart::getContent()->filter(function ($cartItem) use ($request, $color_id, $size_id) {
                return $cartItem->id == $request->product_id &&
                    $cartItem->attributes->color_id == $color_id &&
                    $cartItem->attributes->size_id == $size_id;
            })->first();

            if ($request->add_cart_item != 1) {
                if ($existingItem) {
                    return redirect()->back()->with('error', "This product is already in your cart!");
                }
            }

            //if (!$existingItem) {
            // Only add if it doesn't exist
            if (!empty($existingItem)) {

            } else {

                Cart::add([
                    'id' => $request->product_id,
                    'name' => $getProduct->title ?? 'Product',
                    'quantity' => !empty($request->qty) ? $request->qty : 1,
                    'price' => $price,
                    'weight' => 550,
                    'attributes' => [
                        'color_id' => $color_id,
                        'size_id' => $size_id,
                    ],
                ]);
            }

            //  }

            // Redirect logic
            if ($request->add_cart_item == 2) {
                return redirect()->back()->with('success', "Product successfully added to cart");
            } elseif ($request->add_cart_item == 1) {
                return redirect('checkout');
                //  return redirect('checkout')->with('success', "Product successfully added to cart");
            }
        } else {
            abort(404);
        }
    }


    public function add_cart_product_working(Request $request)
    {

        $getProduct = ProductModel::get_single($request->product_id);
        if (!empty($getProduct)) {
            // $price = $getProduct->price;
            $price = $request->final_price;

            $color_id = !empty($request->color_id) ? $request->color_id : '';
            $size_id = !empty($request->size_id) ? $request->size_id : '';

            Cart::add([
                'id' => $request->product_id,
                'name' => 'Product',
                'quantity' => !empty($request->qty) ? $request->qty : 1,
                'price' => $price,
                'weight' => 550,
                'attributes' => [
                    'color_id' => $color_id,
                    'size_id' => $size_id,
                ],
            ]);

            // return redirect('cart');    

            if ($request->add_cart_item == 2) {
                return redirect()->back()->with('success', "Category Successfully saved");
            } elseif ($request->add_cart_item == 1) {
                return redirect('checkout');
            }
        } else {
            abort(404);
        }
    }






    public function checkout_process(Request $request)
    {
        if (!empty(Cart::getContent()->count()) && !empty($request->get('or_i'))) {
            $order_id = base64_decode($request->get('or_i'));
            $getOrder = OrdersModel::get_single($order_id);
            if (!empty($getOrder)) {
                if (!empty(Auth::user()->id)) {
                    $data['user'] = User::find(Auth::user()->id);
                } else {
                    $data['user'] = array();
                }

                $data['getCountry'] = CountryModel::getCountry();
                $data['getOrder'] = $getOrder;



                $subtotal = $getOrder->total;
                $discount = 0;
                $shipping = 0;
                $totalRazorpay = ($subtotal - $discount) + $shipping;

                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));



                $razorpayOrder = $api->order->create([
                    'receipt' => uniqid('rcpt_') . "_" . $getOrder->id,
                    'amount' => (int) round($getOrder->total * 100),
                    'currency' => 'INR',
                    'payment_capture' => 1
                ]);

                $getOrder->razorpay_order_id = $razorpayOrder['id'];
                $getOrder->save();


                $data['totalRazorpay'] = $totalRazorpay;
                $data['razorpayOrderId'] = $razorpayOrder['id'];
                $data['order_tbl_id'] = $getOrder->id;
                $data['referral_code'] = $getOrder->referral_code_o;

                return view('checkout_process', $data);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function update_cart(Request $request)
    {
        $cart_info = $request->cart;

        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $qty = $cart['qty'];

            Cart::update($rowid, [
                'quantity' => [
                    'relative' => false, // overwrite instead of adding
                    'value' => $qty
                ],
            ]);
        }

        return redirect('checkout');
    }

    public function removeCart($id, Request $request)
    {

        Cart::remove($id);
        return redirect('cart')->with('success', 'Project Cart Remove Successfully !');
    }




    public function checkout_payment(Request $request)
    {

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $order = OrdersModel::find($request->order_id);

            if ($order) {
                $order->payment_method = 'Razorpay';
                $order->razorpay_payment_id = $request->razorpay_payment_id;
                $order->razorpay_signature = $request->razorpay_signature ?? null;
                $order->is_payment = 1;
                $order->save();

                return response()->json([
                    'status' => true,
                    'message' => "Payment successful! Your order has been placed.",
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Order not found",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Payment verification failed: " . $e->getMessage(),
            ]);
        }
    }



    public function checkout_payment_HH(Request $request)
    {


        $order = OrdersModel::find($request->order_id);

        if ($order) {



            // \Cart::clear();

            $order->payment_method = 'Razorpay';
            $order->razorpay_payment_id = $request->razorpay_payment_id;
            $order->razorpay_signature = $request->razorpay_signature ?? null;
            $order->is_payment = 1;
            $order->save();

            $json['status'] = true;
            $json['message'] = "Payment successful! Your order has been placed.";

        } else {
            $json['status'] = false;
            $json['message'] = "Due to some error please try again";
        }

        echo json_encode($json);
        die;

    }




    public function razorpayWebhook(Request $request)
    {
        $webhookSecret = config('services.razorpay.webhook_secret');
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);

            $event = json_decode($payload, true);
            Log::info("Razorpay Webhook Received", $event);

            if ($event['event'] === 'payment.captured') {
                $this->handlePaymentCaptured($event['payload']['payment']['entity']);
            }

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Razorpay Webhook Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    protected function handlePaymentCaptured($paymentEntity)
    {
        $razorpayOrderId = $paymentEntity['order_id'] ?? null;
        $razorpayPaymentId = $paymentEntity['id'];

        if ($razorpayOrderId) {
            $order = OrdersModel::where('razorpay_order_id', $razorpayOrderId)->first();

            if ($order) {
                $order->razorpay_payment_id = $razorpayPaymentId;
                $order->payment_method = "Razorpay";
                $order->is_payment = 1;
                $order->save();

                \Cart::clear();
                Log::info("Order payment completed for Order ID: {$order->id}");
            }
        }
    }





    public function checkout(Request $request)
    {
        $data['meta_title'] = "Checkout";
        if (!empty(Cart::getContent()->count())) {
            if (!empty(Auth::user()->id)) {
                $data['user'] = User::find(Auth::user()->id);
            } else {
                $data['user'] = array();
            }
            $data['getCountry'] = CountryModel::getCountry();

            return view('checkout', $data);
        } else {
            return redirect('cart');
        }
    }

    public function place_order(Request $request)
    {
        if (!empty(Auth::user()->id)) {

            $user = User::get_single(Auth::user()->id);
            $user->name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->phone_number = trim($request->phone_number);
            $user->street_address = trim($request->street_address);
            $user->flat_other = trim($request->flat_other);
            $user->country_id = trim($request->country);
            $user->state = trim($request->state);
            $user->city = trim($request->city);
            $user->pin_code = trim($request->pin_code);
            $user->save();

            $user_id = Auth::user()->id;

        } else {

            $time = date('His');
            $password = Hash::make($time);
            $checkUser = User::checkUserEmail($request->email);
            if (!empty($checkUser)) {
                return response()->json([
                    'status' => false,
                    'message' => "Your email address already register please choose another otherwise you can login"
                ]);
            } else {
                $user = new User;
                $user->name = trim($request->first_name);
                $user->last_name = trim($request->last_name);
                $user->email = trim($request->email);
                $user->phone_number = trim($request->phone_number);
                $user->street_address = trim($request->street_address);
                $user->flat_other = trim($request->flat_other);
                $user->country_id = trim($request->country);
                $user->state = trim($request->state);
                $user->city = trim($request->city);
                $user->pin_code = trim($request->pin_code);
                $user->remember_token = Str::random(50);
                $user->status = 1;
                $user->password = $password;
                $user->save();

                $user_id = $user->id;

                $userdata = User::get_single($user_id);

                Auth::loginUsingId($user_id);
            }

        }

        $is_validate = 0;
        $is_valid = 0;
        $in_valid = 0;

        if (!empty($request->referral_code)) {
            foreach (\Cart::getContent() as $rowC) {
                $product_id = $rowC->id;

                $ref = ReferralCode::where('code', $request->referral_code)
                    ->where('owner_user_id', '!=', $user_id)
                    ->where('product_id', $product_id)
                    ->where('status', 0)
                    ->first();

                if (!empty($ref)) {
                    $alreay_used = ReferralCode::where('order_id', '=', $ref->order_id)
                        ->where('used_by_user_id', '=', $user_id)
                        ->where('status', '=', 1)
                        ->count();

                    if ($alreay_used == 0) {
                        $is_valid++;
                    } else {
                        $in_valid++;
                    }
                }
            }
        }

        if (!empty($in_valid)) {
            $is_validate = 0;
        } elseif (!empty($is_valid)) {
            $is_validate = 1;
        }

        if (!empty($is_validate) || empty($request->referral_code)) {
            $order = new OrdersModel;
            $order->user_id = $user_id;
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->email = trim($request->email);
            $order->phone_number = trim($request->phone_number);
            $order->street_address = trim($request->street_address);
            $order->flat_other = trim($request->flat_other);
            $order->country_id = trim($request->country);
            $order->state = trim($request->state);
            $order->city = trim($request->city);
            $order->pin_code = trim($request->pin_code);
            $order->total_qty = \Cart::getTotalQuantity();
            // $order->total = number_format((float)trim($request->totalRazorpay), 2, '.', '');
            //$order->total = round((float)$request->totalRazorpay, 2);
            $order->total = (float) str_replace(',', '', $request->totalRazorpay);
            $order->final_total = \Cart::getSubTotal();
            $order->referral_code_o = trim($request->referral_code);
            $order->save();

            $order_id = $order->id;
            foreach (\Cart::getContent() as $row) {
                $order_item = new OrdersItemModel;
                $order_item->user_id = $user_id;
                $order_item->order_id = $order->id;
                $order_item->product_id = $row->id;
                $order_item->color_id = $row->attributes->color_id ?? 0;
                $order_item->size_id = $row->attributes->size_id ?? 0;
                $order_item->qty = $row->quantity;
                $order_item->price = $row->price;
                $order_item->total = $row->getPriceSum();
                $order_item->save();

            }


            $CheckDiscountCode = DiscountCodeModel::where('discount_code', '=', $request->discount_code)->first();
            if (!empty($CheckDiscountCode)) {

                $saveDes = new DiscountCodeUsedModel;
                $saveDes->user_id = $user_id;
                $saveDes->discount_code_id = $CheckDiscountCode->id;
                $saveDes->save();
            }

            if (!empty($request->payment_method)) {
                try {
                    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

                    $razorpayOrder = $api->order->create([
                        'receipt' => uniqid('rcpt_') . "_" . $order->id,
                        'amount' => (int) round($order->total * 100),
                        'currency' => 'INR',
                        'payment_capture' => 1
                    ]);

                    return response()->json([
                        'status' => true,
                        'type' => 1,
                        'order_id' => $razorpayOrder['id'],
                        'db_order_id' => $order->id,
                        'amount' => $razorpayOrder['amount'],
                        'key' => config('services.razorpay.key'),
                    ]);

                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => $e->getMessage()
                    ]);
                }
            } else {


                $order = OrdersModel::find($order->id);
                if ($order) {
                    $order->payment_method = "Cash";
                    $order->save();




                    // clear cart, send confirmation email, reduce stock, etc.
                    $orderItems = OrdersItemModel::where('order_id', $order->id)->get();


                    foreach ($orderItems as $item) {
                        $product = ProductModel::find($item->product_id);
                        if ($product) {
                            $currentStock = (int) $product->total_product;
                            $newStock = max(0, $currentStock - $item->qty); // reduce by 1 (or by quantity if you store it)
                            $product->total_product = $newStock;
                            $product->save();
                        }

                        if ($product) {


                            $referral_id = $this->applyReferral($order->referral_code_o, $order, $order->user_id, $item->product_id);


                            $referralAmount = $product->referral_price ?? 0;
                            for ($i = 0; $i < 4; $i++) {
                                ReferralCode::create([
                                    'code' => strtoupper(substr(md5($order->id . $item->id . $i . time()), 0, 8)),
                                    'order_item_id' => $item->id,
                                    'product_id' => $item->product_id,
                                    'order_id' => $order->id,
                                    'owner_user_id' => $order->user_id,
                                    'referral_amount' => $referralAmount,
                                    'referral_id' => $referral_id,
                                    'status' => 0,
                                ]);
                            }
                        }
                    }

                }
                \Cart::clear();
                try {
                    Mail::to($order->email)
                        ->send(new UserPurchaseProductMail($order, $order->total));

                } catch (Throwable $e) {
                    \Log::error("Order Mail Failed: " . $e->getMessage());
                }

                return response()->json([
                    'status' => true,
                    'type' => 2,
                    'message' => "Your Order Has Been Successfully Created With COD",
                    'redirect_url' => url('cart')
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Referral Code Invalid"
            ]);
        }

    }


    public function paymentCallback(Request $request)
    {

        $data = $request->only('razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature', 'db_order_id');

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {

            // SDK will throw if signature invalid
            $attributes = [
                'razorpay_order_id' => $data['razorpay_order_id'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_signature' => $data['razorpay_signature']
            ];

            $api->utility->verifyPaymentSignature($attributes);


            // Mark local order as paid


            $order = OrdersModel::find($data['db_order_id']);
            if ($order) {
                $order->razorpay_payment_id = $data['razorpay_payment_id'];
                $order->razorpay_signature = $data['razorpay_signature'];
                $order->razorpay_order_id = $data['razorpay_order_id'];
                $order->payment_method = "Razorpay";
                $order->is_payment = 1;
                $order->save();




                // clear cart, send confirmation email, reduce stock, etc.
                $orderItems = OrdersItemModel::where('order_id', $order->id)->get();


                foreach ($orderItems as $item) {
                    $product = ProductModel::find($item->product_id);
                    if ($product) {
                        $currentStock = (int) $product->total_product;
                        $newStock = max(0, $currentStock - $item->qty); // reduce by 1 (or by quantity if you store it)
                        $product->total_product = $newStock;
                        $product->save();
                    }

                    if ($product) {


                        $referral_id = $this->applyReferral($order->referral_code_o, $order, $order->user_id, $item->product_id);


                        $referralAmount = $product->referral_price ?? 0;
                        for ($i = 0; $i < 4; $i++) {
                            ReferralCode::create([
                                'code' => strtoupper(substr(md5($order->id . $item->id . $i . time()), 0, 8)),
                                'order_item_id' => $item->id,
                                'product_id' => $item->product_id,
                                'order_id' => $order->id,
                                'owner_user_id' => $order->user_id,
                                'referral_amount' => $referralAmount,
                                'referral_id' => $referral_id,
                                'status' => 0,
                            ]);
                        }
                    }






                }



            }

            try {

                $SendEmail = ['imvpul@gmail.com', $order->email];

                Mail::to($SendEmail)->send(new UserPurchaseProductMail($order, $order->total));

            } catch (\Exception $e) {

            }


            \Cart::clear();



            // return response()->json(['success' => true, 'message' => 'Payment verified']);
            // return redirect('cart')->with('success', 'Payment verified');
            return response()->json([
                'success' => true,
                'message' => 'Your Order Has Been Successfully Created',
                'redirect_url' => url('cart')
            ]);

        } catch (\Exception $e) {
            //return response()->json(['success' => false, 'message' => 'Verification failed: '.$e->getMessage()], 422);
            return response()->json([
                'success' => false,
                'message' => 'Verification failed: ' . $e->getMessage()
            ], 422);
        }
    }



    protected function applyReferral($code, $order, $userId, $product_id)
    {
        //dd($code);
        //dd($order->referral_code_o);
        $ref = ReferralCode::where('code', $code)
            ->where('owner_user_id', '!=', $userId)
            ->where('product_id', $product_id)
            ->where('status', 0)
            ->first();




        if ($ref) {



            $alreay_used = ReferralCode::where('order_id', '=', $ref->order_id)
                ->where('used_by_user_id', '=', $userId)
                ->where('status', '=', 1)
                ->count();

            if ($alreay_used == 0) {
                // mark this code as used
                $ref->update([
                    'status' => 1,
                    'used_by_user_id' => $userId,
                    'used_order_id' => $order->id,
                    'used_at' => now(),
                ]);


                // get all used referral codes for this user/order
                $usedRefs = ReferralCode::where('order_id', $ref->order_id)
                    ->where('owner_user_id', $ref->owner_user_id)
                    ->where('status', 1)
                    ->get();

                // only process when exactly 4 are used
                if ($usedRefs->count() === 4) {

                    $totalReferralAmount = $usedRefs->sum('referral_amount'); // dynamic total

                    // credit wallet once with the total
                    $wallet = Wallet::firstOrCreate(
                        ['user_id' => $ref->owner_user_id],
                        ['balance' => 0]
                    );

                    $wallet->balance += $totalReferralAmount;
                    //   $wallet->product_id = $ref->product_id;
                    $wallet->save();

                    // single transaction entry
                    WalletTransaction::create([
                        'wallet_id' => $wallet->id,
                        'amount' => $totalReferralAmount,
                        'type' => 'credit',
                        'product_id' => $ref->product_id,
                        'description' => 'Referral bonus (4 codes used by user #' . $userId . ')',
                    ]);
                }

                return $ref->id;
            } else {
                return 0;
            }


        }

        return 0;
    }


}