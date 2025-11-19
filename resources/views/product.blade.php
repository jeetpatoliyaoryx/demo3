@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')



        <div class="page-title" style="background-image:url({{ $getCategory->getCategoryBannerImage() }})">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">{{ $getCategory->name }}</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <!--<li><a class="link" href="{{ url('/') }}">Home page</a></li>-->
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="flat-spacing product-mobile">
            <div class="container">
                <div class="tf-shop-control">
                    <div class="tf-control-filter">
                        <button class="filterShop tf-btn-filter hidden-mx-1200">
                            <span class="icon icon-filter"></span>
                            <span class="text">Filters</span>
                        </button>
                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop"
                            class="tf-btn-filter show-mx-1200">
                            <span class="icon icon-filter"></span>
                            <span class="text">Filters</span></a>
                        <div class="d-none d-lg-flex shop-sale-text ">
                            <i class="icon icon-checkCircle"></i>
                            <p class="text-caption-1">Shop sale items only</p>
                        </div>
                    </div>
                    <ul class="tf-control-layout">
                        <li class="tf-view-layout-switch sw-layout-list list-layout " data-value-layout="list">
                            <div class="item"><svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"></circle>
                                    <rect x="7.5" y="3.5" width="12" height="5" rx="2.5" stroke="#181818"></rect>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"></circle>
                                    <rect x="7.5" y="11.5" width="12" height="5" rx="2.5" stroke="#181818"></rect>
                                </svg></div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-2 " data-value-layout="tf-col-2">
                            <div class="item"><svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="6" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="14" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="6" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="14" cy="14" r="2.5" stroke="#181818"></circle>
                                </svg></div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-3 " data-value-layout="tf-col-3">
                            <div class="item"><svg class="icon" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818"></circle>
                                </svg></div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-4 active" data-value-layout="tf-col-4">
                            <div class="item"><svg class="icon" width="30" height="20" viewBox="0 0 30 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="27" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="27" cy="14" r="2.5" stroke="#181818"></circle>
                                </svg></div>
                        </li>
                    </ul>

                    
                    <div class="tf-control-sorting">
                        <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                    
                       <select class="custom-select" onchange="window.location.replace(this.value);">
                           <option {{ (Request::get('sort') == 'most_recent') ? 'selected' : '' }} value="?sort=most_recent">Most Recent</option>
                           <option {{ (Request::get('sort') == 'lowest_price') ? 'selected' : '' }} value="?sort=lowest_price">Lowest Price</option>
                           <option {{ (Request::get('sort') == 'highest_price') ? 'selected' : '' }} value="?sort=highest_price">Highest Price</option>
                        </select>
                    </div>


                </div>

              

                <div class="wrapper-control-shop">
                   <!-- <div class="meta-filter-shop">
         
                    </div> -->

                    <div class="row">
                        <div class="col-xl-3">
                            
                          <div class="sidebar-filter canvas-filter left">
                                <div class="canvas-wrapper">
                                    <div class="canvas-header d-flex d-xl-none">
                                        <h5>Filters</h5><span class="icon-close close-filter"></span>
                                    </div>
                                    <div class="canvas-body">
                                        <form method="GET" action="{{ url()->current() }}" id="filterForm">
                                        <div class="widget-facet facet-categories facet-fieldset">
                                            <h6 class="facet-title">Product Type</h6>
                                            <div class="box-fieldset-item">
                                    

                                            @foreach($getCategoryFilter as $cat_filter)
                                                <fieldset class="fieldset-item">
                                                    <input type="checkbox" 
                                                           class="tf-check" 
                                                           name="category[]" 
                                                           value="{{ $cat_filter['slug'] }}" 
                                                           data-label="{{ $cat_filter['name'] }}" 
                                                           data-group="category"
                                                           {{ in_array($cat_filter['slug'], (array) request()->input('category', [])) ? 'checked' : '' }} 
                                                           onchange="document.getElementById('filterForm').submit();" />
                                                    <label>
                                                        {{ $cat_filter['name'] }}
                                                        <span class="count-brand ms-0">
                                                             {{-- ({{ $productCounts[$cat_filter['id']] ?? 0 }}) --}}
                                                        </span>
                                                    </label>
                                                </fieldset>
                                            @endforeach
                                      

                                             
                                 



                                            </div>
                                        </div>
                                             </form>


                                        <div class="widget-facet facet-price pt-3">
                                            <h6 class="facet-title">Price</h6>

                                      
                                           <form id="filter-form" method="GET" action="{{ url()->current() }}">
                                                <div class="price-filter">
                                                    <label>Min Price: ₹<span id="price-min-value">{{ request()->input('price_min', 10) }}</span></label>
                                                    <input type="range" name="price_min" id="price-min" min="10" max="10000" value="{{ request()->input('price_min', 10) }}">

                                                    <label>Max Price: ₹<span id="price-max-value">{{ request()->input('price_max', 10000) }}</span></label>
                                                    <input type="range" name="price_max" id="price-max" min="10" max="10000" value="{{ request()->input('price_max', 10000) }}">
                                                </div>
                                            </form>

                                        </div>
                                        
           

                                    @php
                                        $getSize = App\Models\SizeModel::getRecord();
                                        $selectedSize = request()->input('size');
                                    @endphp
                                    @if($getSize && count($getSize) > 0)
                                    <form method="GET" action="{{ url()->current() }}" id="filterFormSize">
                                        <div class="widget-facet facet-color">
                                            <h6 class="facet-title">Size</h6>
                                            <div class="facet-color-box">
                                                @foreach($getSize as $value)
                                                    <div class="color-item color-check">
                                                        <input type="radio"
                                                               name="size"
                                                               value="{{ $value->name }}"
                                                               {{ $selectedSize == $value->name ? 'checked' : '' }}
                                                               onchange="document.getElementById('filterFormSize').submit();" />
                                                        {{ $value->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                             
                                    @php
                                        $getColor = App\Models\ColorModel::getColor();
                                        $selectedColor = request()->input('color');
                                    @endphp

                                    @if($getColor && count($getColor) > 0)
                                    <form method="GET" action="{{ url()->current() }}" id="filterFormColor">
                                        <div class="widget-facet facet-color">
                                            <h6 class="facet-title pt-4">Colors</h6>
                                            <div class="facet-color-box">
                                                @foreach($getColor as $value)
                                                    <div class="color-item color-check">
                                                        <input type="radio"
                                                               name="color"
                                                               value="{{ $value->name }}"
                                                               {{ $selectedColor == $value->name ? 'checked' : '' }}
                                                               onchange="document.getElementById('filterFormColor').submit();" />
                                                        <!-- <span class="color"
                                                              style="background: {{ $value->color_code ?? '#ccc' }}"></span> -->
                                                        {{ $value->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </form>
                                    @endif

                                    </form>
                               
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                        


                        <div class="col-xl-9">
                            <div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">
                                
                           


                        @foreach($getFrontProduct as $product)
                       
                           @include('parts._product')
                       
                        @endforeach 

            
                         {!! $getFrontProduct->appends(request()->query())->links('vendor.pagination.product') !!}

                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

{{-- Mobile --}}
        <div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
            <div class="canvas-wrapper">
                <div class="canvas-header">
                    <h5>Filters</h5><span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas"
                        aria-label="Close"></span>
                </div>
             


             <div class="canvas-body">
                  <form method="GET" action="{{ url()->current() }}" id="mobileFilterForm">
                    <div class="widget-facet facet-categories facet-fieldset">
                        <h6 class="facet-title">Product Type</h6>
                        <div class="box-fieldset-item">
                           @foreach($getCategoryFilter as $cat_filter)
                            <fieldset class="fieldset-item">
                                 <input type="checkbox" 
                                                           class="tf-check" 
                                                           name="category[]" 
                                                           value="{{ $cat_filter['slug'] }}" 
                                                           data-label="{{ $cat_filter['name'] }}" 
                                                           data-group="category"
                                                           {{ in_array($cat_filter['slug'], (array) request()->input('category', [])) ? 'checked' : '' }} 
                                                           onchange="document.getElementById('mobileFilterForm').submit();" />
                                <label> {{ $cat_filter['name'] }} <span class="count-brand ms-0"></span></label>
                            </fieldset>
                                @endforeach
                       
                        </div>
                    </div>
                     </form>
                   
               

      <div class="widget-facet facet-price pt-3">
    <h6 class="facet-title">Price</h6>

    <form id="mobile-filter-form" method="GET" action="{{ url()->current() }}">
        <div class="price-filter">
            <label>Min Price: ₹<span id="mobile-price-min-value">{{ request()->input('price_min', 10) }}</span></label>
            <input type="range" name="price_min" id="mobile-price-min" min="10" max="10000" value="{{ request()->input('price_min', 10) }}">

            <label>Max Price: ₹<span id="mobile-price-max-value">{{ request()->input('price_max', 10000) }}</span></label>
            <input type="range" name="price_max" id="mobile-price-max" min="10" max="10000" value="{{ request()->input('price_max', 10000) }}">
        </div>
    </form>
</div>

                                        


                                           @php
                                        $getSize = App\Models\SizeModel::getRecord();
                                        $selectedSize = request()->input('size');
                                    @endphp
                                      @if($getSize && count($getSize) > 0)
                                    <form method="GET" action="{{ url()->current() }}" id="filterFormSizeMoblie">
                                        <div class="widget-facet facet-color">
                                            <h6 class="facet-title">Size</h6>
                                            <div class="facet-color-box">
                                                @foreach($getSize as $value)
                                                    <div class="color-item color-check">
                                                        <input type="radio"
                                                               name="size"
                                                               value="{{ $value->name }}"
                                                               {{ $selectedSize == $value->name ? 'checked' : '' }}
                                                               onchange="document.getElementById('filterFormSizeMoblie').submit();" />
                                                        {{ $value->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                    
                                    @php
                                        $getColor = App\Models\ColorModel::getColor();
                                        $selectedColor = request()->input('color');
                                    @endphp
                                     @if($getColor && count($getColor) > 0)
                       <form method="GET" action="{{ url()->current() }}" id="filterFormColorMobile">              
                    <div class="widget-facet facet-color">
                        <h6 class="facet-title pt-4">Colors</h6>
                        <div class="facet-color-box">
                             @foreach($getColor as $value)
                                                    <div class="color-item color-check">
                                                        <input type="radio"
                                                               name="color"
                                                               value="{{ $value->name }}"
                                                               {{ $selectedColor == $value->name ? 'checked' : '' }}
                                                               onchange="document.getElementById('filterFormColorMobile').submit();" />
                                                        <!-- <span class="color"
                                                              style="background: {{ $value->color_code ?? '#ccc' }}"></span> -->
                                                        {{ $value->name }}
                                                    </div>
                                                @endforeach
                        </div>
                                    </div>
                  </form>
                  @endif
   </form>

                </div>

               {{--  <div class="canvas-bottom"><button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                </div> --}}
            </div>
        </div>

@endsection
@section('script')
<script type="text/javascript">



const appliedFiltersDiv = document.getElementById("applied-filters");

function addFilter(label, group, value, inputEl, color = null) {
    if (inputEl.type === "radio") {
        document.querySelectorAll(`[data-group="${group}"]`).forEach(tag => tag.remove());
    }

    if (document.querySelector(`[data-group="${group}"][data-value="${value}"]`)) return;

    const tag = document.createElement("div");
    tag.classList.add("filter-tag");
    tag.dataset.group = group;
    tag.dataset.value = value;

    if (color && color !== "transparent" && color !== "rgba(0,0,0,0)") {
        tag.innerHTML = `<span class="color-dot" style="background:${color}"></span> ${label} <button>&times;</button>`;
    } else {
        tag.innerHTML = `${label} <button>&times;</button>`;
    }

    tag.querySelector("button").addEventListener("click", () => {
        tag.remove();
        if (inputEl.type === "checkbox" || inputEl.type === "radio") {
            inputEl.checked = false;
        } else {
            inputEl.classList.remove("active");
        }
        updateClearAll();
    });

    appliedFiltersDiv.insertBefore(tag, document.querySelector(".clear-all"));
    updateClearAll();
}

function updateClearAll() {
    let clearBtn = document.querySelector(".clear-all");
    const tags = appliedFiltersDiv.querySelectorAll(".filter-tag");

    if (tags.length > 0) {
        if (!clearBtn) {
            clearBtn = document.createElement("button");
            clearBtn.classList.add("clear-all");
            clearBtn.innerHTML = "REMOVE ALL &times;";
            clearBtn.addEventListener("click", () => {
                appliedFiltersDiv.innerHTML = "";
                document.querySelectorAll(".tf-check").forEach(i => i.checked = false);
                document.querySelectorAll(".size-item.active, .color-item.active").forEach(i => i.classList.remove("active"));
                updateClearAll();
            });
            appliedFiltersDiv.appendChild(clearBtn);
        } else {
            appliedFiltersDiv.appendChild(clearBtn); 
        }
    } else {
        if (clearBtn) clearBtn.remove();
    }
}

// ✅ Event binding for checkboxes
document.querySelectorAll(".tf-check").forEach(input => {
    input.addEventListener("change", function () {
        const label = this.dataset.label;
        const group = this.dataset.group;
        const value = this.value;

        if (this.checked) {
            addFilter(label, group, value, this);
        } else {
            const tag = document.querySelector(`[data-group="${group}"][data-value="${value}"]`);
            if (tag) tag.remove();
            updateClearAll();
        }
    });

    // Auto-add if already checked on page load
    if (input.checked) {
        addFilter(input.dataset.label, input.dataset.group, input.value, input);
    }
});



{{-- Price --}}


const minInput = document.getElementById('price-min');
const maxInput = document.getElementById('price-max');
const minValDisplay = document.getElementById('price-min-value');
const maxValDisplay = document.getElementById('price-max-value');

function updateAndReload() {
    let minVal = parseInt(minInput.value);
    let maxVal = parseInt(maxInput.value);

    if (minVal > maxVal) {
        // Ensure min <= max
        if (this.id === 'price-min') minVal = maxVal;
        else maxVal = minVal;
    }

    minValDisplay.textContent = minVal;
    maxValDisplay.textContent = maxVal;

    // Reload page with new GET parameters
    const url = new URL(window.location.href);
    url.searchParams.set('price_min', minVal);
    url.searchParams.set('price_max', maxVal);
    window.location.href = url.toString();
}

// Trigger on slider change
minInput.addEventListener('change', updateAndReload);
maxInput.addEventListener('change', updateAndReload);




// --- MOBILE PRICE FILTER ---
const mobileMin = document.getElementById('mobile-price-min');
const mobileMax = document.getElementById('mobile-price-max');
const mobileMinVal = document.getElementById('mobile-price-min-value');
const mobileMaxVal = document.getElementById('mobile-price-max-value');

if (mobileMin && mobileMax) {
    function updateMobilePriceAndReload() {
        let minVal = parseInt(mobileMin.value);
        let maxVal = parseInt(mobileMax.value);

        if (minVal > maxVal) {
            if (this.id === 'mobile-price-min') minVal = maxVal;
            else maxVal = minVal;
        }

        mobileMinVal.textContent = minVal;
        mobileMaxVal.textContent = maxVal;

        const url = new URL(window.location.href);
        url.searchParams.set('price_min', minVal);
        url.searchParams.set('price_max', maxVal);
        window.location.href = url.toString();
    }

    mobileMin.addEventListener('change', updateMobilePriceAndReload);
    mobileMax.addEventListener('change', updateMobilePriceAndReload);
}


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