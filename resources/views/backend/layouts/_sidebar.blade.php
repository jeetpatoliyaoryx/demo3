
@php
    $getHomeHeader = App\Models\HeaderModel::first();
    @endphp
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper logo-wrapper-center">
                        <a href="{{ url('admin/dashboard') }}" data-bs-original-title="" title="">
                            <img class="img-fluid for-dark" src="{{ $getHomeHeader->getLogo() }}" alt="">
                        </a>
                        
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="{{ url('admin/dashboard') }}">
                            <img class="img-fluid main-logo" src="{{ $getHomeHeader->getLogo() }}" alt="logo">
                        </a>
                    </div>
                    
                    <nav class="sidebar-main">
                       

                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"></li>
                                

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'dashboard')  @endif" href="{{ url('admin/dashboard') }}">
                                        <i data-feather="home"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'users')  @endif" href="{{ url('admin/users') }}">
                                        <i data-feather="users"></i>
                                        <span>Users</span>
                                    </a>
                                </li>    

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'category') @endif" href="{{ url('admin/category') }}">
                                        <i data-feather="align-left"></i>
                                        <span>Category </span>
                                    </a>
                                </li>

                                 <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'catalogue') @endif" href="{{ url('admin/catalogue') }}">
                                        <i data-feather="align-left"></i>
                                        <span>Catalogue </span>
                                    </a>
                                </li>     
                                
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'product') @endif" href="{{ url('admin/product') }}">
                                        <i data-feather="box"></i>
                                        <span>Products</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'orders')  @endif" href="{{ url('admin/orders') }}">
                                        <i data-feather="list"></i>
                                        <span>Orders </span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'report')  @endif" href="{{ url('admin/report') }}">
                                        <i data-feather="box"></i>
                                        <span>Report</span>
                                    </a>
                                </li>   

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'couponcode')  @endif" href="{{ url('admin/couponcode') }}">
                                        <i data-feather="box"></i>
                                        <span>Coupon Code</span>
                                    </a>
                                </li>
                               
                                                       

                                <!-- <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'withdraw_requests') @endif" href="{{ url('admin/withdraw_requests') }}">
                                        <i data-feather="users"></i>
                                        <span>Withdraw Requests</span>
                                    </a>
                                </li> -->                          

                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title 
                                        @if(in_array(Request::segment(2), ['assurance','banner','all_title','customer_say','instagram','why_shop','header','marquee','surface','spacing','marketing_key'])) @endif" 
                                        href="javascript:void(0)">
                                        <i data-feather="archive"></i>
                                        <span>Website Settings</span>
                                        <i class="arrow" data-feather="chevron-right"></i>
                                    </a>

                                    {{-- Website Settings Submenu --}}
                                    <ul class="sidebar-submenu" 
                                        style="@if(in_array(Request::segment(2), ['assurance', 'banner','all_title','customer_say','instagram','why_shop','header','marquee','surface','spacing','marketing_key'])) @endif">

                                        {{-- Home Banners --}}

                                        <li><a href="{{ url('admin/header') }}" class="@if(Request::segment(2) == 'header') @endif"><i data-feather="check-circle"></i> Header</a></li>
                                        <li><a href="{{ url('admin/marketing_key') }}" class="@if(Request::segment(2) == 'marketing_key') @endif"><i data-feather="check-circle"></i> Marketing Key</a></li>

                                        <li>
                                            <a class=" @if(Request::segment(2) == 'footer') @endif" href="{{ url('admin/footer') }}">
                                                <i data-feather="tag"></i>
                                                <span>Footer </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('admin/banner') }}" 
                                                class="@if(Request::segment(2) == 'banner') @endif">
                                                <i data-feather="align-left"></i> Home Banners
                                            </a>
                                        </li>

                                         <li>
                                            <a href="{{ url('admin/assurance') }}" 
                                                class="@if(Request::segment(2) == 'assurance') @endif">
                                                <i data-feather="align-left"></i> Assurance Text
                                            </a>
                                        </li>
                                        
                                        <li><a href="{{ url('admin/all_title') }}" class="@if(Request::segment(2) == 'all_title')  @endif"><i data-feather="check-circle"></i> All Title</a></li>
                                        <li><a href="{{ url('admin/customer_say') }}" class="@if(Request::segment(2) == 'customer_say')  @endif"><i data-feather="check-circle"></i> Customer Reviews</a></li>
                                        <li><a href="{{ url('admin/instagram') }}" class="@if(Request::segment(2) == 'instagram')  @endif"><i data-feather="check-circle"></i> Shop Instagram</a></li>
                                        <li><a href="{{ url('admin/why_shop') }}" class="@if(Request::segment(2) == 'why_shop')  @endif"><i data-feather="check-circle"></i> Why Shop</a></li>
                                        <li><a href="{{ url('admin/marquee') }}" class="@if(Request::segment(2) == 'marquee')  @endif"><i data-feather="check-circle"></i> Marquee</a></li>
                                        <li><a href="{{ url('admin/surface') }}" class="@if(Request::segment(2) == 'surface')  @endif"><i data-feather="check-circle"></i> Mid Banner Collection</a></li>
                                        <li><a href="{{ url('admin/spacing') }}" class="@if(Request::segment(2) == 'spacing')  @endif"><i data-feather="check-circle"></i> Spacing Collection</a></li>
                                         


                                        <li>
                                            <a class=" @if(Request::segment(2) == 'color')  @endif" href="{{ url('admin/color') }}">
                                                <i data-feather="archive"></i>
                                                <span>Color</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class=" @if(Request::segment(2) == 'size')  @endif" href="{{ url('admin/size') }}">
                                                <i data-feather="tag"></i>
                                                <span>Size</span>
                                            </a>
                                        </li>
                                

                                        <li>
                                            <a class=" @if(Request::segment(2) == 'subscribe') @endif" href="{{ url('admin/subscribe') }}">
                                                <i data-feather="tag"></i>
                                                <span>Subscribe</span>
                                            </a>
                                        </li>
                                        




                                    </ul>
                                </li>

                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title 
                                        @if(in_array(Request::segment(2), ['shipping_policy','return_refund','privacy_policy','terms_conditions','about_image','about_add','facebook'])) @endif" 
                                        href="javascript:void(0)">
                                        <i data-feather="archive"></i>
                                        <span>All Policy Pages</span>
                                        <i class="arrow" data-feather="chevron-right"></i>
                                    </a>


                                    <ul class="sidebar-submenu" 
                                        style="@if(in_array(Request::segment(2), ['shipping_policy', 'return_refund', 'privacy_policy','terms_conditions','about_image','about_add','facebook'])) @endif">

                                        {{-- Home Banners --}}
                                        <li>
                                            <a href="{{ url('admin/shipping_policy') }}" 
                                                class="@if(Request::segment(2) == 'shipping_policy') @endif">
                                                <i data-feather="align-left"></i> Shipping Policy
                                            </a>
                                        </li>

                                         <li>
                                            <a href="{{ url('admin/return_refund') }}" 
                                                class="@if(Request::segment(2) == 'return_refund') @endif">
                                                <i data-feather="align-left"></i> Return & Refund Policy
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin/privacy_policy') }}" 
                                                class="@if(Request::segment(2) == 'privacy_policy') @endif">
                                                <i data-feather="align-left"></i> Privacy Policy
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('admin/terms_conditions') }}" 
                                                class="@if(Request::segment(2) == 'terms_conditions') @endif">
                                                <i data-feather="align-left"></i> Terms & Conditions
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="sidebar-list">
                                    <a href="javascript:void(0)" 
                                        class="linear-icon-link sidebar-link sidebar-title @if(in_array(Request::segment(2), ['about_image','about_add'])) @endif">
                                        <i data-feather="archive"></i>
                                        <span>About Us Setting</span>
                                        <i class="arrow" data-feather="chevron-right"></i>
                                    </a>

                                    {{-- Nested Submenu --}}
                                    <ul class="sidebar-submenu" 
                                        style="@if(in_array(Request::segment(2), ['about_image','about_add','facebook'])) @endif">
                                        
                                        <li><a href="{{ url('admin/about_image') }}" class="@if(Request::segment(2) == 'about_image') @endif"><i data-feather="check-circle"></i> About Image</a></li>
                                        <li><a href="{{ url('admin/about_add') }}" class="@if(Request::segment(2) == 'about_add') @endif"><i data-feather="check-circle"></i>About Add</a></li>
                                        <li><a href="{{ url('admin/facebook') }}" class="@if(Request::segment(2) == 'facebook') @endif"><i data-feather="check-circle"></i>Facebook</a></li>
                                        
                                    </ul>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'contact_setting') @endif" href="{{ url('admin/contact_setting') }}">
                                        <i data-feather="archive"></i>
                                        <span>Contact Setting </span>
                                    </a>
                                </li>

                                

                                   <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'seo') @endif" href="{{ url('admin/seo') }}">
                                        <i data-feather="users"></i>
                                        <span>Page Title</span>
                                    </a>
                                </li>

                                

                                

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'contact_us') @endif" href="{{ url('admin/contact_us') }}">
                                        <i data-feather="phone"></i>
                                        <span>Contact us inquiry </span>
                                    </a>
                                </li>

                                

                             

                                
                                
                      
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav @if(Request::segment(2) == 'email_subscribe') @endif" href="{{ url('admin/email_subscribe') }}">
                                        <i data-feather="tag"></i>
                                        <span>Email Subscribe </span>
                                    </a>
                                </li>
                      

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav  @if(Request::segment(2) == 'my_account') @endif" href="{{ url('admin/my_account ') }}">
                                        <i data-feather="settings"></i>
                                        <span>Profile Setting </span>
                                    </a>
                                </li>



                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow">
                            <i data-feather="arrow-right"></i>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->


            <!-- <script>
