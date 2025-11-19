@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')


   @if(!empty($getRecord->map_link))
        <iframe
            src="{{ $getRecord->map_link }}"
            width="600" height="450" style="border:0;width:100%" loading="lazy"></iframe>
            @endif
        <section class="flat-spacing">
            <div class="container">
                <div class="contact-us-content">
                    <div class="left">
                        @if(!empty($getRecord->title))
                        <h4>{{ $getRecord->title }}</h4>
                        @endif
                         @if(!empty($getRecord->sub_title))
                        <p class="text-secondary-2">{{ $getRecord->sub_title }}</p>
                           @endif
                        <div class="tfSubscribeMsg  footer-sub-element ">
                        	   
                            {{-- <p style="color:rgb(52, 168, 83)">You have successfully subscribed.</p> --}}
                        </div>
                        @include('_message')
                        <form id="contactform" class="form-leave-comment" action="{{ url('contact') }}" method="post">
                        	   {{ csrf_field() }}
                            <div class="wrap">
                                <div class="cols">
                                    <fieldset class="">
                                    	<input type="text" placeholder="Your Name*" required="" name="name"/>
                                    </fieldset>
                                    <fieldset class="">
                                    	<input type="email" placeholder="Your Email*" required="" name="email"/>
                                    </fieldset>
                                </div>
                                <fieldset class="">
                                	<textarea name="message" id="message" rows="4"
                                        placeholder="Your Message*" required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="button-submit send-wrap">
                            	<button class="tf-btn btn-fill" type="submit"><span
                                        class="text text-button">Send message</span>
                                    </button>
                                </div>
                        </form>
                    </div>
                    <div class="right">
                          @if(!empty($getRecord->information))
                        <h4>{{ $getRecord->information }}</h4>
                        @endif
                        <div class="mb_20">
                              @if(!empty($getRecord->phone))
                            <div class="text-title mb_8">{{ $getRecord->phone }}</div>
                                @endif
                              @if(!empty($getRecord->phone_number))
                            <p class="text-secondary">{{ $getRecord->phone_number }}</p>
                                @endif
                        </div>
                        <div class="mb_20">
                             @if(!empty($getRecord->email))
                            <div class="text-title mb_8">{{ $getRecord->email }}</div>
                              @endif
                              @if(!empty($getRecord->email_id))
                            <p class="text-secondary">{{ $getRecord->email_id }}</p>
                              @endif
                        </div>
                        <div class="mb_20">
                              @if(!empty($getRecord->address))
                            <div class="text-title mb_8">{{ $getRecord->address }}</div>
                              @endif
                              @if(!empty($getRecord->address_full))
                            <p class="text-secondary">{{ $getRecord->address_full }}</p>
                                  @endif
                        </div>
                        <div>
                            @if(!empty($getRecord->open_time))
                            <div class="text-title mb_8">{{ $getRecord->open_time }}</div>
                            @endif
                            @if(!empty($getRecord->open_time_1)) 
                            <p class="text-secondary"> {{ $getRecord->open_time_1 }}
                            </p>
                            @endif
                            @if(!empty($getRecord->open_time_2))
                            <p class="text-secondary"> {{ $getRecord->open_time_2 }}</p>
                            @endif
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