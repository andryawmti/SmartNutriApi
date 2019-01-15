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
                Manage User
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <div class="card-header"><h4>Edit User</h4></div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="{{route('user.update', ['id' => $user->id])}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">First Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->first_name }}" name="first_name" type="text" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Last Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->last_name }}" name="last_name" type="text" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->email }}" name="email" type="email" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->password }}" name="password" type="text" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Birth Date</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ date('Y-m-d', strtotime($user->birth_date)) }}" name="birth_date" type="date" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Address</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="address">{{ $user->address }}</textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Pregnancy Start At</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ date('Y-m-d', strtotime($user->pregnancy_start_at)) }}" name="pregnancy_start_at" type="date" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Height</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->height }}" name="height" type="text" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Weight</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $user->weight }}" name="weight" type="text" required>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" id="photo-url" name="photo_url">
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Photo</label>
                                <div class="col-md-10">
                                    <div id="photo-wrapper">
                                        <img style="width: 200px; height: auto;" src="@if($user->photo) {{ url($user->photo) }} @else {{ url('angleadmin/img/user/08.jpg') }} @endif" alt="Photo">
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
                                    <button style="margin-top: 10px;" onclick="pickPhoto()" type="button" class="btn btn-xs btn-info">Choose <span class="fa fa-upload"></span></button>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </fieldset>
                    </form>
                    <form id="profile-image" action="{{ route('user.upload-photo') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    </form>
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
@endsection