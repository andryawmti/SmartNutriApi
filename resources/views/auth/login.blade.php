<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Login | SmartNutri</title>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/font-awesome/css/font-awesome.css')}}">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/simple-line-icons/css/simple-line-icons.css')}}">
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('angleadmin/css/bootstrap.css')}}" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('angleadmin/css/app.css')}}" id="maincss">
</head>

<body>
<div class="wrapper">
    <div class="block-center mt-4 wd-xl">
        <!-- START card-->
        <div class="card card-flat">
            <div class="card-header text-center">
               <h3>SmartNutri Login</h3>
            </div>
            <div class="card-body">
                <form id="loginForm" class="mb-3" action="{{route('login')}}" method="post" role="form" novalidate="">
                    @csrf
                    <div class="form-group">
                        <div class="input-group with-focus">
                            <input class="form-control border-right-0" type="email" name="email" placeholder="Enter email" required>
                            <div class="input-group-append">
                                <span class="input-group-text fa fa-envelope text-muted bg-transparent border-left-0"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group with-focus">
                            <input class="form-control border-right-0" type="password" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="checkbox c-checkbox float-left mt-0">
                            <label>
                                <input type="checkbox" value="" name="remember">
                                <span class="fa fa-check"></span>Remember Me</label>
                        </div>
                        <div class="float-right">{{--<a class="text-muted" href="#">Forgot your password?</a>--}}
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary mt-3" type="submit">Login</button>
                </form>
            </div>
        </div>
        <!-- END card-->
        <div class="p-3 text-center">
            Copyright
            <span>&copy;</span>
            <span>{{date('Y')}}</span>
            <span>-</span>
            <span>SmartNutri</span>
            {{--<br>
            <span>With Angleadmin Theme</span>--}}
        </div>
    </div>
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{asset('angleadmin/vendor/modernizr/modernizr.custom.js')}}"></script>
<!-- JQUERY-->
<script src="{{asset('angleadmin/vendor/jquery/dist/jquery.js')}}"></script>
<!-- BOOTSTRAP-->
<script src="{{asset('angleadmin/vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- STORAGE API-->
<script src="{{asset('angleadmin/vendor/js-storage/js.storage.js')}}"></script>
<!-- PARSLEY-->
<script src="{{asset('angleadmin/vendor/parsleyjs/dist/parsley.js')}}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{asset('angleadmin/js/app.js')}}"></script>
</html>