@extends('layouts.appv2')

@section('page_title')
    Article
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
                Manage Article
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Article</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active show" href="#article" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true">
                            <em class="fa fa-user fa-fw"></em>Article</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#add-new" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false">
                            <em class="fa fa-plus-circle fa-fw"></em>Add New</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="article" role="tabpanel">
                        <table class="table table-striped my-4 w-100 data-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $a)
                                <tr class="gradeX">
                                    <td>{{ $a->id }}</td>
                                    <td>{{ $a->admin->first_name }} {{ $a->admin->last_name }}</td>
                                    <td>{{ $a->title }}</td>
                                    <td>{{ date('d-M-Y H:i:s', strtotime($a->created_at)) }}</td>
                                    <td>
                                        @if($a->updated_at)
                                            {{ date('d-M-Y H:i:s', strtotime($a->updated_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a class="btn btn-xs btn-info" href="{{route('article.show', ['id' => $a->id])}}"><em class="fa fa-edit"></em></a>
                                            </div>
                                            <div class="col-md-1">
                                                <form id="delete_{{$a->id}}" method="post" action="{{route('article.destroy',['id' => $a->id])}}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" onclick="deleteItem(this.id)" class="btn btn-xs btn-info" id="{{$a->id}}"><em class="fa fa-trash"></em></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="add-new" role="tabpanel">
                        <div class="card-header">Add New Article</div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('article.store')}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Title</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('title') }}" name="title" type="text" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Content</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="content">{{ old('content') }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <input type="hidden" id="photo-url" name="photo_url">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Photo</label>
                                        <div class="col-md-10">
                                            <div id="photo-wrapper">
                                                <img style="width: 200px; height: auto;" src="{{ url('angleadmin/img/user/08.jpg') }}" alt="Photo">
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
                            <form id="article-image" action="{{ route('article.upload-photo') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
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
    @include('includes.datatable_script')
    <script>
        function pickPhoto() {
            $('#previews').html('');
            $('#article-image').trigger('click');
        }

        $(document).ready(function () {
            let previewNode = document.querySelector("#template");
            previewNode.id = "";
            let previewTemplates = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            let myDropzone = new Dropzone('#article-image', {
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