<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $getHomeHeader = App\Models\HeaderModel::first();
 
        $getFrontProductsApp = App\Models\ProductModel::getFrontProductsApp();

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
   
     <style type="text/css">
        
    </style>
    @yield('style')                                

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


                        <li class="nav-mb-item">
                            <a href="" class="collapsed mb-menu-link ">
                                <span>About Us</span>
                                <!-- <span class="btn-open-sub"></span> -->
                            </a>
                        </li>
                        <li class="nav-mb-item">
                            <a href="" class="collapsed mb-menu-link ">
                                <span>Contact Us</span>
                                <!-- <span class="btn-open-sub"></span> -->
                            </a>
                        </li>
                     
                    </ul>
                </div>
                <div class="mb-other-content">
                    <div class="group-icon">
                        <a class="site-nav-icon" href="">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            Wishlist
                        </a>
                        <a class="site-nav-icon" href="">
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
                        <a class="site-nav-icon" href="">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 7H19C20.1046 7 21 7.89543 21 9V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 11H20V15H16C14.8954 15 14 14.1046 14 13C14 11.8954 14.8954 11 16 11Z" stroke="#181818" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                            Wallet
                        </a>
                    </div>
                    <div class="mb-notice">
                        <a class="text-need" href="">Need Help?</a>
                    </div>
                    <div class="mb-contact">
                        <p class="text-caption-1">Ahemdabad, Gujarat, India</p>
                        <a class="tf-btn-default text-btn-uppercase" href="">
                            GET DIRECTION<i class="icon-arrowUpRight"></i>
                        </a>
                    </div>
                    <ul class="mb-info">
                        <li>
                            <i class="icon icon-mail"></i>
                            <p>only4ever@gmail.com</p>
                        </li>
                        <li>
                            <i class="icon icon-phone"></i>
                            <p>8899889988</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mb-bottom">
                <div class="bottom-bar-language">
                    <!-- Currency Dropdown -->
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
            
                    <!-- Language Dropdown -->
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
                </div>
            
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
                        <div class="text-caption-1">Congratulations! You’ve got free shipping!</div>
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

              <div class="tf-product-info-by-btn mb_10">
                        <button type="submit" name="add_cart_item" value="2" 
                                class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6">
                            Add to cart
                        </button>
                        <button type="submit" name="add_cart_item" value="1" 
                                class="btn-style-3 text-btn-uppercase">
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

     @yield('script')
     <script type="text/javascript">


document.addEventListener("DOMContentLoaded", function () {
    const quickAddBtns = document.querySelectorAll(".quick-add-btn");

    quickAddBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            let title = this.dataset.title;
            let price = this.dataset.price;
            let oldPrice = this.dataset.oldPrice;
            let image = this.dataset.image;
            let url = this.dataset.url;
            let colors = JSON.parse(this.dataset.colors || "[]");
            let sizes = JSON.parse(this.dataset.sizes || "[]");

            // Fill modal fields
            document.getElementById("modal_product_id").value = this.dataset.id;
            document.getElementById("modal_final_price").value = price; 

            document.getElementById("quickAddTitle").textContent = title;
            document.getElementById("quickAddTitle").href = url;
            document.getElementById("quickAddPrice").textContent = price;
            document.getElementById("quickAddOldPrice").textContent = oldPrice > 0 ? oldPrice : "";
            document.getElementById("quickAddImage").src = image;

            // Colors
            let colorHtml = "";
            colors.forEach((color, i) => {
                colorHtml += `
                  <label class="color-btn ${i===0 ? 'active' : ''}" style="background:${color.color_code || color.name}">
                    <input type="radio" name="color" value="${color.id}" ${i===0 ? 'checked' : ''}/>
                  </label>`;
            });
            document.getElementById("quickAddColors").innerHTML = colorHtml;

            // Sizes
            let sizeHtml = "";
            sizes.forEach((size, i) => {
                sizeHtml += `
                  <label class="size-btn ${i===0 ? 'active' : ''}">
                    <input type="radio" name="size" value="${size.id}" data-price="${size.price}" ${i===0 ? 'checked' : ''}/>
                    <span>${size.name}</span>
                  </label>`;
            });
            document.getElementById("quickAddSizes").innerHTML = sizeHtml;
        });
    });

        // Quantity +/-
{{--     document.addEventListener("click", function(e) {
        if (e.target.classList.contains("btn-increase")) {
            let input = e.target.parentElement.querySelector("input");
            input.value = parseInt(input.value) + 1;
        }
        if (e.target.classList.contains("btn-decrease")) {
            let input = e.target.parentElement.querySelector("input");
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    }); 

 --}}


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
        let newPrice = sizeInput.dataset.price || document.querySelector(".quick-add-btn").dataset.price;
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

</body>

</html>