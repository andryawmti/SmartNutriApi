@extends('layouts.appv2')

@section('page_title')
    Food Ingredient Category
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
                Manage Food Ingredient Category
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Food Ingredient Category</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active show" href="#category" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true">
                            <em class="fa fa-user fa-fw"></em>Category</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#add-new" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false">
                            <em class="fa fa-plus-circle fa-fw"></em>Add New</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="category" role="tabpanel">
                        <table class="table table-striped my-4 w-100 data-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Calorie</th>
                                <th>Protein</th>
                                <th>Carbohydrate</th>
                                <th>Fat</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cat)
                                <tr class="gradeX">
                                    <td>{{ $cat->id }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->calorie }}</td>
                                    <td>{{ $cat->protein }}</td>
                                    <td>{{ $cat->carbohydrate }}</td>
                                    <td>{{ $cat->fat }}</td>
                                    <td>{{ date('d-M-Y', strtotime($cat->created_at)) }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a class="btn btn-xs btn-info" href="{{route('food-ingredient-category.show', ['id' => $cat->id])}}"><em class="fa fa-edit"></em></a>
                                            </div>
                                            <div class="col-md-1">
                                                <form id="delete_{{$cat->id}}" method="post" action="{{route('food-ingredient-category.destroy',['id' => $cat->id])}}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" onclick="deleteItem(this.id)" class="btn btn-xs btn-info" id="{{$cat->id}}"><em class="fa fa-trash"></em></button>
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
                        <div class="card-header">Add New Category</div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('food-ingredient-category.store')}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('name') }}" name="name" type="text" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Calorie</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('calorie') }}" name="calorie" type="text">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Protein</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('protein') }}" name="protein" type="text">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Carbohydrate</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('carbohydrate') }}" name="carbohydrate" type="text">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Fat</label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ old('fat') }}" name="fat" type="text">
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