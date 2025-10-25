<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('cuba')}}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('cuba')}}/images/favicon.png" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/date-picker.css">

    <!-- Plugins css Ends-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/style.css">
    <link id="color" rel="stylesheet" href="{{asset('cuba')}}/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('cuba')}}/css/responsive.css">

</head>
<body onload="startTime()">
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('layouts.navbar')
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Default</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Default</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.footer')
    </div>
</div>
<!-- latest jquery-->
<script src="{{asset('cuba')}}/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap js-->
<script src="{{asset('cuba')}}/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="{{asset('cuba')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('cuba')}}/js/datatable/datatables/datatable.custom.js"></script>
<!-- feather icon js-->
<script src="{{asset('cuba')}}/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset('cuba')}}/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="{{asset('cuba')}}/js/scrollbar/simplebar.js"></script>
<script src="{{asset('cuba')}}/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="{{asset('cuba')}}/js/config.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('cuba')}}/js/sidebar-menu.js"></script>
<script src="{{asset('cuba')}}/js/chart/chartist/chartist.js"></script>
<script src="{{asset('cuba')}}/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="{{asset('cuba')}}/js/chart/knob/knob.min.js"></script>
<script src="{{asset('cuba')}}/js/chart/knob/knob-chart.js"></script>
<script src="{{asset('cuba')}}/js/chart/apex-chart/apex-chart.js"></script>
<script src="{{asset('cuba')}}/js/chart/apex-chart/stock-prices.js"></script>
<script src="{{asset('cuba')}}/js/notify/bootstrap-notify.min.js"></script>
<script src="{{asset('cuba')}}/js/dashboard/default.js"></script>
{{--<script src="{{asset('cuba')}}/js/notify/index.js"></script>--}}
<script src="{{asset('cuba')}}/js/datepicker/date-picker/datepicker.js"></script>
<script src="{{asset('cuba')}}/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="{{asset('cuba')}}/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="{{asset('cuba')}}/js/typeahead/handlebars.js"></script>
<script src="{{asset('cuba')}}/js/typeahead/typeahead.bundle.js"></script>
<script src="{{asset('cuba')}}/js/typeahead/typeahead.custom.js"></script>
<script src="{{asset('cuba')}}/js/typeahead-search/handlebars.js"></script>
<script src="{{asset('cuba')}}/js/typeahead-search/typeahead-custom.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('cuba')}}/js/script.js"></script>
<script src="{{asset('cuba')}}/js/theme-customizer/customizer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- login js-->
<!-- Plugin used-->
</body>
</html>
