@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

     <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Forget your password</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="{{ url('/') }}">Home Page</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Forget your password</li>
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
                            <h4 class="mb_8">Reset your password</h4>
                            <p>We will send you an email to reset your password</p>
                             @include('_message')
                        </div>
                        <form class="form-login" method="post" action="">
                        	{{ csrf_field() }}
                            <div class="wrap">
                                <fieldset class=""><input class="" type="email" placeholder="Email address*"
                                        tabindex="2" aria-required="true" required="" name="email" value="" />
                                </fieldset>
                            </div>
                            <div class="button-submit"><button class="tf-btn btn-fill" type="submit"><span
                                        class="text text-button">Submit</span></button></div>
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