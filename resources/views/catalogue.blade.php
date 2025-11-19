@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

   <div class="page-title" style="background-image:url({{ $getRecord->getCatalogueImage()}})">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading text-center">{{ $getRecord->catalogue_name }}</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <!--<li><a class="link" href="{{ url('/') }}">Home Page</a></li>-->
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

 <!-- NEW ARRIVAL / Today's Top Picks -->
        <section class="flat-spacing-3">
            <div class="container">
           
                <!-- Tab Content -->
                <div class="tab-content mt-4" id="topPicksContent">


                    <!-- Bottoms Tab -->
                    <div class="tab-pane fade show active" id="bottoms">

                     
                        <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4" id="product-list">
                             @foreach($getFrontCatalogue as $product)

                            <div class="card-product wow fadeInUp card-product-size">
                                <div class="card-product-wrapper">
                                
                                @if(!empty($product->total_product))
                                <a class="product-img" href="{{ $product->getURL() }}">
                                    <img alt="Polarized sunglasses" loading="lazy" width="600" height="800"
                                        decoding="async" data-nimg="1" class="lazyload img-product"
                                        style="color:transparent" src="{{ $product->photo() }}" />
                                     <img alt="Polarized sunglasses" loading="lazy" width="600" height="800"
                                        decoding="async" data-nimg="1" class="lazyload img-hover"
                                        style="color:transparent" src="{{ $product->photobig() }}" /> 
                                </a>
                                @else
                                <a class="product-img" href="javascript:void(0);">
                                    <img alt="Polarized sunglasses" loading="lazy" width="600" height="800"
                                        decoding="async" data-nimg="1" class="lazyload img-product"
                                        style="color:transparent" src="{{ $product->photo() }}" />
                                     <img alt="Polarized sunglasses" loading="lazy" width="600" height="800"
                                        decoding="async" data-nimg="1" class="lazyload img-hover"
                                        style="color:transparent" src="{{ $product->photobig() }}" /> 
                                </a>

                                @endif

                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                    @foreach($product->getsize as $index => $getsize)
                                        <li 
                                            class="size-item {{ $index == 0 ? 'active' : '' }}" 
                                            data-id="{{ $getsize->id }}" 
                                            data-price="{{ $getsize->price }}"
                                        >
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

            <a href="{{ url('login') }}" class="box-icon btn-icon-action item-option btn-add-remove-wishlist"  id="{{ $product->id }}">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Wishlist</span>
            </a>

            @endif

            
        </div>



        <div class="list-btn-main">
            @if(!empty($product->total_product))
         <a class="btn-main-product quick-add-btn" 
               href="#quickAdd" 
               data-bs-toggle="modal"
               data-id="{{ $product->id }}"
               data-title="{{ $product->title }}"
               data-price="{{ $product->price }}"
               data-old-price="{{ $product->old_price }}"
               data-image="{{ $product->photo() }}"
               data-url="{{ $product->getURL() }}"
               data-colors='@json($product->getcolor)'
               data-sizes='@json($product->getsize)'>
               Quick Add
            </a>
            @else
              <a class="out-of-stock" 
               href="javascript:void(0);" style="text-center">
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
            <span class="old-price">&#8377;{{ number_format($product->old_price,2) }}</span>
            &#8377;{{ number_format($product->price,2) }}
        </span>

         
          <ul class="list-color-product">
              @foreach($product->getcolor as $index => $getcolor)
                <li class="list-color-item color-swatch {{ $index == 0 ? 'active' : '' }}">
                    <span class="swatch-value" 
                          style="background: {{ !empty($getcolor->color_code) ? $getcolor->color_code : $getcolor->name }}">
                    </span>
                
                </li>
            @endforeach

              
            </ul>

         

    </div>
</div>


@endforeach  
                        </div>
                     
                    </div>





            


                    <!-- Repeat same for other tabs -->

                </div>
            </div>
        </section>



        @endsection

@section('script')


<script type="text/javascript">


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


@endsection