@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')


  <div class="tf-breadcrumb">
            <!-- <div class="container">
                <div class="tf-breadcrumb-wrap">
                    <div class="tf-breadcrumb-list">
                        <a class="text text-caption-1" href="{{ url('/') }}">Home</a><i
                            class="icon icon-arrRight"></i>
                            @if(!empty($getCategory))
                             @foreach($getCategory as $cate)
                                <span class="text text-caption-1"><a href="{{ $cate['url'] }}">{{ $cate['name'] }}</a></span> >
                             @endforeach
                          @endif
                          <span class="text text-caption-1">  
                          {{ $product->title }}</span>
                        </div>
                    </div>
                </div>
            </div> -->
        <section class="flat-spacing mobile-padding">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div class="swiper tf-product-media-thumbs other-image-zoom" dir="ltr">
                                        <div class="swiper-wrapper">
                                           
                                       

                                            @foreach($product->image as $image)
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item"><img data-src="{{ $image->photo() }}"
                                                        alt="{{ $product->title }}" loading="lazy"  decoding="async"
                                                        data-nimg="1" class="lazyload" style="color:transparent"
                                                        src="{{ $image->photo() }}" /></div>
                                            </div>
                                            @endforeach

                                            @if(!empty($product->getVideoFile()))
                                             <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <video controls style="">
                                                        <source src="{{ $product->getVideoFile() }}" type="video/mp4">
                                                    </video>
                                                </div>
                                             </div>
                                            @endif
                                            
                                          
                                        </div>
                                    </div>
                                    <div class="swiper tf-product-media-main" dir="ltr" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">

                                            @foreach($product->image as $image)
                                                <div class="swiper-slide" data-color="gray">
                                                    <a href="images/products/womens/women-19.jpg" target="_blank"
                                                        class="item" >
                                                     <img data-zoom="{{ $image->getorignal() }}"
                                                            data-src="{{ $image->getorignal() }}" alt=""
                                                            loading="lazy"  decoding="async"
                                                            data-nimg="1" class="tf-image-zoom lazyload"
                                                            style="color:transparent"
                                                            src="{{ $image->getorignal() }}" /></a>
                                                </div>
                                            @endforeach
                                        
                                            @if(!empty($product->getVideoFile()))
                                            <div class="swiper-slide" data-color="gray">
                                                <div class="item">
                                                   <video controls style="">
                                                      <source src="{{ $product->getVideoFile() }}" type="video/mp4">
                                                   </video>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative mw-100p-hidden ">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-heading">
                                        <div class="tf-product-info-name">
                                            {{-- <div class="text text-btn-uppercase">Clothing</div> --}}
                                            <h3 class="name">{!! $product->title !!}</h3>
                                            <div class="sub">
                                               
                                  
                                            </div>
                                        </div>
                                        <div class="tf-product-info-desc">
                                         <h5 class="price-on-sale font-2">
                                            ₹<span id="product-price">{{ number_format($product->price, 2) }}</span>
                                            <span style="color: #9a9a9a; font-size: 20px;">
                                                <strike>₹{{ number_format($product->old_price,2) }}</strike>
                                            </span>
                                        </h5>

                                            <p>{{ $product->title_description }}</p>
                                         
                                        </div>
                                    </div>

                                    <form class="tf-product-info-choose-option" action="{{ url('add_cart_product') }}" method="post">
                                         {{ csrf_field() }}
                                     <input type="hidden" name="final_price" id="final-price-input" value="{{ $product->price }}">


                                     <input type="hidden" name="product_id" value="{{ $product->id }}">
                                          @if($product->getcolor->count() > 0)

                                          <input type="hidden" name="color_id" id="getColorID" value="{{ $product->getcolor->first()->id }} ">
                                        <div class="variant-picker-item">
                                            <div class="variant-picker-label mb_12">
                                                Colors:
                                                <span class="text-title variant-picker-label-value value-currentColor" style="text-transform:capitalize">
                                                    {{ $product->getcolor->first()->name }} 
                                                </span>
                                            </div>
                                            <div class="variant-picker-values">
                                                @foreach($product->getcolor as $index => $getcolor)
                                                    <input 
                                                        id="values-{{ strtolower($getcolor->name) }}" 
                                                        type="radio" 
                                                        value="{{ $getcolor->id }}" 
                                                        {{ $index == 0 ? 'checked' : '' }} 
                                                        required 
                                                    />
                                                    <label id="{{ $getcolor->id }}" 
                                                        class="colorChange hover-tooltip tooltip-bot radius-60 color-btn {{ $index == 0 ? 'active' : '' }}" 
                                                        for="values-{{ strtolower($getcolor->name) }}"
                                                    >
                                                        <span class="btn-checkbox" style="background: {{ !empty($getcolor->color_code) ? $getcolor->color_code : $getcolor->name }}; border: 1px solid #f6f6f6 ;"></span>
                                                        <span class="tooltip">{{ $getcolor->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($product->getsize->count() > 0)
                                        <div class="variant-picker-item">
                                            <div class="d-flex justify-content-between mb_12">
                                                <div class="variant-picker-label">
                                                    Selected size:
                                                    <span class="text-title variant-picker-label-value">
                                                        {{ $product->getsize->first()->name }}
                                                    </span>
                                                </div>
                                               @if($hasSizeGuide)
                                                <div class="size-guide">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#sizeGuideModal">
                                                        Size Guide
                                                    </a>
                                                </div>
                                                @endif


                                            </div>

                                            <div class="variant-picker-values gap12">
                                                @foreach($product->getsize as $index => $getsize)
                                                    <div>
                                                        <input 
                                                            type="radio" 
                                                            name="size_id" 
                                                            id="values-{{ strtolower($getsize->name) }}" 
                                                            value="{{ $getsize->id }}" 
                                                            data-extra="{{ $getsize->price }}" 
                                                            {{ $index == 0 ? 'checked' : '' }} 
                                                            required
                                                        />
                                                        <label 
                                                            class="style-text size-btn {{ $index == 0 ? 'active' : '' }}" 
                                                            for="values-{{ strtolower($getsize->name) }}"
                                                            data-value="{{ $getsize->name }}"
                                                        >
                                                            <span class="text-title">{{ $getsize->name }}</span>
                                                           
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    @endif


                                        <div class="tf-product-info-quantity">
                                            <div class="title mb_12">Quantity:</div>
                                            <div class="d-flex align-items-center">
                                                <div class="wg-quantity  "><span class="btn-quantity btn-decrease"
                                                        role="button" tabindex="0">-</span><input
                                                        class="quantity-product" type="number" name="qty"
                                                        value="1" /><span class="btn-quantity btn-increase"
                                                        role="button" tabindex="0">+</span></div>
                                                
                                            </div>
                                        </div>
                 

                                         <div>
                                            <div class="tf-product-info-by-btn mb_10">
                                                <button id="addToCartBtn" type="submit" value="2" name="add_cart_item" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6">
                                                    <span>Add to cart </span>
                                                </button>
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode($product->title . ' - ' . url()->current()) }}"
                                                    target="_blank"
                                                    class="box-icon hover-tooltip whatsapp-share btn-icon-action"
                                                    title="Share on WhatsApp">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 .01 5.36.01 12c0 2.12.55 4.16 1.6 5.96L0 24l6.21-1.61A11.98 11.98 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.21-3.48-8.52ZM12 22.05c-1.9 0-3.76-.5-5.39-1.46l-.39-.23-3.68.95.98-3.58-.25-.37A9.94 9.94 0 0 1 2.05 12C2.05 6.5 6.5 2.05 12 2.05S21.95 6.5 21.95 12 17.5 22.05 12 22.05Zm5.56-7.52c-.3-.15-1.79-.89-2.06-.99-.28-.1-.48-.15-.68.15-.2.3-.78.99-.96 1.19-.18.2-.35.23-.65.08-.3-.15-1.26-.47-2.4-1.49-.89-.79-1.49-1.77-1.67-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.07-.15-.68-1.64-.93-2.24-.24-.58-.48-.5-.68-.5h-.58c-.2 0-.53.08-.8.38-.28.3-1.05 1.02-1.05 2.48s1.08 2.87 1.23 3.07c.15.2 2.12 3.22 5.12 4.52.72.31 1.28.5 1.72.64.72.23 1.37.2 1.89.12.58-.09 1.79-.73 2.04-1.44.25-.7.25-1.31.18-1.44-.07-.13-.27-.2-.57-.35Z"/>
                                                        </svg>
                                                    </span>
                                                    <span class="tooltip text-caption-2">Share on WhatsApp</span>
                                                </a>

                                                        
                                                      {{--   <a href="" 
                                                    class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action"><span
                                                        class="icon icon-heart"></span><span
                                                        class="tooltip text-caption-2">Already Wishlished</span></a> --}}

                                                         <!-- @if(!empty(Auth::check()))
                                                           
                                                           <a href="javascript:void(0)" class="box-icon wishlist btn-icon-action item-option btn-add-remove-wishlist" id="{{ $product->id }}">
                                                                @if(!empty($product->userwishlist()))

                                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                                    <span class="tooltip">Wishlist</span>

                                                                 @else
                                                                 <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                                    <span class="tooltip">Wishlist</span>
                                                                @endif

                                                            </a>

                                                           @else

                                                        <a href="{{ url('login') }}" class="box-icon hover-tooltip text-caption-2 btn-icon-action item-option btn-add-remove-wishlist" id="{{ $product->id }}"><span class="icon icon-heart"></span><span class="tooltip text-caption-2">Wishlist</span></a>


                                                        @endif -->



                                                        <div class="wishlist-fix-page">
                                                            @if(!empty(Auth::check()))
                                                                <a href="javascript:void(0)" class="box-icon wishlist btn-icon-action item-option btn-add-remove-wishlist" id="{{ $product->id }}">
                                                                    @if(!empty($product->userwishlist()))
                                                                        <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                                        <span class=""></span>
                                                                    @else
                                                                        <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                                        <span class=""></span>
                                                                    @endif
                                                                </a>
                                                            @else
                                                                <a href="{{ url('login') }}" class="box-icon hover-tooltip text-caption-2 btn-icon-action item-option btn-add-remove-wishlist" id="{{ $product->id }}">
                                                                    <span class="icon icon-heart"></span>
                                                                    <span class=" text-caption-2"></span>
                                                                </a>
                                                            @endif
                                                        </div>











                                            </div>

                                            <button name="add_cart_item" type="submit" value="1" class="btn-style-3 text-btn-uppercase buy-now">Buy it
                                                now </button>
                                                
                                        </div>





                                <!-- 3-9-2025 changes start -->
                                        <div class="tf-product-info-help border-bottom-0">
                                            <div class="tf-product-info-extra-link d-block">
                                                
                                                <div class="pincode-sec">
                                                    <div class="d-flex align-items-center">
                                                        <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.86811 0C6.517 0.00270323 4.26297 0.914156 2.60048 2.53442C0.937989 4.15468 0.00278311 6.35146 9.43476e-06 8.64286C-0.0028065 10.5154 0.624792 12.3371 1.78653 13.8286C1.78653 13.8286 2.02839 14.1389 2.06789 14.1837L8.86811 22L15.6716 14.1798C15.707 14.1381 15.9497 13.8286 15.9497 13.8286L15.9505 13.8262C17.1117 12.3354 17.739 10.5145 17.7362 8.64286C17.7334 6.35146 16.7982 4.15468 15.1357 2.53442C13.4733 0.914156 11.2192 0.00270323 8.86811 0ZM8.86811 11.7857C8.23031 11.7857 7.60684 11.6014 7.07653 11.256C6.54622 10.9107 6.13289 10.4199 5.88882 9.84558C5.64474 9.27129 5.58088 8.63937 5.70531 8.02972C5.82974 7.42006 6.13687 6.86006 6.58786 6.42052C7.03885 5.98098 7.61345 5.68166 8.23899 5.56039C8.86453 5.43912 9.51293 5.50136 10.1022 5.73924C10.6914 5.97711 11.1951 6.37994 11.5494 6.89678C11.9037 7.41362 12.0929 8.02126 12.0929 8.64286C12.0918 9.47608 11.7517 10.2749 11.1472 10.864C10.5427 11.4532 9.72304 11.7847 8.86811 11.7857Z"
                                                                fill="#13294B"></path>
                                                        </svg>
                                                        <span class="ps-2">Check Your pincode for delivery</span>
                                                    </div>
                                                
                                                    <div class="p-form" id="pincodeForm">
                                                        <form action="">
                                                            <input type="text" name="pincode" placeholder="Enter Pincode"
                                                                style="padding: 10px;border: 1px solid #ccc;width: 80%;">
                                                            <button type="button" id="checkBtn">Check</button>
                                                        </form>
                                                    </div>
                                                
                                                    <!-- Hidden by default -->
                                                    <p id="deliveryMsg" style="display: none;">Estimated Delivery by Monday, September 8</p>
                                                </div>
                                            
                                            
                                                <div class="ship-sec d-flex flex-wrap justify-content-center">
                                                    @foreach($getAssurance as $value)
                                                    <div class="col-4">
                                                        <div class="ship-box">
                                                            <img src="{{ $value->getIconName() }}" alt="">
                                                            <h5>{{ $value->title }}</h5>
                                                            <p>{{ $value->sub_title }}</p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                
                                                </div>

                                                

                                            </div>
                                        </div>

                                        <!-- 3-9-2025 changes end -->

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>


    <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-1">
                            <ul class="widget-menu-tab">
                                <li class="item-title active "><span class="inner">Description</span></li>
                                {{-- <li class="item-title  "><span class="inner">Customer Reviews</span></li> --}}
                                <li class="item-title  "><span class="inner">Shipping</span></li>
                                <li class="item-title  "><span class="inner">Return</span></li>
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active ">
                                    <div class="w-100">
                                       
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                    
                                <!-- 3-9-2025 changes start -->
                                <div class="widget-content-inner  ">
                                    <div class="tab-shipping">
                                        <div class="w-100">
                                            <p>We aim to dispatch orders placed on our website within 2-3 business days upon confirmation of order to addresses within India only, subject to product availability.</p>
                                            {{-- <a class="text-decoration-underline" href="shipping-refund.html">Read More</a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-inner  ">
                                    <div class="tab-policies">
                                        <p class="text-secondary">Easy returns upto 15 days of delivery. Exchange available on selected pincodes.</p>
                                        {{-- <a class="text-decoration-underline" href="return-policy.html">Read More</a> --}}
                                    </div>
                                </div>
                                <!-- 3-9-2025 changes start -->

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- 3-9-2025 changes start -->
        <!-- Sticky Add To Cart Footer-->
{{--  --}}
        <!-- Sticky Add To Cart Footer-->
<div class="sticky-footer" id="stickyFooter">
    <div class="sticky-container">

        <!-- Product Info -->
        <div class="sticky-product">
            <div class="sticky-product-image">
                <img src="{{ $product->image->first()->photo() ?? url('frontend/images/no-image.png') }}" 
                     alt="{{ $product->title }}">
            </div>
            <div class="sticky-product-details">
                <h4 class="sticky-title">
                    {{ $product->title }} 
                </h4>
                <span class="sticky-price">₹<span id="sticky-price">{{ number_format($product->price, 2) }}</span></span>
            </div>
        </div>

        <!-- Actions -->
        <div class="sticky-actions">
            <select class="sticky-variant" id="stickyVariant">
                @if($product->getsize->count() > 0 && $product->getcolor->count() > 0)
                    {{-- Both size and color --}}
                    @foreach($product->getsize as $size)
                        @foreach($product->getcolor as $color)
                            <option 
                                value="{{ $size->id }}-{{ $color->id }}"
                                data-size="{{ $size->id }}"
                                data-color="{{ $color->id }}"
                                data-extra="{{ $size->price ?? 0 }}"
                            >
                                {{ $size->name }} / {{ $color->name }}
                            </option>
                        @endforeach
                    @endforeach

                @elseif($product->getsize->count() > 0)
                    {{-- Only size --}}
                    @foreach($product->getsize as $size)
                        <option 
                            value="{{ $size->id }}"
                            data-size="{{ $size->id }}"
                            data-extra="{{ $size->price ?? 0 }}"
                        >
                            {{ $size->name }}
                        </option>
                    @endforeach

                @elseif($product->getcolor->count() > 0)
                    {{-- Only color --}}
                    @foreach($product->getcolor as $color)
                        <option 
                            value="{{ $color->id }}"
                            data-color="{{ $color->id }}"
                        >
                            {{ $color->name }}
                        </option>
                    @endforeach

                @else
                    <option value="">Default</option>
                @endif
            </select>


    
            <form action="{{ url('add_cart_product') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="final_price" id="sticky-final-price" value="{{ $product->price }}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="size_id" id="sticky-size-id" value="">
    <input type="hidden" name="color_id" id="sticky-color-id" value="">
                <button id="addToCartBtn" type="submit" name="add_cart_item" value="2" class="sticky-btn">Add to Cart</button>
            </form>
        </div>

    </div>
</div>

        <!-- 3-9-2025 changes End -->
<!-- Size Guide Modal -->
@if($hasSizeGuide)
<div class="modal fade" id="sizeGuideModal" tabindex="-1" aria-labelledby="sizeGuideLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white">

      <div class="modal-header border-0">
        <h5 class="modal-title" id="sizeGuideLabel">Size Guide</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="swiper sizeGuideSwiper">
          <div class="swiper-wrapper">

            @foreach($sizeGuideImages as $img)
            <div class="swiper-slide">
              <img src="{{ asset('upload/size_guide/' . $img->image) }}"
                   class="img-fluid rounded" alt="Size Guide">
            </div>
            @endforeach

          </div>

          <!-- Pagination -->
          <div class="swiper-pagination"></div>

          <!-- Navigation -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>

        </div>
      </div>

    </div>
  </div>
</div>
@endif
@endsection
@section('script')
<script src="{{ url('frontend/js/fancybox.umd.js') }}"></script>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function () {
    const basePrice = parseFloat("{{ $product->price }}");
    const priceEl = document.getElementById("product-price");
    const finalPriceInput = document.getElementById("final-price-input");

    function updatePrice() {
        const selectedSize = document.querySelector('input[name="size_id"]:checked');
        let extra = 0;
        if (selectedSize) {
            extra = parseFloat(selectedSize.getAttribute("data-extra")) || 0;
        }
        const finalPrice = basePrice + extra;

        // Update text on UI
        priceEl.textContent = finalPrice.toLocaleString("en-IN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        // Update hidden input for form submission
        finalPriceInput.value = finalPrice.toFixed(2);
    }

    // Run once on load
    updatePrice();

    // Listen for size change
    document.querySelectorAll('input[name="size_id"]').forEach(input => {
        input.addEventListener("change", updatePrice);
    });
});





document.addEventListener("DOMContentLoaded", function () {
    const stickyBasePrice = parseFloat("{{ $product->price }}");
    const stickyPriceEl = document.getElementById("sticky-price");
    const stickyFinalPriceInput = document.getElementById("sticky-final-price");
    const stickyVariantSelect = document.getElementById("stickyVariant");
    const stickySizeInput = document.getElementById("sticky-size-id");
    const stickyColorInput = document.getElementById("sticky-color-id");

    function updateStickyData() {
        if (!stickyVariantSelect) return;

        const selectedOption = stickyVariantSelect.options[stickyVariantSelect.selectedIndex];

        const extra = parseFloat(selectedOption.getAttribute("data-extra")) || 0;
        const finalPrice = stickyBasePrice + extra;

        // Extract size_id and color_id from data attributes
        const sizeId = selectedOption.getAttribute("data-size") || "";
        const colorId = selectedOption.getAttribute("data-color") || "";

        // Update price visually
        stickyPriceEl.textContent = finalPrice.toLocaleString("en-IN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        // Update hidden inputs for form submission
        stickyFinalPriceInput.value = finalPrice.toFixed(2);
        stickySizeInput.value = sizeId;
        stickyColorInput.value = colorId;
    }

    // Run once on page load
    updateStickyData();

    // Run again when the dropdown changes
    stickyVariantSelect.addEventListener("change", updateStickyData);
});



</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const wishlistBtns = document.querySelectorAll(".btn-add-remove-wishlist");

    wishlistBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            this.classList.toggle("active");
        });
    });
});
</script> 


<script>
fbq('track', 'ViewContent');
  document.getElementById('addToCartBtn').addEventListener('click', function() {

    // Fire Facebook Pixel AddToCart event immediately
    fbq('track', 'AddToCart');

    console.log('Pixel AddToCart fired for:DONE::::::');
  });
</script>

         
         
@endsection