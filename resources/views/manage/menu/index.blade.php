@extends('layouts.appv2')

@section('page_title')
    Menu
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
    <div id="index-menu-wrapper">
        <div class="content-wrapper">
            <div class="content-heading">
                <div>
                    Menu
                    <ol class="breadcrumb breadcrumb px-0 pb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <!-- DATATABLE DEMO 1-->
                <div class="card card-default" role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active show" href="#menu" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true">
                                <em class="fa fa-user fa-fw"></em>Menu</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="#add-new" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false">
                                <em class="fa fa-plus-circle fa-fw"></em>Add New</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="menu" role="tabpanel">
                            <table class="table table-striped my-4 w-100 data-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr class="gradeX">
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->admin->first_name }} {{ $menu->admin->last_name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($menu->created_at)) }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a class="btn btn-xs btn-info" href="{{route('menu.show', ['id' => $menu->id])}}"><em class="fa fa-edit"></em></a>
                                                </div>
                                                <div class="col-md-1">
                                                    <form id="delete_{{$menu->id}}" method="post" action="{{route('menu.destroy',['id' => $menu->id])}}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" onclick="deleteItem(this.id)" class="btn btn-xs btn-info" id="{{$menu->id}}"><em class="fa fa-trash"></em></button>
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
                            <div class="card-header">Add New Menu</div>
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="{{route('menu.store')}}">
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
                                            <label class="col-md-2 col-form-label">Food Ingredient</label>
                                            <div class="col-md-10">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Ingredient</th>
                                                        <th>Quantity</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(item, x) in menu_items" class="gradeX">
                                                        <td>@{{ x+1 }}</td>
                                                        <td>@{{ item.food_ingredient_name }}</td>
                                                        <td>@{{ item.quantity }}</td>
                                                        <td><button type="button" @click="removeItem(x)" class="btn btn-xs btn-warning">Remove</button></td>
                                                    </tr>
                                                    <tr class="gradeX">
                                                        <td></td>
                                                        <td>
                                                            <p>@{{ item.food_ingredient_name }} <button type="button" @click="showHidePickFoodIngredient()" class="btn btn-xs btn-info"><em class="fa fa-pencil"></em></button></p>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" v-model="item.quantity">
                                                        </td>
                                                        <td>
                                                            <button @click="addItem()" type="button" class="btn btn-xs btn-primary pull-right">Add Food Ingredient</button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type="hidden" name="menu_items" v-model="JSON.stringify(menu_items)" required>
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
        <div class="my-popup" v-bind:class="{'my-popup-hide':!show_food_ingredient_popup, 'my-popup-show':show_food_ingredient_popup}">
            <div class="col-md-12">
                <h4>Choose Product <a class="btn btn-xs pull-right" @click="showHidePickFoodIngredient()"><em class="fa fa-remove"></em></a></h4>
            </div>
            <table class="table table-bordered table-striped data-table-popup">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Weight</th>
                    <th>URT</th>
                </tr>
                </thead>
                <tbody>
                @foreach($food_ingredients as $ingredient)
                    <tr class="gradeX">
                        <td>{{ $ingredient->id }}</td>
                        <td>
                            <a href="javascript:void(0)" @click="pickFoodIngredient('{{ json_encode($ingredient) }}')">
                                {{ $ingredient->foodIngredientCategory->name }}
                            </a>
                        </td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->weight }}</td>
                        <td>
                            @foreach($ingredient->foodIngredientUrt as $x => $urt)
                                @if($x == 0)
                                    @if($urt->quantity){{ $urt->quantity }}@endif {{ $urt->urt->slug }}
                                @else
                                    , @if($urt->quantity){{ $urt->quantity }}@endif {{ $urt->urt->slug }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
        $(function () {
            $('.data-table-popup').DataTable({
                lengthMenu: [5]
            });
        });
    </script>
    @include('manage.menu.scripts.index')
@endsection