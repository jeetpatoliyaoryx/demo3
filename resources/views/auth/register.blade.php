@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

        <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}} )">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Register</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="{{ url('/') }}">Home Page</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4>Register</h4>
                        </div>
                        <form class="form-login form-has-password" id="registerForm" method="post" action="">
                        	{{ csrf_field() }}
                            <div class="wrap">
                                <fieldset class="">
                                    <input class="" type="text" placeholder="First Name*" tabindex="2" aria-required="true" required="" name="first_name" value="{{ old('first_name') }}" />
                                </fieldset>
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Last Name*" tabindex="2" aria-required="true" required="" name="last_name" value="{{ old('last_name') }}" />
                                </fieldset>
                                <fieldset class="">
                                	<input class="" type="email" placeholder="Email address*" tabindex="2" aria-required="true" required="" name="email" value="{{ old('email') }}" />
                                    <div style="color: red;">{{$errors->first('email')}}</div>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                	<input class="input-password" type="password" placeholder="Password*" tabindex="2" aria-required="true"
                                        required="" name="password" value="" />
                                        <span class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                                          <div style="color: red;">{{$errors->first('password')}}</div>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                	<input class="input-password" type="password" placeholder="Confirm Password*" tabindex="2"
                                        aria-required="true" required="" name="password_confirmation" value="" />
                                        <span class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                                          <div style="color: red;">{{$errors->first('confirm_password')}}</div>
                                </fieldset>
                                <div class="d-flex align-items-center">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                        	<input class="" type="checkbox" id="login-form_agree" name="agree_checkbox" checked="" />
                                            <div><i class="icon-check"></i></div>
                                        </div>
                                        <label class="text-secondary-2" for="login-form_agree">I agree to the 
                                        </label>
                                    </div><a title="Terms of Service" href="{{ url('terms') }}"> Terms of User</a>
                                </div>
                            </div>
                            <div class="button-submit">
                            	<button class="tf-btn btn-fill" type="submit"><span
                                        class="text text-button">Register</span></button>
                            </div>
                        </form>
                    </div>  
                    <div class="right">
                        <h4 class="mb_8">Already have an account?</h4>
                        <p class="text-secondary">Welcome back. Sign in to access your personalized experience, saved
                            preferences, and more. We&#x27;re thrilled to have you with us again!</p><a
                            class="tf-btn btn-fill" href="{{ url('login') }}"><span class="text text-button">Login</span></a>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
      registerForm.addEventListener('submit', function () {
        fbq('track', 'CompleteRegistration');
        console.log('Pixel CompleteRegistration fired ✅');
      });
    }
  });
</script>


<script type="text/javascript">


</script>
@endsection