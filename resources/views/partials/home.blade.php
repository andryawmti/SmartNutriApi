@extends('layouts.appv2')

@section('page_title')
    Home
@endsection

@section('page_css')
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- WEATHER ICONS-->
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/weather-icons/css/weather-icons.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('main_content')
    <div class="content-wrapper">
        <div class="content-heading">
            <div>Dashboard
                <small data-localize="dashboard.WELCOME"></small>
            </div>
        </div>
        <!-- START cards box-->
        <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- START card-->
                    <div class="card flex-row align-items-center align-items-stretch border-0">
                        <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left">
                            <em class="icon-people fa-3x"></em>
                        </div>
                        <div class="col-8 py-3 bg-primary rounded-right">
                            <div class="h2 mt-0"></div>
                            <div class="text-uppercase">Users</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <!-- START card-->
                    <div class="card flex-row align-items-center align-items-stretch border-0">
                        <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left">
                            <em class="icon-people fa-3x"></em>
                        </div>
                        <div class="col-8 py-3 bg-purple rounded-right">
                            <div class="h2 mt-0"></div>
                            <div class="text-uppercase">Administrator</div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-3 col-lg-6 col-md-12">
                <!-- START card-->
                <div class="card flex-row align-items-center align-items-stretch border-0">
                    <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left">
                        <em class="icon-graph fa-3x"></em>
                    </div>
                    <div class="col-8 py-3 bg-green rounded-right">
                        <div class="h2 mt-0"></div>
                        <div class="text-uppercase">Api Call Today</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12">
                <!-- START card-->
                <div class="card flex-row align-items-center align-items-stretch border-0">
                    <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left">
                        <em class="icon-graph fa-3x"></em>
                    </div>
                    <div class="col-8 py-3 bg-green rounded-right">
                        <div class="h2 mt-0"></div>
                        <div class="text-uppercase">Api Call Of All Time</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END cards box-->
        <div class="row">
            <!-- START dashboard main content-->
            <div class="col-xl-12">
                <!-- START chart-->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- START card-->
                        <div class="card card-default card-demo">
                            <div class="card-header">
                                <a class="float-right" href="#" data-tool="card-refresh" data-toggle="tooltip" title="Refresh card">
                                    <em class="fa fa-refresh"></em>
                                </a>
                                <a class="float-right" href="#" data-tool="card-collapse" data-toggle="tooltip" title="Collapse card">
                                    <em class="fa fa-minus"></em>
                                </a>
                                <div class="card-title">API Call statistics</div>
                            </div>
                            <div class="card-wrapper collapse show">
                                <div class="card-body">
                                    <div id="api-call-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END card-->
                    </div>
                </div>
            </div>
            <!-- END dashboard main content-->
        </div>
    </div>
@endsection

@section('page_js')
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- SLIMSCROLL-->
    <script src="{{asset('angleadmin/vendor/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- SPARKLINE-->
    <script src="{{asset('angleadmin/vendor/jquery-sparkline/jquery.sparkline.js')}}"></script>
    <!-- FLOT CHART-->
    <script src="{{asset('angleadmin/vendor/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('angledamin/vendor/jquery.flot.spline/jquery.flot.spline.html')}}"></script>
    <!-- EASY PIE CHART-->
    <script src="{{asset('angleadmin/vendor/easy-pie-chart/dist/jquery.easypiechart.js')}}"></script>
    <!-- MOMENT JS-->
    <script src="{{asset('angleadmin/vendor/moment/min/moment-with-locales.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
   {{-- <script>
        $(function () {
            let data = {!! json_encode($api_call_stats) !!};
            new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'api-call-chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: data,
                // The name of the data record attribute that contains x-values.
                xkey: 'date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Total Call']
            });
        });
    </script>--}}
@endsection