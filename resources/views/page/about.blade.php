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
                        <h3 class="heading text-center">About Our Store</h3>
                        <!--<ul class="breadcrumbs d-flex align-items-center justify-content-center">-->
                        <!--    <li><a class="link" href="">Home</a></li>-->
                        <!--    <li><i class="icon-arrRight"></i></li>-->
                        <!--    <li><a class="link" href="#">Pages</a></li>-->
                        <!--    <li><i class="icon-arrRight"></i></li>-->
                        <!--    <li>About Our Store</li>-->
                        <!--</ul>-->
                    </div>
                </div>
            </div>
        </div>
        <section class="flat-spacing about-us-main pb_0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-us-features wow fadeInLeft"><img data-src="{{ $getRecord->getImage() }}"
                                alt="image-team" loading="lazy" width="930" height="618" decoding="async" data-nimg="1"
                                class="lazyload" style="color:transparent" src="{{ $getRecord->getImage() }}" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-us-content">
                            <h3 class="title wow fadeInUp">{{ $getRecord->title }}</h3>

                         
                                <div class="widget-tabs style-3">
                                    <ul class="widget-menu-tab wow fadeInUp">
                                        @foreach($getAbout as $key => $value)
                                            <li class="item-title {{ $key == 0 ? 'active' : '' }}">
                                                <span class="inner text-button">{{ $value->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="widget-content-tab wow fadeInUp">
                                        @foreach($getAbout as $key => $value)
                                            <div class="widget-content-inner {{ $key == 0 ? 'active' : '' }}">
                                                <p>{{ $value->description }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="flat-spacing line-bottom-container">
            <div class="container">
                <div class="swiper tf-sw-iconbox" dir="ltr">
                    <div class="swiper-wrapper">
                        
                     {{--    <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-return"></span></div>
                                <div class="content">
                                    <h6>14-Day Returns</h6>
                                    <p class="text-secondary">Risk-free shopping with easy returns.</p>
                                </div>
                            </div>
                        </div> --}}

                        @foreach($getWhyShop as $value)
                        <div class="swiper-slide">
                            <div class="tf-icon-box">
                                <div class="icon-box">
                                    {{-- <span class="icon icon-return"></span> --}}
                                    <img alt="img-testimonial" height="50px" width="50px" loading="lazy" width="468" height="624"
                                            decoding="async" data-nimg="1" style="color:transparent"
                                            src="{{ $value->getImage() }}" />
                                </div>
                                <div class="content text-center">
                                    <h6>{{ $value->title }}</h6>
                                    <p class="text-secondary">{{ $value->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach



                    
                    </div>
                    <div class="sw-pagination-iconbox spd3 sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>

        @if(!empty($getRecord->facebook_title))
        <section class="flat-spacing pb-0">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">{{ $getRecord->facebook_title }}</h3>
                    <p class="subheading text-secondary-2">{{ $getRecord->facebook_sub_title }}</p>
                </div>
                <div class="swiper team-slider" dir="ltr">
                    <div class="swiper-wrapper">
                        @foreach($getFacebook as $value)
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0s">
                                <div class="image">
                                    <img data-src="{{ $value->getImage() }}" alt="image-team"
                                        loading="lazy" width="600" height="600" decoding="async" data-nimg="1"
                                        class="lazyload" style="color:transparent" src="{{ $value->getImage() }}" />
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="javascript:void(0)">{{ $value->name }}</a>
                                        </h6>
                                        <div class="infor text-caption-1 text-secondary-2">{{ $value->position }}</div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="{{ $value->facebook_link }}" target="_blank" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                       @endforeach
                    </div>
                    <div class="sw-pagination-latest sw-dots type-circle justify-content-center spd80"></div>
                </div>
            </div>
        </section>
        @endif
        
     
     @if(!empty($getAllTitle->customer_1))

        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">{{ $getAllTitle->customer_1 }}</h3>
                </div>
                <div class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" dir="ltr">
                    <div class="swiper-wrapper">
                           @foreach($getCustomerSay as $value)
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4" style="animation-delay:0s">
                                <div class="content-top">
                                    <div class="box-icon"><i class="icon icon-quote"></i></div>
                                    <div class="text-title">{{ $value->title }}</div>
                                    <p class="text-secondary">&quot;{{ $value->description }}&quot;</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author">{{ $value->name }}</div>
                                        </div>
                                         <div class="list-star-default color-primary">
                                            @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $value->rating)
                                                        <i class="icon icon-star" style="color: gold;"></i> {{-- filled star --}}
                                                    @else
                                                        <i class="icon icon-star" style="color: #ccc;"></i> {{-- empty star --}}
                                                    @endif
                                                @endfor

                                      
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           @endforeach

             

                    </div>
                    <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center spd81">
                    </div>
                </div>
            </div>
        </section>
        @endif
        

@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection