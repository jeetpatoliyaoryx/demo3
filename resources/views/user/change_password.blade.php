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
                        <h3 class="heading text-center">My Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Home</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-sidebar-account"><button data-bs-toggle="offcanvas" data-bs-target="#mbAccount"><i
                    class="icon icon-squares-four"></i></button></div>

        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                  
                    @include('user.parts._sidebar')

                    <div class="my-account-content">
                        <div class="account-details">
                             @include('_message')
                            <form class="form-account-details form-has-password" method="post" action="{{ url('user/change-password') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="account-info">
                                    <h5 class="title">Change Password</h5>
                                  

                                    <fieldset class="position-relative password-item mb_20"><input class="input-password"
                                            type="password" placeholder="Old Password*" name="old_password" required /><span class="toggle-password unshow"><i
                                                class="icon-eye-hide-line"></i></span>
                                    </fieldset>
                                    <fieldset class="position-relative password-item mb_20"><input class="input-password"
                                            type="password" placeholder="New Password*" 
                                            name="new_password" value="" required/><span class="toggle-password unshow"><i
                                                class="icon-eye-hide-line"></i></span></fieldset>
                                    <fieldset class="position-relative password-item"><input class="input-password"
                                            type="password" placeholder="Confirm Password*" name="confirm_password" required><span
                                            class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                                    </fieldset>

                                </div>
                            
                                <div class="button-submit">
                                    <button class="tf-btn btn-fill" type="submit"><span
                                            class="text text-button">Update Password</span></button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('script')


<script type="text/javascript">


</script>
@endsection