@component('mail::message')
Hi {{$user->name}},

<p>Forgot Your Password?</p>

<p>It happens. Click the link below to reset your password.</p>

@component('mail::button', ['url' => url('reset-password/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issue recovering your password, please contact us using the form from contact us page.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent