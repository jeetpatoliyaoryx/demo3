@extends('layouts.app')
@section('style')
    <style type="text/css">


    </style>
@endsection
@section('content')


    <!-- banner -->
    <section class="tf-slideshow slider-style2 slider-effect-fade">
        <div class="swiper tf-sw-slideshow" dir="ltr">
            <div class="swiper-wrapper">

                @foreach($getBanner as $value)
                    <div class="swiper-slide">
                        <div class="wrap-slider">

                            @if(!empty($value->type_catalogue_category == 1))

                                <a href="{{ url('catalogue/' . base64_encode($value->catalogue_id)) }}" class="banner-overlay"></a>
                            @elseif(!empty($value->type_catalogue_category == 2))

                                @php
                                    $category_d = App\Models\CategoryModel::where('id', '=', $value->category_id)->first();
                                @endphp

                                <a href="{{ url('m/' . $category_d->slug) }}" class="banner-overlay"></a>
                            @endif

                            <img class="responsive-banner"
     data-desktop-src="{{ $value->get_desktop_banner() }}"
     data-mobile-src="{{ $value->get_mobile_banner() }}"
     alt="{{ $value->title ?? 'banner' }}"
     loading="lazy" width="1920" height="803" />



                            @if(!empty($value->title) && !empty($value->sub_title))
                                <div class="box-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-10">
                                                <div class="content-slider card-box bg-main">
                                                    <div class="box-title-slider">
                                                        <div class="fade-item fade-item-1 heading title-display text-white">
                                                            {!! $value->title !!}
                                                        </div>
                                                        <p class="fade-item fade-item-2 body-text-1 text-white">
                                                            {!! $value->sub_title !!}
                                                        </p>
                                                    </div>
                                                    {{-- @if(!empty($value->button_text) && !empty($value->button_link))
                                                    <div class="fade-item fade-item-3 box-btn-slider">
                                                        <a class="tf-btn btn-fill btn-white" href="{{ $value->button_link }}">
                                                            <span class="text">{{ $value->button_text }}</span>
                                                            <i class="icon icon-arrowUpRight"></i>
                                                        </a>
                                                    </div>
                                                    @endif --}}

                                                    @if(!empty($value->button_text) && !empty($value->type_catalogue_category == 1))

                                                        <div class="fade-item fade-item-3 box-btn-slider">
                                                            <a class="tf-btn btn-fill btn-white"
                                                                href="{{ url('catalogue/' . base64_encode($value->catalogue_id)) }}">
                                                                <span class="text">{{ $value->button_text }}</span>
                                                                <i class="icon icon-arrowUpRight"></i>
                                                            </a>
                                                        </div>
                                                    @elseif(!empty($value->button_text) && !empty($value->type_catalogue_category == 2))
                                                        <div class="fade-item fade-item-3 box-btn-slider">
                                                            @php
                                                                $category_d = App\Models\CategoryModel::where('id', '=', $value->category_id)->first();
                                                            @endphp
                                                            <a class="tf-btn btn-fill btn-white"
                                                                href="{{ url('m/' . $category_d->slug) }}">
                                                                <span class="text">{{ $value->button_text }}</span>
                                                                <i class="icon icon-arrowUpRight"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="wrap-pagination">
            <div class="container">
                <div class="sw-dots sw-pagination-slider type-circle justify-content-center spd33"></div>
            </div>
        </div>
    </section>


    <!-- Categories Section -->
    <section class="flat-spacing-2 pb_0">
        <div class="container">
            <div class="heading-section-2 wow fadeInUp">
                <h3>{{ $getAllTitle->categories_title }} </h3>
            </div>
            <div class="flat-collection-circle wow fadeInUp" data-wow-delay="0.1s">
                <div class="swiper" dir="ltr">
                    <div class="swiper-wrapper">

                        @foreach($getParentCategory as $value)
                            @foreach($value->subcategory as $subcategory)
                                <div class="swiper-slide">
                                    <div class="collection-circle hover-img"><a class="img-style"
                                            href="{{ url('a/' . $value->slug . '/' . $subcategory->slug) }}">
                                            <img data-src="{{ $subcategory->getCategoryImage() }}" alt="collection-img"
                                                loading="lazy" width="363" height="363" decoding="async" data-nimg="1"
                                                class="lazyload" style="color:transparent"
                                                src="{{ $subcategory->getCategoryImage() }}" /></a>
                                        <div class="collection-content text-center">
                                            <div><a class="cls-title" href="">
                                                    <h6 class="text"> {{ $subcategory->name }}</h6><i
                                                        class="icon icon-arrowUpRight"></i>
                                                </a></div>
                                            {{-- <div class="count text-secondary">
                                                {{ $subcategory->subcategory->count() }} Item
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                    </div>
                </div>
                <div class="d-flex d-lg-none sw-pagination-collection sw-dots type-circle justify-content-center spd54">
                </div>
                <div class="nav-prev-collection d-none d-lg-flex nav-sw style-line nav-sw-left snbp12"><i
                        class="icon icon-arrLeft"></i></div>
                <div class="nav-next-collection d-none d-lg-flex nav-sw style-line nav-sw-right snbn12"><i
                        class="icon icon-arrRight"></i></div>
            </div>
        </div>
    </section>

    <!-- NEW ARRIVAL / Today's Top Picks -->
    <section class="flat-spacing-3">
        <div class="container">
            <div class="heading-section text-center">
                <!-- Bootstrap Tabs -->
                <ul class="tab-product nav nav-tabs justify-content-sm-center tab-product-v2" id="topPicksTabs"
                    role="tablist">
                    <li class="nav-item nav-tab-item"><a class="nav-link active" id="bottoms-tab" data-bs-toggle="tab"
                            href="#bottoms">New Arrivals</a></li>
                    <li class="nav-item nav-tab-item"><a class="nav-link" id="onpieces-tab" data-bs-toggle="tab"
                            href="#onpieces">Best Seller</a></li>
                    <li class="nav-item nav-tab-item"><a class="nav-link" id="tops-tab" data-bs-toggle="tab" href="#tops">On
                            Sale</a></li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="topPicksContent">


                <!-- Bottoms Tab -->
                <div class="tab-pane fade show active" id="bottoms">


                    <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4" id="product-list">
                        @foreach($getFrontProductsHomeNewArrival as $product)

                            <div class="card-product wow fadeInUp card-product-size">
                                <div class="card-product-wrapper">

                                    @if(!empty($product->total_product))

                                        <a class="product-img" href="{{ $product->getURL() }}">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @else

                                        <a class="product-img" href="javascript:void(0);">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @endif


                                    <div class="variant-wrap size-list">
                                        <ul class="variant-box">
                                            @foreach($product->getsize as $index => $getsize)
                                                <li class="size-item {{ $index == 0 ? 'active' : '' }}" data-id="{{ $getsize->id }}"
                                                    data-price="{{ $getsize->price }}">
                                                    {{ $getsize->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>



                                    <div class="on-sale-wrap">
                                        @php
                                            if ($product->old_price > 0) {
                                                $discount = (($product->old_price - $product->price) / $product->old_price) * 100;
                                            } else {
                                                $discount = 0;
                                            }
                                        @endphp

                                        @if($discount > 0)
                                            <span class="on-sale-item">-{{ number_format($discount, 0) }}%</span>
                                        @endif
                                    </div>

                                    <div class="list-product-btn">

                                        @if(!empty(Auth::check()))

                                            <a href="javascript:void(0)"
                                                class="box-icon wishlist btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                @if(!empty($product->userwishlist()))

                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>

                                                @else
                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>
                                                @endif

                                            </a>

                                        @else

                                            <a href="{{ url('login') }}"
                                                class="box-icon btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>

                                        @endif


                                    </div>



                                    <div class="list-btn-main">
                                        @if(!empty($product->total_product))

                                            <a class="btn-main-product quick-add-btn" href="#quickAdd" data-bs-toggle="modal"
                                                data-id="{{ $product->id }}" data-title="{{ $product->title }}"
                                                data-price="{{ $product->price }}" data-old-price="{{ $product->old_price }}"
                                                data-image="{{ $product->photo() }}" data-url="{{ $product->getURL() }}"
                                                data-colors='@json($product->getcolor)' data-sizes='@json($product->getsize)'>
                                                Quick Add
                                            </a>
                                        @else
                                            <a class="out-of-stock" href="javascript:void(0);" style="text-center">
                                                Out of Stock
                                            </a>

                                        @endif
                                    </div>



                                </div>
                                <div class="card-product-info">
                                    @if(!empty($product->total_product))
                                        <a class="title link" href="{{ $product->getURL() }}">{{ $product->title }}</a>
                                    @else
                                        <a class="title link" href="javascript:void(0);">{{ $product->title }}</a>
                                    @endif
                                    <span class="price">
                                        <span class="old-price">&#8377;{{ number_format($product->old_price, 2) }}</span>
                                        &#8377;{{ number_format($product->price, 2) }}
                                    </span>


                                    <ul class="list-color-product">
                                        @foreach($product->getcolor as $index => $getcolor)
                                            <li class="list-color-item color-swatch {{ $index == 0 ? 'active' : '' }}">
                                                <span class="swatch-value"
                                                    style="background: {{ !empty($getcolor->color_code) ? $getcolor->color_code : $getcolor->name }}">
                                                </span>
                                                {{-- <img alt="{{ $getcolor->name }} variant" loading="lazy" width="600"
                                                    height="800" decoding="async" class="lazyload" style="color:transparent"
                                                    src="{{ !empty($getcolor->image) ? asset('storage/'.$getcolor->image) : 'images/products/default.jpg' }}" />
                                                --}}
                                            </li>
                                        @endforeach


                                    </ul>



                                </div>
                            </div>


                        @endforeach
                    </div>
                    {!! $getFrontProductsHomeNewArrival->appends(request()->query())->links('vendor.pagination.custom') !!}
                </div>






                <div class="tab-pane fade" id="onpieces">
                    <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4" id="product-list">
                        @foreach($getFrontProductsHomeBestSelling as $product)

                            <div class="card-product wow fadeInUp card-product-size">
                                <div class="card-product-wrapper">

                                    @if(!empty($product->total_product))


                                        <a class="product-img" href="{{ $product->getURL() }}">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @else

                                        <a class="product-img" href="javascript:void(0);">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @endif


                                    <div class="variant-wrap size-list">
                                        <ul class="variant-box">
                                            @foreach($product->getsize as $index => $getsize)
                                                <li class="size-item {{ $index == 0 ? 'active' : '' }}" data-id="{{ $getsize->id }}"
                                                    data-price="{{ $getsize->price }}">
                                                    {{ $getsize->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>



                                    <div class="on-sale-wrap">
                                        @php
                                            if ($product->old_price > 0) {
                                                $discount = (($product->old_price - $product->price) / $product->old_price) * 100;
                                            } else {
                                                $discount = 0;
                                            }
                                        @endphp

                                        @if($discount > 0)
                                            <span class="on-sale-item">-{{ number_format($discount, 0) }}%</span>
                                        @endif
                                    </div>

                                    <div class="list-product-btn">

                                        @if(!empty(Auth::check()))

                                            <a href="javascript:void(0)"
                                                class="box-icon wishlist btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                @if(!empty($product->userwishlist()))

                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>

                                                @else
                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>
                                                @endif

                                            </a>

                                        @else

                                            <a href="{{ url('login') }}"
                                                class="box-icon btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>

                                        @endif


                                    </div>



                                    <div class="list-btn-main">


                                        @if(!empty($product->total_product))

                                            <a class="btn-main-product quick-add-btn" href="#quickAdd" data-bs-toggle="modal"
                                                data-id="{{ $product->id }}" data-title="{{ $product->title }}"
                                                data-price="{{ $product->price }}" data-old-price="{{ $product->old_price }}"
                                                data-image="{{ $product->photo() }}" data-url="{{ $product->getURL() }}"
                                                data-colors='@json($product->getcolor)' data-sizes='@json($product->getsize)'>
                                                Quick Add
                                            </a>
                                        @else
                                            <a class="out-of-stock" href="javascript:void(0);" style="text-center">
                                                Out of Stock
                                            </a>

                                        @endif

                                    </div>



                                </div>
                                <div class="card-product-info">

                                    @if(!empty($product->total_product))
                                        <a class="title link" href="{{ $product->getURL() }}">{{ $product->title }}</a>
                                    @else
                                        <a class="title link" href="javascript:void(0);">{{ $product->title }}</a>
                                    @endif

                                    <span class="price">
                                        <span class="old-price">&#8377;{{ number_format($product->old_price, 2) }}</span>
                                        &#8377;{{ number_format($product->price, 2) }}
                                    </span>


                                    <ul class="list-color-product">
                                        @foreach($product->getcolor as $index => $getcolor)
                                            <li class="list-color-item color-swatch {{ $index == 0 ? 'active' : '' }}">
                                                <span class="swatch-value"
                                                    style="background: {{ !empty($getcolor->color_code) ? $getcolor->color_code : $getcolor->name }}">
                                                </span>
                                                {{-- <img alt="{{ $getcolor->name }} variant" loading="lazy" width="600"
                                                    height="800" decoding="async" class="lazyload" style="color:transparent"
                                                    src="{{ !empty($getcolor->image) ? asset('storage/'.$getcolor->image) : 'images/products/default.jpg' }}" />
                                                --}}
                                            </li>
                                        @endforeach


                                    </ul>



                                </div>
                            </div>


                        @endforeach
                    </div>
                    {!! $getFrontProductsHomeBestSelling->appends(request()->query())->links('vendor.pagination.custom') !!}
                </div>






                <div class="tab-pane fade" id="tops">
                    <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4" id="product-list">
                        @foreach($getFrontProductsHomeFeatured as $product)

                            <div class="card-product wow fadeInUp card-product-size">
                                <div class="card-product-wrapper">

                                    @if(!empty($product->total_product))

                                        <a class="product-img" href="{{ $product->getURL() }}">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @else

                                        <a class="product-img" href="javascript:void(0);">
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-product" style="color:transparent"
                                                src="{{ $product->photo() }}" />
                                            <img alt="Polarized sunglasses" loading="lazy" width="600" height="800" decoding="async"
                                                data-nimg="1" class="lazyload img-hover" style="color:transparent"
                                                src="{{ $product->photobig() }}" />
                                        </a>

                                    @endif



                                    <div class="variant-wrap size-list">
                                        <ul class="variant-box">
                                            @foreach($product->getsize as $index => $getsize)
                                                <li class="size-item {{ $index == 0 ? 'active' : '' }}" data-id="{{ $getsize->id }}"
                                                    data-price="{{ $getsize->price }}">
                                                    {{ $getsize->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>



                                    <div class="on-sale-wrap">
                                        @php
                                            if ($product->old_price > 0) {
                                                $discount = (($product->old_price - $product->price) / $product->old_price) * 100;
                                            } else {
                                                $discount = 0;
                                            }
                                        @endphp

                                        @if($discount > 0)
                                            <span class="on-sale-item">-{{ number_format($discount, 0) }}%</span>
                                        @endif
                                    </div>

                                    <div class="list-product-btn">

                                        @if(!empty(Auth::check()))

                                            <a href="javascript:void(0)"
                                                class="box-icon wishlist btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                @if(!empty($product->userwishlist()))

                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>

                                                @else
                                                    <span class="icon icon-heart add-remove-wishlist{{ $product->id }}"></span>
                                                    <span class="tooltip">Wishlist</span>
                                                @endif

                                            </a>

                                        @else

                                            <a href="{{ url('login') }}"
                                                class="box-icon btn-icon-action item-option btn-add-remove-wishlist"
                                                id="{{ $product->id }}">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>

                                        @endif


                                    </div>



                                    <div class="list-btn-main">


                                        @if(!empty($product->total_product))
                                            <a class="btn-main-product quick-add-btn" href="#quickAdd" data-bs-toggle="modal"
                                                data-id="{{ $product->id }}" data-title="{{ $product->title }}"
                                                data-price="{{ $product->price }}" data-old-price="{{ $product->old_price }}"
                                                data-image="{{ $product->photo() }}" data-url="{{ $product->getURL() }}"
                                                data-colors='@json($product->getcolor)' data-sizes='@json($product->getsize)'>
                                                Quick Add
                                            </a>

                                        @else
                                            <a class="out-of-stock" href="javascript:void(0);" style="text-center">
                                                Out of Stock
                                            </a>

                                        @endif
                                    </div>



                                </div>
                                <div class="card-product-info">
                                    @if(!empty($product->total_product))
                                        <a class="title link" href="{{ $product->getURL() }}">{{ $product->title }}</a>
                                    @else
                                        <a class="title link" href="javascript:void(0);">{{ $product->title }}</a>
                                    @endif

                                    <span class="price">
                                        <span class="old-price">&#8377;{{ number_format($product->old_price, 2) }}</span>
                                        &#8377;{{ number_format($product->price, 2) }}
                                    </span>


                                    <ul class="list-color-product">
                                        @foreach($product->getcolor as $index => $getcolor)
                                            <li class="list-color-item color-swatch {{ $index == 0 ? 'active' : '' }}">
                                                <span class="swatch-value"
                                                    style="background: {{ !empty($getcolor->color_code) ? $getcolor->color_code : $getcolor->name }}">
                                                </span>
                                                {{-- <img alt="{{ $getcolor->name }} variant" loading="lazy" width="600"
                                                    height="800" decoding="async" class="lazyload" style="color:transparent"
                                                    src="{{ !empty($getcolor->image) ? asset('storage/'.$getcolor->image) : 'images/products/default.jpg' }}" />
                                                --}}
                                            </li>
                                        @endforeach


                                    </ul>



                                </div>
                            </div>


                        @endforeach
                    </div>
                    {!! $getFrontProductsHomeFeatured->appends(request()->query())->links('vendor.pagination.custom') !!}
                </div>



                <!-- Repeat same for other tabs -->

            </div>
        </div>
    </section>
    <!-- Limited time Deals -->
    <section class="bg-surface flat-spacing-8 flat-countdown-banner-2"
        style="background-image:url({{ url($getSurface->getImage())}})">
        <div class="container">
            <div class="box-content">
                <div class="box-title">
                    <h3>{{ $getSurface->title }}</h3>
                    <p class="text-secondary">{{ $getSurface->sub_title }}</p>
                </div>
                <div class="tf-countdown-lg">
                    <div class="js-countdown" data-timer="1007500" data-labels="Days,Hours,Mins,Secs"></div>
                </div>
                @if(!empty($getSurface->button_text) && !empty($getSurface->type_catalogue_category == 1))
                    <div class="btn-banner"><a class="tf-btn btn-fill"
                            href="{{ url('catalogue/' . base64_encode($getSurface->catalogue_id)) }}"><span
                                class="text">{{ $getSurface->button_text }}</span><i class="icon icon-arrowUpRight"></i></a>
                    </div>
                @elseif(!empty($getSurface->button_text) && !empty($getSurface->type_catalogue_category == 2))
                    <div class="btn-banner">
                        @php
                            $category_d = App\Models\CategoryModel::where('id', '=', $getSurface->category_id)->first();
                        @endphp
                        <a class="tf-btn btn-fill" href="{{ url('m/' . $category_d->slug) }}"><span
                                class="text">{{ $getSurface->button_text }}</span><i class="icon icon-arrowUpRight"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- <section class="tf-marquee marquee-white bg-purple-2">
                                        <div class="marquee-wrapper">
                                            <div class="initial-child-container">
                                                @foreach($getMarquee as $value)
                                                <div class="marquee-child-item">
                                                    <p class="text-btn-uppercase">{{ $value->title }}</p>
                                                </div>
                                                <div class="marquee-child-item"><span class="icon icon-lightning-line"></span></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section> -->


    <section class="tf-marquee marquee-white bg-purple-2">
        <div class="marquee" id="marquee">
            <div class="marquee-inner" id="marqueeInner">
                @foreach($getMarquee as $value)
                    <div class="marquee-item">
                        <p class="text-btn-uppercase">{{ $value->title }}</p>
                    </div>
                    <div class="marquee-item"><span class="icon icon-lightning-line"></span></div>
                @endforeach
            </div>
        </div>
    </section>








    <!-- Capsule collection -->
    <section class="flat-spacing capsule-mobile">
        <div class="container">
            <div class="row flat-img-with-text-v3">
                <div class="col-lg-6 col-md-5">
                    <div class="banner-left">
                        <div class="collection-position style-lg hover-img">
                            <a class="img-style">
                                <img data-src="{{ url($getSpacing->getImage()) }}" alt="banner" loading="lazy" width="473"
                                    height="630" decoding="async" data-nimg="1" class="lazyload" style="color:transparent"
                                    src="{{ url($getSpacing->getImage()) }}" />
                            </a>
                            <div class="content">
                                <h3 class="title wow fadeInUp">
                                    @if(!empty($getSpacing->title) && !empty($getSpacing->type_catalogue_category_1 == 1))

                                        <a class="link text-white"
                                            href="{{ url('catalogue/' . base64_encode($getSpacing->catalogue_id_1)) }}">{{ $getSpacing->title }}
                                        </a>
                                    @elseif(!empty($getSpacing->title) && !empty($getSpacing->type_catalogue_category_1 == 2))
                                        @php
                                            $category_d_1 = App\Models\CategoryModel::where('id', '=', $getSpacing->category_id_1)->first();
                                        @endphp
                                        <a class="link text-white"
                                            href="{{ url('m/' . $category_d_1->slug) }}">{{ $getSpacing->title }}
                                        </a>

                                    @endif
                                </h3>
                                <p class="desc text-white wow fadeInUp">{{ $getSpacing->sub_title }}</p>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-7">
                    <div class="banner-right">
                        <div class="box-title">
                            <div class="sub-title text-btn-uppercase wow fadeInUp">{{ $getSpacing->title_1 }}</div>
                            <h3 class="title wow fadeInUp">{{ $getSpacing->sub_title_1 }}</h3>
                            <p class="desc text-secondary wow fadeInUp">{{ $getSpacing->description }}</p>
                        </div>
                        <div class="swiper tf-sw-collection" dir="ltr">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="collection-default hover-img wow fadeInUp" data-wow-delay="0s"><a
                                            class="img-style"><img data-src="{{ $getSpacing->getImage1() }}"
                                                alt="banner-cls" loading="lazy" width="450" height="450" decoding="async"
                                                data-nimg="1" class="lazyload" style="color:transparent"
                                                src="{{ $getSpacing->getImage1() }}" /></a>
                                        <div class="content text-center">
                                            <h6 class="title">
                                                @if(!empty($getSpacing->image_title) && !empty($getSpacing->type_catalogue_category_2 == 1))
                                                    <a class="link"
                                                        href="{{ url('catalogue/' . base64_encode($getSpacing->catalogue_id_2)) }}">{{ $getSpacing->image_title }}</a>
                                                @elseif(!empty($getSpacing->image_title) && !empty($getSpacing->type_catalogue_category_2 == 2))
                                                    @php
                                                        $category_d_2 = App\Models\CategoryModel::where('id', '=', $getSpacing->category_id_2)->first();
                                                    @endphp

                                                    <a class="link"
                                                        href="{{ url('m/' . $category_d_2->slug) }}">{{ $getSpacing->image_title }}</a>
                                                @endif


                                            </h6>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="collection-default hover-img wow fadeInUp" data-wow-delay="0.1s"><a
                                            class="img-style"><img data-src="{{ $getSpacing->getImage2() }}"
                                                alt="banner-cls" loading="lazy" width="450" height="450" decoding="async"
                                                data-nimg="1" class="lazyload" style="color:transparent"
                                                src="{{ $getSpacing->getImage2() }}" /></a>
                                        <div class="content text-center">
                                            <h6 class="title">

                                                @if(!empty($getSpacing->image_title_2) && !empty($getSpacing->type_catalogue_category_3 == 1))
                                                    <a class="link"
                                                        href="{{ url('catalogue/' . base64_encode($getSpacing->catalogue_id_3)) }}">{{ $getSpacing->image_title_2 }}</a>
                                                @elseif(!empty($getSpacing->image_title_2) && !empty($getSpacing->type_catalogue_category_3 == 2))
                                                    @php
                                                        $category_d_3 = App\Models\CategoryModel::where('id', '=', $getSpacing->category_id_3)->first();
                                                    @endphp

                                                    <a class="link"
                                                        href="{{ url('m/' . $category_d_3->slug) }}">{{ $getSpacing->image_title_2 }}</a>
                                                @endif

                                            </h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sw-pagination-collection sw-dots type-circle justify-content-center spd43">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 14-Day Returns slider -->
    <section class="flat-spacing review-mobile">
        <div class="container">
            <div class="swiper tf-sw-iconbox" dir="ltr">
                <div class="swiper-wrapper">

                    @foreach($getWhyShop as $value)
                        <div class="swiper-slide">
                            <div class="tf-icon-box">
                                <div class="icon-box">
                                    {{-- <span class="icon icon-return"></span> --}}
                                    <img alt="img-testimonial" height="50px" width="50px" loading="lazy" width="468"
                                        height="624" decoding="async" data-nimg="1" style="color:transparent"
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
                <div class="sw-pagination-iconbox spd2 sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>

    <!-- review slider -->
    <section class="flat-spacing pt-0">
        <div class="container">
            <div class="heading-section text-center">
                <h3 class="heading wow fadeInUp">{{ $getAllTitle->customer_1 }}</h3>
                <p class="subheading wow fadeInUp">{{ $getAllTitle->customer_2 }}</p>
            </div>
            <div class="swiper tf-sw-testimonial">
                <div class="swiper" dir="ltr">
                    <div class="swiper-wrapper">


                        @foreach($getCustomerSay as $value)
                            <div class="swiper-slide">
                                <div class="testimonial-item hover-img">
                                    <div class="img-style">
                                        <img alt="img-testimonial" loading="lazy" width="468" height="624" decoding="async"
                                            data-nimg="1" style="color:transparent" src="{{ $value->getImage() }}" />
                                    </div>
                                    <div class="content">
                                        <div class="content-top">
                                            {{-- {{ $value->rating }} --}}
                                            <div class="list-star-default">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $value->rating)
                                                        <i class="icon icon-star" style="color: gold;"></i> {{-- filled star --}}
                                                    @else
                                                        <i class="icon icon-star" style="color: #ccc;"></i> {{-- empty star --}}
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-secondary">{{ $value->description }}</p>
                                            <div class="box-author">
                                                <div class="text-title author">{{ $value->name }}</div>
                                                <svg class="icon" width="20" height="21" viewBox="0 0 20 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0)">
                                                        <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path
                                                            d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z"
                                                            stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0">
                                                            <rect width="20" height="20" fill="white"
                                                                transform="translate(0 0.684082)"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="box-avt">
                                            <div class="avatar avt-60 round">
                                                <img alt="avt" loading="lazy" width="90" height="91" decoding="async"
                                                    data-nimg="1" style="color:transparent" src="{{ $value->getImage() }}" />
                                            </div>
                                            <div class="box-price">
                                                <p class="text-title text-line-clamp-1">{{ $value->title }}
                                                </p>
                                                <div class="text-button price">
                                                    <!-- -->
                                                    ₹{{ number_format($value->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center spd7">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- shop Instagram -->
    <section>
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">{{ $getAllTitle->instagram_1 }}</h3>
            <p class="subheading text-secondary">{{ $getAllTitle->instagram_2 }}</p>
        </div>
        <div class="swiper tf-sw-shop-gallery" dir="ltr">
            <div class="swiper-wrapper">
                @foreach($getInstagram as $value)
                    <div class="swiper-slide">
                        <div class="gallery-item rounded-0 hover-overlay hover-img wow fadeInUp" data-wow-delay=".1s">
                            <div class="img-style">
                                <img alt="image-gallery" loading="lazy" width="640" height="640" decoding="async" data-nimg="1"
                                    class="lazyload img-hover" style="color:transparent"
                                    src="{{ $value->getInstagramImage() }}" />
                            </div>
                            <a class="box-icon hover-tooltip" href="{{ $value->instagram_link }}" target="_blank">
                                <span class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>





    {{-- Email --}}

    <div class="modal modalCentered fade auto-popup modal-newleter" id="newsletterPopup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-top NewsLetterSignupModelClose">
                    <img data-src="{{ $getSubscribe->getImage() }}" alt="images" loading="lazy" width="660" height="440"
                        decoding="async" data-nimg="1" class="lazyload" style="color:transparent"
                        src="{{ $getSubscribe->getImage() }}" />
                    <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="modal-bottom text-center">
                    @if(!empty($getSubscribe->title))
                        <p class="text-btn-uppercase fw-4 font-2">{{ $getSubscribe->title }}</p>
                    @endif
                    @if(!empty($getSubscribe->sub_title))
                        <h5>{{ $getSubscribe->sub_title }}</h5>
                    @endif
                    <div class="tfSubscribeMsg  footer-sub-element ">
                        <p style="color:rgb(52, 168, 83)">You have successfully subscribed.</p>
                    </div>
                    <form action="{{ url("subscribe_email") }}" method="post" class="form-newsletter-subscribe">
                        <div id="subscribe-content">
                            <input type="hidden" class="form-control" value="1" name="is_popup">

                            {{ csrf_field() }}
                            <input type="email" name="email" id="subscribe-email" placeholder="Enter your e-mail"
                                required="" name="email" />
                            @if(!empty($getSubscribe->button_text))
                                <button type="submit" class="btn-style-2 radius-12 w-100 justify-content-center">
                                    <span class="text text-btn-uppercase">{{ $getSubscribe->button_text }}</span>
                                </button>
                            @endif
                        </div>
                        <div id="subscribe-msg"></div>
                    </form>
                    <ul class="tf-social-icon style-default justify-content-center">

                        @if(!empty($SEgetHomeFooter->facebook_link))
                            <li>
                                <a href="{{ $SEgetHomeFooter->facebook_link }}" class="social-facebook">
                                    <i class="icon icon-fb"></i>
                                </a>
                            </li>
                        @endif
                        @if(!empty($SEgetHomeFooter->instagram_link))
                            <li>
                                <a href="{{ $SEgetHomeFooter->instagram_link }}" class="social-instagram">
                                    <i class="icon icon-instagram"></i>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const marquee = document.getElementById('marquee');
            const inner = document.getElementById('marqueeInner');

            if (!marquee || !inner) return;

            // guard: only setup once per page load
            if (inner.dataset.marqueeSetup === 'true') return;
            inner.dataset.marqueeSetup = 'true';

            // Save the original HTML group (one set of items)
            const originalHTML = inner.innerHTML.trim();
            if (!originalHTML) return;

            // Ensure enough content to scroll seamlessly:
            // We want the inner total width to be at least 2x of visible area (more is fine).
            // We'll append copies of the original group until inner.scrollWidth >= viewport*2
            // Then we set the animation distance to half of inner.scrollWidth (so first half scrolls out and second half continues seamlessly)
            const containerWidth = marquee.clientWidth || document.documentElement.clientWidth;
            const minNeededWidth = containerWidth * 2; // tuneable: 2x is generally good
            let safetyCounter = 0;

            // If your site uses Livewire/AJAX which re-renders the section, this prevents infinite loops:
            while (inner.scrollWidth < minNeededWidth && safetyCounter < 50) {
                inner.insertAdjacentHTML('beforeend', originalHTML);
                safetyCounter++;
                // Force reflow to update scrollWidth in some browsers
                // eslint-disable-next-line no-unused-expressions
                inner.offsetWidth;
            }

            // After we have at least 2 copies, ensure we have one more copy (makes seamless half-swap)
            // If the inner already contains at least two copies, this still appends one extra group so we have full half available to translate.
            inner.insertAdjacentHTML('beforeend', originalHTML);

            // final reflow measurement
            const totalWidth = inner.scrollWidth;
            const distance = totalWidth / 2; // translate by half of inner width (one "set" length repeated)
            // compute duration proportional to distance so speed looks consistent
            const pxPerSecond = 100; // tune this value: smaller => slower
            const duration = Math.max(10, Math.round(distance / pxPerSecond)); // minimum 10s for readability

            // set CSS variables
            inner.style.setProperty('--marquee-distance', distance + 'px');
            inner.style.setProperty('--marquee-duration', duration + 's');

            // optional: ensure the inner is display inline-flex (if CSS didn't load early)
            inner.style.display = 'inline-flex';
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Check if popup is already closed or subscribed using cookies
            if (!getCookie("newsletter_closed")) {
                setTimeout(() => {
                    const popupEl = document.getElementById("newsletterPopup");
                    if (popupEl) {
                        const popup = new bootstrap.Modal(popupEl, { backdrop: 'static', keyboard: false });
                        popup.show();
                    }
                }, 5000);
            }

            // Handle form submit (AJAX)
            $('.form-newsletter-subscribe').on('submit', function (e) {
                e.preventDefault();
                const email = $('#subscribe-email').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('subscribe_email') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        email: email,
                        is_popup: 1
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Subscribed!',
                                text: response.message,
                                confirmButtonColor: '#34A853'
                            });
                            $('#newsletterPopup').modal('hide');
                            setCookie("newsletter_closed", "1", 30); // hide popup for 30 days
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: response.message,
                                confirmButtonColor: '#F4B400'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong, please try again later.'
                        });
                    }
                });
            });

            // When user closes popup manually
            $('body').on('click', '.NewsLetterSignupModelClose', function () {
                $.ajax({
                    type: "POST",
                    url: "{{ url('user/close_subscribe_email') }}",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#newsletterPopup').modal('hide');
                        setCookie("newsletter_closed", "1", 7); // hide popup for 7 days
                    }
                });
            });
        });

        // ---------- Helper functions ----------
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            document.cookie = cname + "=" + cvalue + ";expires=" + d.toUTCString() + ";path=/";
        }

        function getCookie(cname) {
            const name = cname + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }



        {
            {
                --document.addEventListener("DOMContentLoaded", () => {
                    setTimeout(() => {
                        const popupEl = document.getElementById("newsletterPopup");
                        if (popupEl) {
                            const popup = new bootstrap.Modal(popupEl);
                            popup.show();
                        } else {
                            console.log("Modal not found!");
                        }
                    }, 5000);
                }); --}
        }

    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const wishlistBtns = document.querySelectorAll(".btn-add-remove-wishlist");

            wishlistBtns.forEach(btn => {
                btn.addEventListener("click", function () {
                    this.classList.toggle("active");
                });
            });
        });
    </script>







    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const banners = document.querySelectorAll(".responsive-banner");

            function setBannerImages() {
                banners.forEach(img => {
                    const desktop = img.getAttribute("data-desktop-src");
                    const mobile = img.getAttribute("data-mobile-src");

                    if (window.innerWidth <= 576) {
                        img.src = mobile;
                    } else {
                        img.src = desktop;
                    }
                });
            }

            // Initial load
            setBannerImages();

            // Update on resize
            window.addEventListener("resize", setBannerImages);
        });
    </script>



@endsection