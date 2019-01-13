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
                Manage Admin
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active show" href="#admin" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true">
                            <em class="fa fa-user fa-fw"></em>Admins</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#add-new" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false">
                            <em class="fa fa-plus-circle fa-fw"></em>Add New</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="admin" role="tabpanel">
                        <table class="table table-striped my-4 w-100 data-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Regisered At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $a)
                                @if($a->id != 1 && $a->id != auth::user()->id)
                                <tr class="gradeX">
                                    <td>{{ $a->id }}</td>
                                    <td>{{ $a->first_name }} {{ $a->last_name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ date('d-M-Y', strtotime($a->created_at)) }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a class="btn btn-xs btn-info" href="{{route('admin.show', ['id' => $a->id])}}"><em class="fa fa-edit"></em></a>
                                            </div>
                                            <div class="col-md-1">
                                                <form id="delete_{{$a->id}}" method="post" action="{{route('admin.destroy',['id' => $a->id])}}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" onclick="deleteItem(this.id)" class="btn btn-xs btn-info" id="{{$a->id}}"><em class="fa fa-trash"></em></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="add-new" role="tabpanel">
                        <div class="card-header">Add New Admin</div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('admin.store')}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">First Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('first_name') }}" name="first_name" type="text" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Last Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('last_name') }}" name="last_name" type="text" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('email') }}" name="email" type="email" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Password</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('password') }}" name="password" type="text" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="address">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Photo</label>
                                        <div class="col-md-10">
                                            <img src="#" alt="Photo">
                                            <input type="file" name="photo">
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
@endsection