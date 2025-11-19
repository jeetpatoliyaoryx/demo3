@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

<div class="page-title" style="background-image:url({{  url('frontend/images/section/page-title.jpg') }})">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Login</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="{{ url('/') }}">Home Page</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Login</li>
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
                            <h4>Login</h4>
                        </div>
                        @include('_message')

                        <form class="form-login form-has-password" method="post" action="">
                        	{{ csrf_field() }}
                            <div class="wrap">
                                <fieldset>
                                    <input type="email" placeholder="Email Address*" required name="email" />
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Password*" required name="password" />
                                    <span class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                                </fieldset>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            <input type="checkbox" id="login-form_agree" name=""  required />
                                            <div><i class="icon-check"></i></div>
                                        </div>
                                        <label for="login-form_agree"> Remember me </label>
                                    </div>
                                    <a class="font-2 text-button forget-password link" href="{{ url('forgot-password') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Login</span>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary">Be part of our growing family of new customers! Join us today and
                            unlock a world of exclusive benefits, offers, and personalized experiences.</p><a
                            class="tf-btn btn-fill" href="{{ url('register') }}"><span class="text text-button">Register</span></a>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')


<script type="text/javascript">


</script>
@endsection