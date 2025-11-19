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
                        <h3 class="heading text-center">Bank Details</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Home </a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">My Account</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Bank Details</li>
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
                        	 {{-- @include('_message')   --}}
                            <form class="form-account-details form-has-password gap-0" action="" method="POST">
                            	 {{ csrf_field() }}
                                <div class="account-info">
                                    <h5 class="title">Bank Detail</h5>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                        	<input class="" type="text" placeholder="A/C Holder Name" required="" name="holder_name" value="{{ $user->holder_name }}" />
                                              @error('holder_name')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                        	<input class="" type="text" placeholder="Bank Name*" required="" name="bank_name" value="{{ $user->bank_name }}" />
                                              @error('bank_name')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                        	<input class="" type="text" placeholder="IFSC Code*" required="" name="ifsc_code" value="{{ $user->ifsc_code }}" />
                                             @error('ifsc_code')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                        	<input class="" type="text" placeholder="Account Number*" required="" name="account_number" value="{{ $user->account_number }}" />
                                             @error('account_number')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset class="">
                                        	<input class="" type="text" placeholder="Confirm Account Number*" required="" name="confirm_account_number" value="{{ $user->confirm_account_number }}" />
                                            @error('confirm_account_number')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </fieldset>

                                    </div>

                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input
                                            id="panCard" name="pan_card"
                                            type="text"
                                            placeholder="Enter PAN Card Number*"
                                            maxlength="10"
                                            required value="{{ $user->pan_card }}"
                                            />
                                             @error('pan_card')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror 
                                            <small id="panError" style="color:red; display:none;">
                                            Please enter a valid PAN (e.g. ABCDE1234F)
                                            </small>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="button-submit">
                                	<button class="tf-btn btn-fill rounded-1 w-100" type="submit">
                                		<span class="text text-button">Save</span>
                                	</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>




@endsection
@section('script')
<script type="text/javascript">

const panInput = document.getElementById("panCard");
  const errorMsg = document.getElementById("panError");

  panInput.addEventListener("input", function () {
    let value = this.value.toUpperCase(); // Force uppercase
    let formatted = "";

    // Step-by-step enforcement of position rules
    for (let i = 0; i < value.length; i++) {
      if (i < 5) {
        // First 5 must be A-Z
        if (/[A-Z]/.test(value[i])) formatted += value[i];
      } else if (i < 9) {
        // Next 4 must be 0-9
        if (/[0-9]/.test(value[i])) formatted += value[i];
      } else if (i === 9) {
        // Last 1 must be A-Z
        if (/[A-Z]/.test(value[i])) formatted += value[i];
      }
    }

    this.value = formatted;

    // Real-time validation feedback
    const regex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
    if (regex.test(this.value)) {
      this.style.border = "2px solid green";
      errorMsg.style.display = "none";
    } else {
      this.style.border = "2px solid red";
      errorMsg.style.display = "block";
    }
  });


</script>   
@endsection