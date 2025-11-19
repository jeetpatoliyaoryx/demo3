@component('mail::message')
Hi {{ $user->first_name }},

<p>Name :  {{ $user->first_name }}</p>
<p>Email : {{ $user->email }}</p>
<p>Thank you for your payment! Total - Rs. {{ number_format($total, 2) }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent