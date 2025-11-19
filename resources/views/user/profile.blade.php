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
                             {{-- @include('_message') --}}
                            <form class="form-account-details form-has-password" method="post" action="{{ url('user/profile') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="account-info">
                                    <h5 class="title">Information</h5>
                                  

                                    <div class="cols mb_20">
                                        <fieldset class="">
                                            <input type="text" placeholder="First Name*" required="" name="name" value="{{ $user->name }}" />
                                            </fieldset>
                                        <fieldset class="">
                                            <input type="text" placeholder="Last Name*" name="last_name" value="{{ $user->last_name }}" />
                                            </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                            <input readonly type="email" placeholder="Email address*" required="" name="email" value="{{ $user->email }}" />
                                            </fieldset>
                                        <fieldset class="">
                                            <input type="text" placeholder="Phone Number*"  name="phone_number" value="{{ $user->phone_number }}" />
                                        </fieldset>
                                    </div>

                                     <div class="cols mb_20">
                                        <fieldset class="">
                                              <div class="tf-select">
                                                <select class="text-title" name="country_id" required>
                                                      @foreach($getCountry as $value)
                                                        <option {{ ($user->country_id == $value->id) ? "selected" : "" }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                   
                                                </select>
                                            </div>
                                        </fieldset>
                                        <fieldset class="">
                                            <input type="file" class="form-control" name="profile_pic" style="padding: 13px;"/>
                                        </fieldset>
                                    </div>


                                </div>
                         
                                <div class="button-submit">
                                    <button class="tf-btn btn-fill" type="submit"><span
                                            class="text text-button">Update Account</span></button></div>
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