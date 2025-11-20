<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $getHomeHeader = App\Models\HeaderModel::first();
        $getHomeFooter = App\Models\FooterModel::first();
        $getFrontProductsApp = App\Models\ProductModel::getFrontProductsApp();
        $getContactSetting = App\Models\ContactSettingModel::first();
        $getMarketingKey = App\Models\MarketingKeyModel::first();
    @endphp
    <meta charSet="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>{{ !empty($meta_title) ? $meta_title : '' }}</title>
      @if(!empty($meta_title))
    <meta name="title" content="{{ $meta_title }}">
      @endif
      @if(!empty($meta_description))
    <meta name="description" content="{!! $meta_description !!}">
      @endif
      @if(!empty($meta_canonical))
    <link rel="canonical" href="{{ $meta_canonical }}" />
      @endif

    <link rel="preload" as="image" href="{{ url('frontend/images/avatar/user-account.jpg') }}" />
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/e2dd61510303e09c.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $getHomeHeader->getFaviconLogo() }}" type="image/x-icon" sizes="52x52" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

   
     <style type="text/css">
        
    </style>
    @yield('style')           
    
    
    @if(!empty($getMarketingKey->facebook_pixel_id))
    <!-- Facebook Pixel Code -->
    <script>
        !(function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        })(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '{{ $getMarketingKey->facebook_pixel_id }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id={{ $getMarketingKey->facebook_pixel_id }}&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif


@if(!empty($getMarketingKey->google_analytics_id))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $getMarketingKey->google_analytics_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', '{{ $getMarketingKey->google_analytics_id }}');
    </script>
    <!-- End Google tag -->
@endif








    <!-- Facebook Pixel Code -->
    <!-- <script>
        !(function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        })(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1558562352174026'); 
        
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=1558562352174026&ev=PageView&noscript=1" />
    </noscript> -->
    <!-- End Facebook Pixel Code -->    



    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-W0X069FZHZ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-W0X069FZHZ');
    </script> -->


</head>

<body class="preload-wrapper popup-loader">
    <div id="wrapper">
        <!-- topbar -->
       

        <div class="tf-topbar topbar-white bg-main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-12 text-center">
                        <div class="wrapper-slider-topbar">
                            <div class="swiper tf-sw-top_bar" dir="ltr">
                                <div class="swiper-wrapper">
                                    @if(!empty($getHomeHeader->title))
                                    <div class="swiper-slide">
                                        <p
                                            class="top-bar-text text-line-clamp-1 text-btn-uppercase fw-semibold letter-1">
                                              {{ $getHomeHeader->title }} </p>
                                    </div>
                                    @endif
                                     @if(!empty($getHomeHeader->sub_title))
                                    <div class="swiper-slide">
                                        <p
                                            class="top-bar-text text-line-clamp-1 text-btn-uppercase fw-semibold letter-1">
                                             {{ $getHomeHeader->sub_title }}</p>
                                    </div>
                                     @endif
                                </div>
                            </div>
                            <div class="navigation-topbar nav-prev-topbar snbn2"><span
                                    class="icon icon-arrRight"></span></div>
                            <div class="navigation-topbar nav-next-topbar snbp2"><span class="icon icon-arrLeft"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







               @include('layouts._header')


               @yield('content')

               @include('layouts._footer')




 <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <div class="mb-content-top">
                
                    <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                        <li class="nav-mb-item active">
                            <a href="{{ url('/') }}" class="collapsed mb-menu-link active">
                                <span>Home</span>
                            </a>
                        </li>
                           
                       @php
                        $getHomeCategory = App\Models\CategoryModel::getHomeCategory();
                        @endphp

                        @foreach($getHomeCategory as $category_d)
                        <li class="nav-mb-item">
                            <a href="#dropdown-{{ $category_d->id }}" 
                               class="collapsed mb-menu-link" 
                               data-bs-toggle="collapse" 
                               aria-expanded="false" 
                               aria-controls="dropdown-{{ $category_d->id }}">
                                <span>{{ $category_d->name }}</span>
                                <span class="btn-open-sub"></span>
                            </a>

                            @if($category_d->subcategory->count() > 0)
                            <div id="dropdown-{{ $category_d->id }}" class="collapse">
                                <ul class="sub-nav-menu">
                                    @foreach($category_d->subcategory as $subcategory_d)
                                    <li>
                                        <a href="#sub-{{ $subcategory_d->id }}" 
                                           class="sub-nav-link collapsed" 
                                           data-bs-toggle="collapse" 
                                           aria-expanded="false" 
                                           aria-controls="sub-{{ $subcategory_d->id }}">
                                            <span>{{ $subcategory_d->name }}</span>
                                            <span class="btn-open-sub"></span>
                                        </a>

                                        @if($subcategory_d->subcategory->count() > 0)
                                        <div id="sub-{{ $subcategory_d->id }}" class="collapse">
                                            <ul class="sub-nav-menu sub-menu-level-2">
                                                @foreach($subcategory_d->subcategory as $subcategory_l)
                                                <li>
                                                    <a class="sub-nav-link" 
                                                       href="{{ url('c/'.$category_d->slug.'/'.$subcategory_d->slug.'/'.$subcategory_l->slug) }}">
                                                        {{ $subcategory_l->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endforeach

                        @if(!empty($getHomeFooter->about_us))
                        <li class="nav-mb-item">
                            <a href="{{ url('about') }}" class="collapsed mb-menu-link ">
                                <span>{{ $getHomeFooter->about_us }}</span>
                               
                            </a>
                        </li>
                         @endif
                         @if(!empty($getHomeFooter->contact_us))
                        <li class="nav-mb-item">
                            <a href="" class="collapsed mb-menu-link ">
                                <span> {{ $getHomeFooter->contact_us }}</span>
                            </a>
                        </li>
                         @endif
                     
                    </ul>
                </div>
                <div class="mb-other-content">
                    <div class="group-icon">
                          @if(!empty(Auth::check()))
                        <a class="site-nav-icon" href="{{ url('user/wishlist') }}">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            Wishlist
                        </a>
                        @endif
                          @if(!empty(Auth::check()))
                            @if(Auth::user()->is_admin == 1)
                        <a class="site-nav-icon" href="{{ url('admin/dashboard') }}">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            Admin
                        </a>
  @else
         <a class="site-nav-icon" href="{{ url('user/orders') }}">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            User
                        </a>

   @endif

                         @else

                           <a class="site-nav-icon" href="{{ url('login') }}">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            Login
                        </a>

                         @endif

                          <!-- @if(!empty(Auth::check()))
                        <a class="site-nav-icon" href="{{ url('user/wallet') }}">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 7H19C20.1046 7 21 7.89543 21 9V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 11H20V15H16C14.8954 15 14 14.1046 14 13C14 11.8954 14.8954 11 16 11Z" stroke="#181818" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                            Wallet
                        </a>
                         @endif -->
                    </div>
                    <div class="mb-notice">
                        <a class="text-need" href="">Need Help?</a>
                    </div>
                    <div class="mb-contact">
                         @if(!empty($getContactSetting->address_full))
                        <p class="text-caption-1">{{ $getContactSetting->address_full }}</p>
                        @endif
                        <a class="tf-btn-default text-btn-uppercase" href="{{ url('contact') }}">
                            GET DIRECTION<i class="icon-arrowUpRight"></i>
                        </a>
                    </div>
                    <ul class="mb-info">
                         @if(!empty($getContactSetting->email_id))
                        <li>
                            <i class="icon icon-mail"></i>
                            <p>{{ $getContactSetting->email_id }}</p>
                        </li>
                         @endif
                          @if(!empty($getContactSetting->phone_number))
                        <li>
                            <i class="icon icon-phone"></i>
                            <p>{{ $getContactSetting->phone_number }}</p>
                        </li>
                         @endif
                    </ul>
                </div>
            </div>
            <div class="mb-bottom">
                <!-- <div class="bottom-bar-language">
                   
                    <div class="tf-currencies">
                        <div class="dropdown bootstrap-select image-select center style-default type-currencies dropup">
                            <button type="button" class="btn dropdown-toggle btn-light currency-btn" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">
                                            <img src="{{ url('frontend/images/country/Flag_of_India.svg.png')}}" alt="India" width="18" class="me-1" />
                                            IND
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item active selected" href="#" data-value="IND"
                                        data-img="images/country/Flag_of_India.svg.png')}}">
                                        <img src="{{ url('frontend/images/country/Flag_of_India.svg.png')}}" alt="India" width="18" class="me-1" /> India
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-value="USA" data-img="images/country/us.svg">
                                        <img src="{{ url('frontend/images/country/us.svg')}}" alt="USA" width="18" class="me-1" /> USA
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            
                    
                    <div class="tf-languages">
                        <div class="dropdown bootstrap-select image-select center style-default type-languages dropup">
                            <button type="button" class="btn dropdown-toggle btn-light language-btn" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">Hindi</div>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item active selected" href="#" data-value="Hindi">Hindi</a></li>
                                <li><a class="dropdown-item" href="#" data-value="English">English</a></li>
                            </ul>
                        </div>
                    </div>
                </div>-->
            
            </div>
        </div>
    </div>


{{-- Shopping Cart Model start --}}
 

 <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d-flex flex-column flex-grow-1 h-100">
                <div class="header">
                    <h5 class="title">Shopping Cart</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-mini-cart-threshold">
                        <div class="tf-progress-bar">
                            <div class="value" style="width:0%" data-progress="75">
                                <i class="icon icon-shipping"></i>
                            </div>
                        </div>
                        <div class="text-caption-1">Congratulations! You're just 1 step away to place your order.</div>
                    </div>

                    <div class="tf-mini-cart-wrap">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll">

                                @if(Cart::getContent()->count() > 0)
                                    @foreach(Cart::getContent() as $row)
                                        @php
                                            $getProduct = App\Models\ProductModel::get_single($row->id);

                                            // $color_name = null;
                                            // $size_name = null;

                                            // if(!empty($row->attributes->color_id)){
                                            //     $color_name = App\Models\ProductColorModel::get_single($row->attributes->color_id);
                                            // }

                                            // if(!empty($row->attributes->size_id)){
                                            //     $size_name = App\Models\ProductSizeModel::get_single($row->attributes->size_id);
                                            // }

                                          //  $color_name = App\Models\ProductColorModel::where('product_id', '=', $row->id)->first();
                                         //$size_name = App\Models\ProductSizeModel::where('product_id', '=', $row->id)->first();

                                             $color_name = App\Models\ProductColorModel::find($row->attributes->color_id);
                                             $size_name =  App\Models\ProductSizeModel::find($row->attributes->size_id);

                                        @endphp

                                        <div class="tf-mini-cart-item file-delete">
                                            <div class="tf-mini-cart-image">
                                                <img src="{{ $getProduct->photo() }}" alt="{{ $getProduct->title }}" width="60" height="60" style="object-fit:cover;">
                                            </div>
                                            <div class="tf-mini-cart-info flex-grow-1">
                                                <div class="mb_12 d-flex align-items-center justify-content-between flex-wrap gap-12">
                                                    <div class="text-title">
                                                        <a class="link text-line-clamp-1" href="{{ $getProduct->getURL() }}">{{ $getProduct->title }}</a>
                                                    </div>
                                                     <a href="{{ url('remove/'.$row->id) }}" class="px-3 py-2 btn btn-danger btn-sm">X</a>
                                                    
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-12">
                                                    <div class="text-secondary-2">
                                                       @if(!empty($size_name)){{ $size_name->name }} @endif
                                                        @if(!empty($color_name)) / {{ $color_name->name }} @endif
                                                    </div>
                                                    <div class="text-button d-flex">
                                                        <div class="qua">{{ $row->quantity }}</div>
                                                        <div class="px-1">X</div>
                                                        <div class="price">₹{{ number_format($row->price,2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Empty Cart Message -->
                                    <div class="p-4 empty-message">
                                        Your Cart is empty. Start adding favorite products to cart!
                                        <a class="btn-line" href="{{ url('/') }}">Explore Products</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="tf-mini-cart-bottom">
                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <h5>Subtotal</h5>
                                    <h5 class="tf-totals-total-value">₹{{ number_format(Cart::getSubTotal(),2) }}</h5>
                                </div>
                                <div class="tf-cart-checkbox">
                                    
                                    <label for="CartDrawer-Form_agree">
                                        I agree with <a title="Terms of Service" href="{{ url('terms') }}">Terms & Conditions</a>
                                    </label>
                                </div>
                                <div class="tf-mini-cart-view-checkout">
                                    <a class="tf-btn w-100 btn-white radius-4 has-border" href="{{ url('cart') }}">
                                        <span class="text">View cart</span>
                                    </a>
                                    <a class="tf-btn w-100 btn-fill radius-4" href="{{ url('checkout') }}">
                                        <span class="text">Check Out</span>
                                    </a>
                                </div>
                                <div class="text-center">
                                    <a class="link text-btn-uppercase" href="{{ url('/') }}">Or continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- tf-mini-cart-wrap -->
                </div>
            </div>
        </div>
    </div>
</div>



{{-- Size Guide Modal Start --}}









{{-- Size Guide Modal End --}}







  

{{-- Shopping Cart Model end --}}


    <div class="modal fade modal-search" id="search">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Search</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form class="form-search" id="modalSearchForm">
                    <fieldset class="text">
                           <input type="text" id="modalSearchInput" placeholder="Searching..." name="title" autocomplete="off" />
                    </fieldset>
                    <button class="" type="submit">
                        <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </form>
    
                <div>
                    <h6 class="mb_16">Search Products</h6>
                    <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4" id="modalProductList">
                        
                        @include('parts._product_search', ['getFrontProductsApp' => $getFrontProductsApp])
                    
                    </div>
                </div>
            {{--     <div class="wd-load view-more-button text-center">
                    <a href="shop-left-sidebar.html">
                        <button class="tf-loading btn-loadmore tf-btn btn-reset">
                            <span class="text text-btn text-btn-uppercase">Load more</span>
                        </button>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>



    {{-- Home page --}}
    <div class="modal fade modal-quick-add" id="quickAdd">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="header">
                {{-- <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span> --}}
            </div>
                <form id="quickAddForm" action="{{ url('add_cart_product') }}" method="post">
                        @csrf
                        <input type="hidden" name="price" id="modal_base_price">
                        <input type="hidden" name="product_id" id="modal_product_id">
                        <input type="hidden" name="final_price" id="modal_final_price">
                    <div>
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-item">
                                <div class="image">
                                <img id="quickAddImage" src="" alt="" />
                                </div>
                                <div class="content">
                                <a id="quickAddTitle" href=""></a>
                                <div class="tf-product-info-price">
                                    <h5 class="price-on-sale font-2">
                                    ₹<span id="quickAddPrice"></span>
                                    </h5>
                                    <h6 class="old-price">
                                    <del>₹<span id="quickAddOldPrice"></span></del>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tf-product-info-choose-option">
                            <div class="variant-picker-item">
                            <div class="variant-picker-label mb_12">Colors:</div>
                            <div class="variant-picker-values" name="color_id" id="quickAddColors"></div>
                            </div>
                            <div class="variant-picker-item">
                            <div class="variant-picker-label mb_12">Sizes:</div>
                            <div class="variant-picker-values gap12" name="size_id" id="quickAddSizes"></div>
                            </div>

                            <div class="tf-product-info-quantity">
                            <div class="title mb_12">Quantity:</div>
                            <div class="wg-quantity">
                                <span class="btn-quantity btn-decrease">-</span>
                                <input class="quantity-product" type="number" name="qty" value="1" />
                                <span class="btn-quantity btn-increase">+</span>
                            </div>
                            </div>

                            <div class="tf-product-info-by-btn mb_10 d-flex flex-column">
                                        <button id="addToCartBtn" type="submit" name="add_cart_item" value="2" 
                                                class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 w-100">
                                            Add to cart
                                        </button>
                                        <button type="submit" name="add_cart_item" value="1" 
                                                class="btn-style-3 text-btn-uppercase buy-now">
                                            Buy it now
                                        </button>
                                    </div>

                        </div>
            
                    </div>
            </div>
                </form>
            </div>
        </div>
    </div>

 @if(!empty(Auth::check()))

 <div class="offcanvas offcanvas-start canvas-sidebar" id="mbAccount">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <span class="text-btn-uppercase">SIDEBAR ACCOUNT</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body sidebar-mobile-append">
                <div class="sidebar-account">
                    <div class="account-avatar">
                        <div class="image">
                            <img src="{{ Auth::user()->getImage() }}" alt="" />
                        </div>
                        <h6 class="mb_4">{{ Auth::user()->name }}</h6>
                        <div class="body-text-1">{{ Auth::user()->email }}</div>
                    </div>
                    <ul class="my-account-nav">
                        <li>
                            <a class="my-account-nav-item" href="{{ url('user/profile') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                Account Details
                            </a>
                        </li>
                        <li>
                            <a class="my-account-nav-item" href="{{ url('user/orders') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                Your Orders
                            </a>
                        </li>
                        <!-- <li>
                            <a class="my-account-nav-item" href="{{ url('user/referral_orders') }}">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.3376 5.83315H19.1709V14.1665H18.3376V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H17.5042C17.9645 2.49982 18.3376 2.87291 18.3376 3.33315V5.83315ZM16.6709 14.1665H11.6709C9.36975 14.1665 7.50423 12.301 7.50423 9.99982C7.50423 7.69862 9.36975 5.83315 11.6709 5.83315H16.6709V4.16648H3.33757V15.8332H16.6709V14.1665ZM17.5042 12.4998V7.49982H11.6709C10.2902 7.49982 9.17092 8.61907 9.17092 9.99982C9.17092 11.3805 10.2902 12.4998 11.6709 12.4998H17.5042ZM11.6709 9.16649H14.1709V10.8332H11.6709V9.16649Z"
                                        fill="black" />
                                </svg>
                                Your Referral Order
                            </a>
                        </li> -->
                        <!-- <li>
                            <a class="my-account-nav-item" href="{{ url('user/wallet') }}">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.3376 5.83315H19.1709V14.1665H18.3376V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H17.5042C17.9645 2.49982 18.3376 2.87291 18.3376 3.33315V5.83315ZM16.6709 14.1665H11.6709C9.36975 14.1665 7.50423 12.301 7.50423 9.99982C7.50423 7.69862 9.36975 5.83315 11.6709 5.83315H16.6709V4.16648H3.33757V15.8332H16.6709V14.1665ZM17.5042 12.4998V7.49982H11.6709C10.2902 7.49982 9.17092 8.61907 9.17092 9.99982C9.17092 11.3805 10.2902 12.4998 11.6709 12.4998H17.5042ZM11.6709 9.16649H14.1709V10.8332H11.6709V9.16649Z"
                                        fill="black" />
                                </svg>
                                My Wallet
                            </a>
                        </li> -->
                        <li>
                            <a class="my-account-nav-item  " href="{{ url('user/change-password') }}">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.0042 5.83315H17.5042C17.9645 5.83315 18.3376 6.20624 18.3376 6.66648V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H15.0042V5.83315ZM3.33757 7.49982V15.8332H16.6709V7.49982H3.33757ZM3.33757 4.16648V5.83315H13.3376V4.16648H3.33757ZM12.5042 10.8332H15.0042V12.4998H12.5042V10.8332Z"
                                        fill="black" />
                                </svg>
                        
                              Change Password
                            </a>
                        </li>
                        <!-- <li>
                            <a class="my-account-nav-item" href="{{ url('user/withdraw-history') }}">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.0042 5.83315H17.5042C17.9645 5.83315 18.3376 6.20624 18.3376 6.66648V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H15.0042V5.83315ZM3.33757 7.49982V15.8332H16.6709V7.49982H3.33757ZM3.33757 4.16648V5.83315H13.3376V4.16648H3.33757ZM12.5042 10.8332H15.0042V12.4998H12.5042V10.8332Z"
                                        fill="black" />
                                </svg>
                        
                                Withdraw History
                            </a>
                        </li> -->
                        <!-- <li>
                            <a class="my-account-nav-item  active" href="{{ url('user/bank-detail') }}">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1.66699 16.6667H18.3337V18.3334H1.66699V16.6667ZM3.33366 10.0001H5.00032V15.8334H3.33366V10.0001ZM7.50032 10.0001H9.16699V15.8334H7.50032V10.0001ZM10.8337 10.0001H12.5003V15.8334H10.8337V10.0001ZM15.0003 10.0001H16.667V15.8334H15.0003V10.0001ZM1.66699 5.83341L10.0003 1.66675L18.3337 5.83341V9.16675H1.66699V5.83341ZM3.33366 6.86347V7.50008H16.667V6.86347L10.0003 3.53014L3.33366 6.86347ZM10.0003 6.66675C9.54007 6.66675 9.16699 6.29365 9.16699 5.83341C9.16699 5.37318 9.54007 5.00008 10.0003 5.00008C10.4606 5.00008 10.8337 5.37318 10.8337 5.83341C10.8337 6.29365 10.4606 6.66675 10.0003 6.66675Z"
                                        fill="black" />
                                </svg>
                        
                        
                                Bank Detail
                            </a>
                        </li> -->
                       
                        <li>
                            <a class="my-account-nav-item" href="{{ url('logout') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif


    <script>
        new WOW().init();
    </script>

    
    <script src="{{ url('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('frontend/js/wow.min.js') }}"></script>
    <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('frontend/js/addtocart.js') }}"></script>
    <script src="{{ url('frontend/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


     @yield('script')
     <script type="text/javascript">


document.addEventListener("DOMContentLoaded", function () {
    const quickAddBtns = document.querySelectorAll(".quick-add-btn");


    quickAddBtns.forEach(btn => {
    btn.addEventListener("click", function () {
        let basePrice = parseFloat(this.dataset.price) || 0; // base product price
        $('#modal_base_price').val(basePrice);
        let oldPrice = parseFloat(this.dataset.oldPrice || 0);
        let title = this.dataset.title;
        let image = this.dataset.image;
        let url = this.dataset.url;
        let colors = JSON.parse(this.dataset.colors || "[]");
        let sizes = JSON.parse(this.dataset.sizes || "[]");

        // Fill modal fields
        document.getElementById("modal_product_id").value = this.dataset.id;
        document.getElementById("modal_final_price").value = basePrice;

        document.getElementById("quickAddTitle").textContent = title;
        document.getElementById("quickAddTitle").href = url;
        document.getElementById("quickAddPrice").textContent = basePrice.toFixed(2);
        document.getElementById("quickAddOldPrice").textContent = oldPrice > 0 ? oldPrice.toFixed(2) : "";
        document.getElementById("quickAddImage").src = image;

        // Colors
        let colorHtml = "";
        colors.forEach((color, i) => {
            colorHtml += `
              <label class="color-btn ${i === 0 ? 'active' : ''}" style="background:${color.color_code || color.name}">
                <input type="radio" name="color_id" value="${color.id}" ${i === 0 ? 'checked' : ''}/>
              </label>`;
        });
        document.getElementById("quickAddColors").innerHTML = colorHtml;

        // Sizes
        let sizeHtml = "";
        sizes.forEach((size, i) => {
            sizeHtml += `
              <label class="size-btn ${i === 0 ? 'active' : ''}">
                <input type="radio" name="size_id" value="${size.id}" data-price="${size.price}" ${i === 0 ? 'checked' : ''}/>
                <span>${size.name}</span>
              </label>`;
        });
        document.getElementById("quickAddSizes").innerHTML = sizeHtml;

        // Price update function
        function updatePrice() {
            const selectedSize = document.querySelector('#quickAddSizes input[name="size_id"]:checked');
            console.log('basePrice');
            let extraPrice = selectedSize ? parseFloat(selectedSize.dataset.price) || 0 : 0;
            let finalPrice = basePrice + extraPrice;

            document.getElementById("quickAddPrice").textContent = finalPrice.toFixed(2);
            document.getElementById("modal_final_price").value = finalPrice.toFixed(2);
        }

        // Bind change event to sizes
        document.querySelectorAll('#quickAddSizes input[name="size_id"]').forEach(input => {
            input.addEventListener("change", updatePrice);
        });

        // Run once on load
        updatePrice();
    });
});



        // Quantity +/-



 $(document).ready(function () {
    // Handle +/-
    $(document).on("click", ".btn-increase, .btn-decrease", function () {
        let $input = $(this).siblings(".quantity-product");
        let val = parseInt($input.val()) || 0;

        if ($(this).hasClass("btn-increase")) {
            $input.val(val + 1);
        } else if ($(this).hasClass("btn-decrease") && val > 1) {
            $input.val(val - 1);
        }
    });

    // Handle color change (if needed)
    $(document).on("click", ".colorChange", function () {
        var id = $(this).attr("id");
        $("#getColorID").val(id);
    });
});


    document.addEventListener("click", function(e) {
    // Handle color selection
    if (e.target.closest(".color-btn")) {
        document.querySelectorAll("#quickAddColors .color-btn").forEach(el => el.classList.remove("active"));
        let label = e.target.closest(".color-btn");
        label.classList.add("active");
        label.querySelector("input").checked = true;
    }

    // Handle size selection
    if (e.target.closest(".size-btn")) {
        document.querySelectorAll("#quickAddSizes .size-btn").forEach(el => el.classList.remove("active"));
        let label = e.target.closest(".size-btn");
        label.classList.add("active");
        label.querySelector("input").checked = true;

        // Update price if size has its own price
        let sizeInput = label.querySelector("input");

        var basePrice = $('#modal_base_price').val();

        let newPrice = parseFloat(basePrice) + parseFloat(sizeInput.dataset.price) || parseFloat(document.querySelector(".quick-add-btn").dataset.price);

        document.getElementById("quickAddPrice").textContent = newPrice;
        document.getElementById("modal_final_price").value = newPrice;
    }
});


});



     $('body').delegate('.btn-add-remove-wishlist','click',function() {
            var product_id = $(this).attr('id');
          
            $.ajax({
                  url: "{{ url('user/add-remove-wishlist') }}",
                  type: "POST",
                  data:{
                    "_token": "{{ csrf_token() }}",
                    "product_id": product_id
                   },
                   dataType:"json",
                   success:function(response){
                        if(response.status == 0)
                        {
                            $('.add-remove-wishlist-text'+product_id).html('Add to wishlist');
                        }
                        else
                        {
                            $('.add-remove-wishlist-text'+product_id).html('Remove to wishlist');
                        }
                        
                        $('.add-remove-wishlist'+product_id).html(response.html);
                   },
            });
        });



         $('.ajax-submit').submit(function(e) {
                e.preventDefault();
                $('.newsletter-signup-success').hide();
                $('.newsletter-signup-error').hide();
                $.ajax({
                    type:'POST',
                    url:$(this).attr('action'),
                    data: $(this).serializeArray(),
                    dataType: 'JSON',
                    success:function(data){
                        if(data.status == true)
                        {
                            $('.newsletter-signup-success').show();
                            $('.newsletter-signup-success').html(data.message);                            
                            $('.newsletter-email').val('');
                        }                     
                        else
                        {
                            $('.newsletter-signup-error').html(data.message);
                            $('.newsletter-signup-error').show();
                        }   
                    }
                });            
            });       
   

     </script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("modalSearchInput");
    const listContainer = document.getElementById("modalProductList");

    let timer;
    input.addEventListener("keyup", function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let query = input.value;

            fetch("{{ route('products.search') }}?title=" + encodeURIComponent(query))
                .then(res => res.text())
                .then(html => {
                    listContainer.innerHTML = html;
                })
                .catch(err => console.error(err));
        }, 300); // debounce 300ms
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const currentUrl = window.location.href;

  document.querySelectorAll(".my-account-nav-item").forEach(link => {
    if (currentUrl === link.href) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
});
</script>




     @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        @endif


<script>

//   Add To CART Button Tracking

  document.getElementById('addToCartBtn').addEventListener('click', function() {

    // Fire Facebook Pixel AddToCart event immediately
    fbq('track', 'AddToCart');

    console.log('Pixel AddToCart fired for:DONE::::::');
  });


  // Search tracking
  const searchForm = document.getElementById('modalSearchForm');
  const searchInput = document.getElementById('modalSearchInput');

  if (searchForm && searchInput) {
    searchForm.addEventListener('submit', function (e) {
      // Get the search term
      const searchTerm = searchInput.value.trim();

      // Fire Facebook Pixel Search event
      fbq('track', 'Search', {
        search_string: searchTerm || '(empty)'
      });

      console.log('Pixel Search fired for:', searchTerm);

      // Continue with normal form submission
      // (don’t preventDefault() unless you want AJAX search)
    });
  }



</script>

        
<script>
document.addEventListener("DOMContentLoaded", function () {
  // Initialize swiper when modal opens
  const sizeGuideModal = document.getElementById('sizeGuideModal');
  let sizeGuideSwiper;

  sizeGuideModal.addEventListener('shown.bs.modal', function () {
    if (!sizeGuideSwiper) {
      sizeGuideSwiper = new Swiper(".sizeGuideSwiper", {
        loop: true,
        grabCursor: true,         // 👈 Enables mouse drag on desktop
        spaceBetween: 20,
        slidesPerView: 1,
        // navDots: false;
        // centeredSlides: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        keyboard: {
          enabled: true,
        },
      });
    }
  });
});
</script>




</body>

</html>