$(document).ready(function () {
    // 🔹 Fix focus blue flicker
    $(document).on('mousedown', '.sidebar-wrapper a', function () {
        $(this).blur();
    });

    // 🔹 Keep all submenus open by default (even without active)
    $(".sidebar-submenu").each(function () {
        $(this).slideDown(0); // always open
        $(this).prev(".sidebar-title").addClass("active");
    });

    // 🔹 Ensure main title arrow stays down for all open menus
    $(".sidebar-title .according-menu i")
        .removeClass("fa-angle-right")
        .addClass("fa-angle-down");

    // 🔹 Keep active link highlighted
    $(".sidebar-submenu").each(function () {
        if ($(this).find("a.active").length > 0) {
            $(this).find("a.active").css("color", "#FFB700");
        }
    });
});
</script> -->


<script>
document.addEventListener("DOMContentLoaded", function () {
  const allLinks = document.querySelectorAll(".sidebar-link");
  const submenus = document.querySelectorAll(".sidebar-submenu");

  // Normalize function
  const normalize = (href) => {
    if (!href) return null;
    const a = document.createElement("a");
    a.href = href;
    return a.pathname.replace(/\/+$/, "");
  };

  const currentPath = window.location.pathname.replace(/\/+$/, "");

  // Remove all actives
  function clearAllActive() {
    allLinks.forEach((el) => el.classList.remove("active", "parent-active"));
    document.querySelectorAll(".sidebar-submenu a").forEach((a) => a.classList.remove("active"));
    submenus.forEach((s) => s.classList.remove("open"));
  }

  // Apply active from URL
  let matched = false;
  document.querySelectorAll(".sidebar-submenu a").forEach((a) => {
    const href = normalize(a.getAttribute("href"));
    if (href && href === currentPath) {
      matched = true;
      clearAllActive();
      a.classList.add("active");
      const parent = a.closest(".sidebar-list");
      if (parent) {
        const plink = parent.querySelector(".sidebar-link");
        const submenu = parent.querySelector(".sidebar-submenu");
        if (plink) plink.classList.add("parent-active");
        if (submenu) submenu.classList.add("open");
      }
    }
  });

  if (!matched) {
    document.querySelectorAll(".sidebar-link.link-nav").forEach((link) => {
      const href = normalize(link.getAttribute("href"));
      if (href && href === currentPath) {
        clearAllActive();
        link.classList.add("active");
        matched = true;
      }
    });
  }

  // Default dashboard active
  if (!matched) {
    const dashboard = document.querySelector('.sidebar-link[href*="dashboard"]');
    if (dashboard) dashboard.classList.add("active");
  }

  // Toggle submenu on click
  allLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const parentLi = link.closest(".sidebar-list");
      const submenu = parentLi ? parentLi.querySelector(".sidebar-submenu") : null;

      // Has submenu
      if (submenu) {
        e.preventDefault();
        const open = submenu.classList.contains("open");

        // Close all others
        submenus.forEach((s) => {
          if (s !== submenu) s.classList.remove("open");
        });
        allLinks.forEach((l) => {
          if (l !== link) l.classList.remove("parent-active", "active");
        });
        document.querySelectorAll(".sidebar-submenu a").forEach((a) => a.classList.remove("active"));

        // Toggle
        if (open) {
          submenu.classList.remove("open");
          link.classList.remove("parent-active");
        } else {
          submenu.classList.add("open");
          link.classList.add("parent-active");
        }
      } else {
        // No submenu → direct link
        clearAllActive();
        link.classList.add("active");
      }
    });
  });

  // Submenu anchors click
  document.querySelectorAll(".sidebar-submenu a").forEach((a) => {
    a.addEventListener("click", function () {
      document.querySelectorAll(".sidebar-submenu a").forEach((x) => x.classList.remove("active"));
      this.classList.add("active");
      const parent = this.closest(".sidebar-list");
      if (parent) {
        const plink = parent.querySelector(".sidebar-link");
        const submenu = parent.querySelector(".sidebar-submenu");
        if (plink) plink.classList.add("parent-active");
        if (submenu) submenu.classList.add("open");
      }
    });
  });
});
</script>


