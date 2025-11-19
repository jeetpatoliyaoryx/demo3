<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @php
        $getHomeHeader = App\Models\HeaderModel::first();
    @endphp

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ $getHomeHeader->getFaviconLogo() }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $getHomeHeader->getFaviconLogo() }}" type="image/x-icon">
    <title>{{ !empty($meta_title) ? $meta_title : '' }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{ url('backend/assets/css/linearicon.css') }}">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/font-awesome.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/themify.css') }}">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/ratio.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vendors/bootstrap.css') }}">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/vector-map.css') }}">

    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/slick-theme.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/style.css') }}">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/responsive.css') }}">
    <style type="text/css">
        /* .sidebar-link.active,
        .sidebar-submenu a.active {
            background-color: #007bff !important;
            color: white !important;
            border-radius: 8px;
        }

        .sidebar-submenu {
            display: none;
        }

        .sidebar-submenu[style*="display:block"] {
            display: block;
        } */
    </style>
    @yield('style')

</head>

<body>

    @include('backend.layouts._header')

    @include('backend.layouts._sidebar')

    @yield('content')

    @include('backend.layouts._footer')

    </div>
    <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->


    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no " data-bs-dismiss="modal">No</button>
                        <a href="{{ url('logout') }}" class="btn  btn--yes btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->




    <!-- latest js -->
    <script src="{{ url('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ url('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ url('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ url('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ url('backend/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ url('backend/assets/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar jquery -->
    <script src="{{ url('backend/assets/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ url('backend/assets/js/tooltip-init.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ url('backend/assets/js/sidebar-menu.js') }}"></script>



    <script src="{{ url('backend/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="assets/js/notify/index.js') }}"></script>

    <!-- Apexchar js -->
    <script src="{{ url('backend/assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ url('backend/assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ url('backend/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ url('backend/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ url('backend/assets/js/chart/apex-chart/chart-custom1.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ url('backend/assets/js/customizer.js') }}"></script>



    <!-- customizer js -->

    <!-- ratio js -->
    <script src="{{ url('backend/assets/js/ratio.js') }}"></script>

     <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Theme js -->
    <script src="{{ url('backend/assets/js/script.js') }}"></script>

    @yield('script')
    <script type="text/javascript">

    </script>

    <!-- <script>
        $(document).ready(function () {
            // Handle third-level submenus inside sidebar-submenu
            $('.sidebar-submenu > li > a[href="javascript:void(0)"]').each(function() {
                // Add arrow icon if not already present
                if (!$(this).find('.according-menu').length) {
                    $(this).append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
                }

                // Click event for nested submenu (like Order Detail)
                $(this).on('click', function (e) {
                    e.preventDefault();

                    const $submenu = $(this).next('.sidebar-submenu');

                    if ($submenu.is(':visible')) {
                        $(this).removeClass('active');
                        $(this).find('.according-menu i').attr('class', 'fa fa-angle-right');
                        $submenu.slideUp('normal');
                    } else {
                        $(this).addClass('active');
                        $(this).find('.according-menu i').attr('class', 'fa fa-angle-down');
                        $submenu.slideDown('normal');
                    }
                });
            });
        });
    </script> -->

</body>

</html>