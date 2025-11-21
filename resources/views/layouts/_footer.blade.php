@php
    $getHomeFooter = App\Models\FooterModel::first();
    $getHomeHeader = App\Models\HeaderModel::first();
    $getContactSetting = App\Models\ContactSettingModel::first();
    $getSocial = App\Models\SocialModel::get();
    $getParentCategory = App\Models\CategoryModel::getParentCategory(0);
@endphp

<!-- footer -->
<footer id="footer" class="footer   ">
    <div class="footer-wrap ">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <a href="{{ url('/') }}">
                                    <img alt="" loading="lazy" width="127" height="24" decoding="async" data-nimg="1"
                                        style="color:transparent;" src="{{ $getHomeHeader->getLogo() }}" />
                                </a>
                            </div>
                            @if(!empty($getContactSetting->address_full))
                                <div class="footer-address">
                                    <p>{{ $getContactSetting->address_full }}</p>
                                </div>
                            @endif
                            <ul class="footer-info">
                                @if(!empty($getContactSetting->email_id))
                                    <li>
                                        <i class="icon-mail"></i>
                                        <p>{{ $getContactSetting->email_id }}</p>
                                    </li>
                                @endif
                                @if(!empty($getContactSetting->phone_number))
                                    <li>
                                        <i class="icon-phone"></i>
                                        <p>{{ $getContactSetting->phone_number }}</p>
                                    </li>
                                @endif
                            </ul>
                            <ul class="tf-social-icon   ">

                                @if(!empty($getHomeFooter->facebook_link))

                                    <li>
                                        <a href="{{ $getHomeFooter->facebook_link }}" target="_blank"
                                            class="social-facebook">

                                            <i class="icon icon-fb"></i>
                                        </a>
                                    </li>

                                @endif
                                @if(!empty($getHomeFooter->instagram_link))
                                    <li>
                                        <a href="{{ $getHomeFooter->instagram_link }}" target="_blank"
                                            class="social-facebook">

                                            <i class="icon icon-instagram"></i>
                                        </a>
                                    </li>
                                @endif



                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-menu">
                            <div class="footer-col-block">
                                @if(!empty($getHomeFooter->infomation))
                                    <div class="footer-heading text-button footer-heading-mobile">
                                        {{ $getHomeFooter->infomation }}
                                    </div>
                                @endif
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        @if(!empty($getHomeFooter->home))
                                            <li class="text-caption-1">
                                                <a class="footer-menu_item"
                                                    href="{{ url('/') }}">{{ $getHomeFooter->home }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->about_us))
                                            <li class="text-caption-1">
                                                <a class="footer-menu_item"
                                                    href="{{ url('about') }}">{{ $getHomeFooter->about_us }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->contact_us))
                                            <li class="text-caption-1">
                                                <a class="footer-menu_item"
                                                    href="{{ url('contact') }}">{{ $getHomeFooter->contact_us }}</a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="footer-col-block">
                                @if(!empty($getHomeFooter->customer_services))
                                    <div class="footer-heading text-button footer-heading-mobile">
                                        {{ $getHomeFooter->customer_services }}
                                    </div>
                                @endif
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        @if(!empty($getHomeFooter->shipping_policy))
                                            <li class="text-caption-1">
                                                <a href="{{ url('shipping-refund') }}"
                                                    class="footer-menu_item">{{ $getHomeFooter->shipping_policy }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->return_policy))
                                            <li class="text-caption-1">
                                                <a href="{{ url('return-policy') }}"
                                                    class="footer-menu_item">{{ $getHomeFooter->return_policy }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->privacy))
                                            <li class="text-caption-1">
                                                <a href="{{ url('privacy') }}"
                                                    class="footer-menu_item">{{ $getHomeFooter->privacy }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->terms))
                                            <li class="text-caption-1">
                                                <a class="footer-menu_item"
                                                    href="{{ url('terms') }}">{{ $getHomeFooter->terms }}</a>
                                            </li>
                                        @endif
                                        @if(!empty($getHomeFooter->cancellation_policy))
                                            <li class="text-caption-1">
                                                <a class="footer-menu_item"
                                                    href="{{ url('cancellation_policy') }}">{{ $getHomeFooter->cancellation_policy }}</a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-col-block">
                            @if(!empty($getHomeFooter->newletter))
                                <div class="footer-heading text-button footer-heading-mobile">
                                    {{ $getHomeFooter->newletter }}
                                </div>
                            @endif
                            <div class="tf-collapse-content">
                                {{-- Message start --}}
                                <div style="display: none; margin-top: 15px; color:rgb(52, 168, 83)"
                                    class="alert alert-success newsletter-signup-success" role="alert"></div>
                                <div style="display: none; margin-top: 15px; color:rgb(52, 168, 83)"
                                    class="alert alert-danger newsletter-signup-error" role="alert"></div>

                                {{-- Message end --}}

                                <div class="footer-newsletter">
                                    @if(!empty($getHomeFooter->newletter_d))
                                        <p class="text-caption-1">{{ $getHomeFooter->newletter_d }}</p>
                                    @endif
                                    <div class="tfSubscribeMsg  footer-sub-element ">



                                        <p style="color:rgb(52, 168, 83)">You have successfully subscribed.</p>
                                    </div>
                                    <form class="form-newsletter subscribe-form ajax-submit" method="post"
                                        action="{{ url('email-subscribe') }}">
                                        {{ csrf_field() }}
                                        <div class="subscribe-content">
                                            <fieldset class="email">
                                                <input type="email" class="subscribe-email"
                                                    placeholder="Enter your e-mail" tabindex="0" aria-required="true"
                                                    name="email" required value="{{ old('email') }}" />
                                            </fieldset>
                                            <div class="button-submit">
                                                <button class="subscribe-button" type="submit">
                                                    <i class="icon icon-arrowUpRight"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="subscribe-msg"></div>
                                    </form>
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            {{-- <input class="" type="checkbox" id="footer-Form_agree"
                                                name="agree_checkbox" />
                                            <div>
                                                <i class="icon-check"></i>
                                            </div> --}}
                                        </div>
                                        <label class="text-caption-1" for="footer-Form_agree">
                                            By clicking subcribe, you agree to the
                                            <!-- -->
                                            @if(!empty($getHomeFooter->terms))
                                                <a class="fw-6 link"
                                                    href="{{ url('terms') }}">{{ $getHomeFooter->terms }}</a>
                                            @endif
                                            and
                                            <!-- -->
                                            @if(!empty($getHomeFooter->privacy))
                                                <a class="fw-6 link"
                                                    href="{{ url('privacy') }}">{{ $getHomeFooter->privacy }}</a>
                                                .
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-wrap">
                            <div class="left">
                                <p class="text-caption-1">©
                                    <!-- -->
                                    {{ date('Y') }}
                                    <!-- -->
                                    Only4Ever. All Rights Reserved.
                                </p>
                                <!-- <div class="tf-cur justify-content-end">
                                            
                                            <div class="tf-currencies">
                                                <div class="dropdown bootstrap-select image-select center style-default type-currencies dropup">
                                                    <button type="button" class="btn dropdown-toggle btn-light currency-btn" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                                <div class="filter-option-inner-inner">
                                                                    <img src="{{ url('frontend/images/country/Flag_of_India.svg.png') }}" alt="INR" width="18" class="me-1" />
                                                                    INR
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item active selected" href="#" data-value="INR"
                                                                data-img="{{ url('frontend/images/country/Flag_of_India.svg.png') }}">
                                                                <img src="{{ url('frontend/images/country/Flag_of_India.svg.png') }}" alt="INR" width="18" class="me-1" /> INR
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-value="USA" data-img="{{ url('frontend/images/country/us.svg') }}">
                                                                <img src="{{ url('frontend/images/country/us.svg') }}" alt="USD" width="18" class="me-1" /> USD
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
                                                                <div class="filter-option-inner-inner">English</div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item  selected" href="#" data-value="Hindi">Hindi</a></li>
                                                        <li><a class="dropdown-item active" href="#" data-value="English">English</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>-->
                            </div>
                            <div class="tf-payment">
                                <p class="text-caption-1">Payment:</p>
                                <ul>
                                    <li>
                                        <img alt="" loading="lazy" width="100" height="64" decoding="async"
                                            data-nimg="1" style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-1.png') }}" />
                                    </li>
                                    <li>
                                        <img alt="" loading="lazy" width="100" height="64" decoding="async"
                                            data-nimg="1" style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-2.png') }}" />
                                    </li>
                                    <li>
                                        <img alt="" loading="lazy" width="100" height="64" decoding="async"
                                            data-nimg="1" style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-3.png') }}" />
                                    </li>
                                    <li>
                                        <img alt="" loading="lazy" width="98" height="64" decoding="async" data-nimg="1"
                                            style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-4.png') }}" />
                                    </li>
                                    <li>
                                        <img alt="" loading="lazy" width="102" height="64" decoding="async"
                                            data-nimg="1" style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-5.png') }}" />
                                    </li>
                                    <li>
                                        <img alt="" loading="lazy" width="98" height="64" decoding="async" data-nimg="1"
                                            style="color:transparent"
                                            src="{{ url('frontend/images/payment/img-6.png') }}" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- scroll-top-button -->
