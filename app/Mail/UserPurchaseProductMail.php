<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPurchaseProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order; // order already contains everything
    }

    public function build()
    {
        return $this->subject('Order Confirmation - #' . $this->order->id)
            ->view('emails.user_purchase_product')
            ->with([
                'order' => $this->order,
                'items' => $this->order->items,
                'total' => $this->order->total, 
            ]);
    }
}
