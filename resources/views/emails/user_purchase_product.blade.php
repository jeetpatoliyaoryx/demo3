<h2>Hi {{ $user->first_name }},</h2>

<p><strong>Name:</strong> {{ $user->first_name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<p>Thank you for your payment!</p>

<p><strong>Total:</strong> Rs. {{ number_format($total, 2) }}</p>

<br><br>
Thanks,<br>
{{ config('app.name') }}