<button id="scroll-top" class="scroll-top-button  ">
    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_15741_24194)">
            <path
                d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </g>
        <defs>
            <clipPath id="clip0_15741_24194">
                <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"></rect>
            </clipPath>
        </defs>
    </svg>
</button>




<div class="tf-toolbar-bottom">
    <div class="toolbar-item">
        <a href="{{ url('/') }}">
            <div class="toolbar-icon">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" class="icon" y="0px" width="20" height="20"
                    viewBox="0 0 50 50">
                    <path
                        d="M 24.962891 1.0546875 A 1.0001 1.0001 0 0 0 24.384766 1.2636719 L 1.3847656 19.210938 A 1.0005659 1.0005659 0 0 0 2.6152344 20.789062 L 4 19.708984 L 4 46 A 1.0001 1.0001 0 0 0 5 47 L 18.832031 47 A 1.0001 1.0001 0 0 0 19.158203 47 L 30.832031 47 A 1.0001 1.0001 0 0 0 31.158203 47 L 45 47 A 1.0001 1.0001 0 0 0 46 46 L 46 19.708984 L 47.384766 20.789062 A 1.0005657 1.0005657 0 1 0 48.615234 19.210938 L 41 13.269531 L 41 6 L 35 6 L 35 8.5859375 L 25.615234 1.2636719 A 1.0001 1.0001 0 0 0 24.962891 1.0546875 z M 25 3.3222656 L 44 18.148438 L 44 45 L 32 45 L 32 26 L 18 26 L 18 45 L 6 45 L 6 18.148438 L 25 3.3222656 z M 37 8 L 39 8 L 39 11.708984 L 37 10.146484 L 37 8 z M 20 28 L 30 28 L 30 45 L 20 45 L 20 28 z">
                    </path>
                </svg>
            </div>
            <div class="toolbar-label">Home</div>
        </a>
    </div>
    <div class="toolbar-item">
        <a href="#shopCategories" data-bs-toggle="offcanvas" aria-controls="shopCategories">
            <div class="toolbar-icon">
                <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.5 10C17.5 10.1658 17.4342 10.3247 17.3169 10.4419C17.1997 10.5592 17.0408 10.625 16.875 10.625H3.125C2.95924 10.625 2.80027 10.5592 2.68306 10.4419C2.56585 10.3247 2.5 10.1658 2.5 10C2.5 9.83424 2.56585 9.67527 2.68306 9.55806C2.80027 9.44085 2.95924 9.375 3.125 9.375H16.875C17.0408 9.375 17.1997 9.44085 17.3169 9.55806C17.4342 9.67527 17.5 9.83424 17.5 10ZM3.125 5.625H16.875C17.0408 5.625 17.1997 5.55915 17.3169 5.44194C17.4342 5.32473 17.5 5.16576 17.5 5C17.5 4.83424 17.4342 4.67527 17.3169 4.55806C17.1997 4.44085 17.0408 4.375 16.875 4.375H3.125C2.95924 4.375 2.80027 4.44085 2.68306 4.55806C2.56585 4.67527 2.5 4.83424 2.5 5C2.5 5.16576 2.56585 5.32473 2.68306 5.44194C2.80027 5.55915 2.95924 5.625 3.125 5.625ZM16.875 14.375H3.125C2.95924 14.375 2.80027 14.4408 2.68306 14.5581C2.56585 14.6753 2.5 14.8342 2.5 15C2.5 15.1658 2.56585 15.3247 2.68306 15.4419C2.80027 15.5592 2.95924 15.625 3.125 15.625H16.875C17.0408 15.625 17.1997 15.5592 17.3169 15.4419C17.4342 15.3247 17.5 15.1658 17.5 15C17.5 14.8342 17.4342 14.6753 17.3169 14.5581C17.1997 14.4408 17.0408 14.375 16.875 14.375Z"
                        fill="#4D4E4F"></path>
                </svg>
            </div>
            <div class="toolbar-label">Categories</div>
        </a>
    </div>
    <div class="toolbar-item">
        <a href="#search" data-bs-toggle="modal">
            <div class="toolbar-icon">
                <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.9419 17.058L14.0302 13.1471C15.1639 11.7859 15.7293 10.04 15.6086 8.27263C15.488 6.50524 14.6906 4.85241 13.3823 3.65797C12.074 2.46353 10.3557 1.81944 8.58462 1.85969C6.81357 1.89994 5.12622 2.62143 3.87358 3.87407C2.62094 5.12671 1.89945 6.81406 1.8592 8.5851C1.81895 10.3561 2.46304 12.0745 3.65748 13.3828C4.85192 14.691 6.50475 15.4884 8.27214 15.6091C10.0395 15.7298 11.7854 15.1644 13.1466 14.0306L17.0575 17.9424C17.1156 18.0004 17.1845 18.0465 17.2604 18.0779C17.3363 18.1094 17.4176 18.1255 17.4997 18.1255C17.5818 18.1255 17.6631 18.1094 17.739 18.0779C17.8149 18.0465 17.8838 18.0004 17.9419 17.9424C17.9999 17.8843 18.046 17.8154 18.0774 17.7395C18.1089 17.6636 18.125 17.5823 18.125 17.5002C18.125 17.4181 18.1089 17.3367 18.0774 17.2609C18.046 17.185 17.9999 17.1161 17.9419 17.058ZM3.12469 8.75018C3.12469 7.63766 3.45459 6.55012 4.07267 5.6251C4.69076 4.70007 5.56926 3.9791 6.5971 3.55336C7.62493 3.12761 8.75593 3.01622 9.84707 3.23326C10.9382 3.4503 11.9405 3.98603 12.7272 4.7727C13.5138 5.55937 14.0496 6.56165 14.2666 7.6528C14.4837 8.74394 14.3723 9.87494 13.9465 10.9028C13.5208 11.9306 12.7998 12.8091 11.8748 13.4272C10.9497 14.0453 9.86221 14.3752 8.74969 14.3752C7.25836 14.3735 5.82858 13.7804 4.77404 12.7258C3.71951 11.6713 3.12634 10.2415 3.12469 8.75018Z"
                        fill="#4D4E4F"></path>
                </svg>
            </div>
            <div class="toolbar-label">Search</div>
        </a>
    </div>
    <!-- @if(!empty(Auth::check()))
            <div class="toolbar-item">
                <a href="{{ url('user/wishlist') }}">
                    <div class="toolbar-icon">
                        <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.4215 4.45326C16.5724 3.60627 15.4225 3.12997 14.2231 3.1285C13.0238 3.12704 11.8727 3.60054 11.0215 4.44545L9.99965 5.39467L8.97699 4.44232C8.12602 3.59373 6.9728 3.11795 5.77103 3.11963C4.56926 3.12132 3.41738 3.60034 2.56879 4.45131C1.7202 5.30228 1.24441 6.4555 1.2461 7.65727C1.24778 8.85904 1.7268 10.0109 2.57777 10.8595L9.55824 17.9423C9.6164 18.0014 9.68572 18.0483 9.76217 18.0803C9.83862 18.1123 9.92067 18.1288 10.0036 18.1288C10.0864 18.1288 10.1685 18.1123 10.2449 18.0803C10.3214 18.0483 10.3907 18.0014 10.4489 17.9423L17.4215 10.8595C18.2707 10.0098 18.7477 8.85768 18.7477 7.65639C18.7477 6.45509 18.2707 5.30296 17.4215 4.45326ZM16.5348 9.98139L9.99965 16.6095L3.46059 9.97514C2.8452 9.35975 2.49948 8.52511 2.49948 7.65482C2.49948 6.78454 2.8452 5.9499 3.46059 5.33451C4.07597 4.71913 4.91061 4.37341 5.7809 4.37341C6.65118 4.37341 7.48583 4.71913 8.10121 5.33451L8.11684 5.35014L9.57387 6.7056C9.68953 6.81324 9.84166 6.87307 9.99965 6.87307C10.1576 6.87307 10.3098 6.81324 10.4254 6.7056L11.8825 5.35014L11.8981 5.33451C12.5139 4.71954 13.3488 4.37438 14.219 4.37497C15.0893 4.37555 15.9237 4.72184 16.5387 5.33764C17.1537 5.95344 17.4988 6.78831 17.4983 7.6586C17.4977 8.52888 17.1514 9.36329 16.5356 9.97826L16.5348 9.98139Z"
                                fill="#4D4E4F"></path>
                        </svg>
                    </div>
                    <div class="toolbar-label">Wishlist</div>
                </a>
            </div>
              @endif -->
    <div class="toolbar-item">
        <a href="#shoppingCart" data-bs-toggle="modal">
            <div class="toolbar-icon">
                <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.75 8.23389V4.48389C13.75 3.48932 13.3549 2.5355 12.6517 1.83224C11.9484 1.12897 10.9946 0.733887 10 0.733887C9.00544 0.733887 8.05161 1.12897 7.34835 1.83224C6.64509 2.5355 6.25 3.48932 6.25 4.48389V8.23389M3.4375 6.35889H16.5625L17.5 17.6089H2.5L3.4375 6.35889Z"
                        stroke="#4D4E4F" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </div>
            <div class="toolbar-label">Cart</div>
        </a>
    </div>

    <div class="toolbar-item">
        <a href="{{ url('user/profile') }}">
            <div class="toolbar-icon">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                        stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                        stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <div class="toolbar-label">Account</div>
        </a>
    </div>
</div>




<div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
    <div class="canvas-wrapper">
        <div class="canvas-header">
            <span class="icon-left icon-filter"></span>
            <h5>Categories</h5>
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        </div>
        <div class="canvas-body">
            @foreach($getParentCategory as $value)
                @foreach($value->subcategory as $subcategory)
                    <div class="wd-facet-categories">
                        <div role="dialog" class="facet-title collapsed" data-bs-target="#forWomen" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="forWomen">
                            <img alt="avt" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" class="avt"
                                style="color:transparent" src="{{ $subcategory->getCategoryImage() }}" />
                            <a href="{{ url('a/' . $value->slug . '/' . $subcategory->slug) }}">
                                <span class="title">{{ $subcategory->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforeach



        </div>
    </div>
</div>






</div>