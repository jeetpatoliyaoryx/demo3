@extends('backend.layouts.app')
@section('style')
  <link href="{{ asset('frontend/fileinput.min.css')}}" rel="stylesheet" type="text/css" />

  <style type="text/css">

  </style>
@endsection
@section('content')



  <div class="page-body">
    <div class="title-header">
      <h5>Update Footer</h5>
    </div>

    <!-- New Product Add Start -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="card-header-2">
                    @include('_message')

                    <form class="theme-form theme-form-2 mega-form" method="post"
                      action="{{ url('admin/footer_udpate') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="row">


                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Infomation</label>
                          <div class="col-sm-10">
                            <input name="infomation" type="text" placeholder="Infomation" class="form-control" required
                              value="{{ old('infomation', !empty($getRecord) ? $getRecord->infomation : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Home</label>
                          <div class="col-sm-10">
                            <input name="home" type="text" placeholder="Home" class="form-control" required
                              value="{{ old('home', !empty($getRecord) ? $getRecord->home : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            About Us</label>
                          <div class="col-sm-10">
                            <input name="about_us" type="text" placeholder="About Us" class="form-control" required
                              value="{{ old('about_us', !empty($getRecord) ? $getRecord->about_us : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Contact Us</label>
                          <div class="col-sm-10">
                            <input name="contact_us" type="text" placeholder="Contact Us" class="form-control" required
                              value="{{ old('contact_us', !empty($getRecord) ? $getRecord->contact_us : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Customer Services</label>
                          <div class="col-sm-10">
                            <input name="customer_services" type="text" placeholder="Customer Services"
                              class="form-control" required
                              value="{{ old('customer_services', !empty($getRecord) ? $getRecord->customer_services : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Shipping Policy</label>
                          <div class="col-sm-10">
                            <input name="shipping_policy" type="text" placeholder="Shipping Policy" class="form-control"
                              required
                              value="{{ old('shipping_policy', !empty($getRecord) ? $getRecord->shipping_policy : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Return & Refund Policy</label>
                          <div class="col-sm-10">
                            <input name="return_policy" type="text" placeholder="Return & Refund Policy"
                              class="form-control" required
                              value="{{ old('return_policy', !empty($getRecord) ? $getRecord->return_policy : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Privacy Policy</label>
                          <div class="col-sm-10">
                            <input name="privacy" type="text" placeholder="Privacy Policy" class="form-control" required
                              value="{{ old('privacy', !empty($getRecord) ? $getRecord->privacy : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Terms & Conditions</label>
                          <div class="col-sm-10">
                            <input name="terms" type="text" placeholder="Terms & Conditions" class="form-control" required
                              value="{{ old('terms', !empty($getRecord) ? $getRecord->terms : '') }}">
                          </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Cancellation Policy</label>
                          <div class="col-sm-10">
                            <input name="cancellation_policy" type="text" placeholder="Cancellation Policy" class="form-control" required
                              value="{{ old('cancellation_policy', !empty($getRecord) ? $getRecord->cancellation_policy : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Newsletter</label>
                          <div class="col-sm-10">
                            <input name="newletter" type="text" placeholder="Newsletter" class="form-control" required
                              value="{{ old('newletter', !empty($getRecord) ? $getRecord->newletter : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Newsletter Description</label>
                          <div class="col-sm-10">
                            <input name="newletter_d" type="text" placeholder="Newletter Description" class="form-control"
                              required
                              value="{{ old('newletter_d', !empty($getRecord) ? $getRecord->newletter_d : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Facebook Link </label>
                          <div class="col-sm-10">
                            <input name="facebook_link" type="text" placeholder="Facebook Link" class="form-control"
                              value="{{ old('facebook_link', !empty($getRecord) ? $getRecord->facebook_link : '') }}">
                          </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                          <label class="form-label-title col-sm-2 mb-0">
                            Instagram Link</label>
                          <div class="col-sm-10">
                            <input name="instagram_link" type="text" placeholder="Instagram Link" class="form-control"
                              value="{{ old('instagram_link', !empty($getRecord) ? $getRecord->instagram_link : '') }}">
                          </div>
                        </div>





                        <div class="clear-both"></div>



                      </div>

                      <br>
                      <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                      </div>

                    </form>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New Product Add End -->

    </div>
    <!-- Container-fluid End -->

@endsection

  @section('script')

    <script type="text/javascript">


    </script>

  @endsection