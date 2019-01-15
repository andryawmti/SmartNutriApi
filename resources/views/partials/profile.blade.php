@extends('layouts.appv2')

@section('page_title')
    User
@endsection

@section('page_css')
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- Datatables-->
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('angleadmin/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css')}}">
@endsection

@section('main_content')
    <!-- Page content-->
    <div class="content-wrapper">
        <div class="content-heading">
            <div>
                Profile Settings
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Profile Settings</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active show" href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="true">
                            <em class="fa fa-user fa-fw"></em>Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#change-password" aria-controls="change-password" role="tab" data-toggle="tab" aria-selected="false">
                            <em class="fa fa-lock fa-fw"></em>Change Password</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#api-token" aria-controls="api-token" role="tab" data-toggle="tab" aria-selected="false">
                            <em class="fa fa-key fa-fw"></em>Api Token</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('profile.update', ['id' => auth::user()->id])}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">First Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="first_name" type="text" value="{{ auth::user()->first_name }}" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Last Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="last_name" type="text" value="{{ auth::user()->last_name }}" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="email" type="email" value="{{ auth::user()->email }}" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="address" rows="4">{{ auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <input type="hidden" id="photo-url" name="photo_url" value="{{ auth::user()->photo }}">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Photo</label>
                                        <div class="col-md-10">
                                            <div id="photo-wrapper">
                                                <img style="width: 200px; height: auto;" src="@if(auth::user()->photo) {{ url(auth::user()->photo) }} @else {{ url('angleadmin/img/user/08.jpg') }} @endif" alt="Photo">
                                            </div>
                                            <div id="previews">
                                                <div id="template">
                                                    <div style="display: none;">
                                                        <img id="image-preview" data-dz-thumbnail  src=""/>
                                                    </div>
                                                    <div>
                                                        <span class="label label-danger" data-dz-errormessage></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <button style="margin-top: 10px;" onclick="pickPhoto()" type="button" class="btn btn-xs btn-info">
                                                Choose <span class="fa fa-upload"></span>
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </fieldset>
                            </form>
                            <form id="profile-image" action="{{ route('profile.upload-photo') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="change-password" role="tabpanel">
                        {{--<div class="card-header">Change Password</div>--}}
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('profile.change-password', ['id' => auth::user()->id])}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Current Password</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="current_password" type="password" value="" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">New Password</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="new_password" type="password" value="" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">New Password Confirmation</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="new_password_confirmation" type="password" value="" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="api-token" role="tabpanel">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="#">
                                @csrf
                                <fieldset>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-2 col-form-label mb-2">Api Token</label>
                                        <div class="col-md-10">
                                            <div class="input-group date">
                                                <input class="form-control" name="api_token" type="text" value="{{ auth::user()->api_token }}" readonly>
                                                <span class="input-group-append input-group-addon">
                                                    <button id="copy-token" type="button" class="btn btn-info btn-xs pull-right">
                                                        <span class="fa fa-copy"></span> <b id="btn-title">Copy</b>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <button type="button" id="generate-token" class="btn btn-warning">Generate</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.form_validation_notif')
    </div>
@endsection

@section('page_js')
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- Datatables-->
    <script src="{{asset('angleadmin/vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons/js/dataTables.buttons.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons/js/buttons.colVis.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons/js/buttons.flash.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons/js/buttons.html5.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-buttons/js/buttons.print.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-keytable/js/dataTables.keyTable.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('angleadmin/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    {{--<script src="{{asset('angleadmin/vendor/dropzone/dist/dropzone.js')}}"></script>--}}
    <script>
        $('#generate-token').click(() => {
            if (confirm('Are you sure?')) {
                axios.get("{{route('profile.generate-token')}}")
                    .then(res => {
                        $("input[name=api_token]").val(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        });

        $('#copy-token').click(()=>{
            $("input[name=api_token]").select();
            document.execCommand('copy');
            $('#copy-token #btn-title').html('Copied');
        });
    </script>
    <script>
        function pickPhoto() {
            $('#previews').html('');
            $('#profile-image').trigger('click');
        }

        $(document).ready(function () {
            let previewNode = document.querySelector("#template");
            previewNode.id = "";
            let previewTemplates = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            let myDropzone = new Dropzone('#profile-image', {
                previewTemplate : previewTemplates,
                previewsContainer : "#previews",
                thumbnailWidth: 255,
                thumbnailHeight: 255,
                maxFilesize: 3
            });

            myDropzone.on("uploadprogress", function(data, progress, bytes) {
                $('#upload-progress .progress .progress-bar').css('width', progress + '%');
            });

            myDropzone.on("sending", function(data, xhr, formData) {
                $('#upload-progress .progress .progress-bar').css('width', '1%');
                $('#upload-progress').css('display', 'block');
            });

            myDropzone.on("queuecomplete", function() {
                $('#upload-progress').css('display', 'none');
            });

            myDropzone.on('complete', function(response){
                $('#upload-progress').css('display', 'none');
                let xhrResponse = response.xhr.response;
                xhrResponse = JSON.parse(xhrResponse);
                $('#photo-url').val(xhrResponse.url);
            });

            myDropzone.on('success', function(response){
                $('#upload-progress').css('display', 'none');
                let src = $('#image-preview').attr('src');
                $('#photo-wrapper img').attr('src', src);
                $('#previews').html('');
            });
        });
    </script>
    @include('includes.datatable_script')
@endsection