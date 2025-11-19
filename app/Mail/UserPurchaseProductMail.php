<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPurchaseProductMail extends Mailable {
	use Queueable, SerializesModels;
	public $user;
	public $total_usd;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($user,$total) {
		$this->user = $user;
		$this->total = $total;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('emails.user_purchase_product')->subject(config('app.name') . ', Purchase Product Email');
	}
}
