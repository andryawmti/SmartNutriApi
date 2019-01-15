@extends('layouts.appv2')

@section('page_title')
    Edit Food Ingredient
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
    <div id="edit-food-ingredient-wrapper">
        <div class="content-wrapper">
            <div class="content-heading">
                <div>
                    Manage Food Ingredient
                    <ol class="breadcrumb breadcrumb px-0 pb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('food-ingredient.index') }}">Food Ingredient</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <!-- DATATABLE DEMO 1-->
                <div class="card card-default" role="tabpanel">
                    <div class="card-header"><h4>Edit Food Ingredient</h4></div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('food-ingredient.update', ['id' => $food_ingredient->id])}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Category</label>
                                    <div class="col-md-10">
                                        <select name="food_ingredient_category_id" class="form-control">
                                            @foreach($categories as $cat)
                                                <option @if($cat->id == $food_ingredient->food_ingredient_category_id) selected="selected" @endif value="{{ $cat->id }}">
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" value="{{ $food_ingredient->name }}" name="name" type="text" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Weight (Gram)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" value="{{ $food_ingredient->weight }}" name="weight" type="text" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Ukuran Rumah Tangga (URT)</label>
                                    <div class="col-md-10">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Quantity</th>
                                                <th>URT</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(urt, x) in food_ingredient_urts" class="gradeX">
                                                    <td>@{{ x+1 }}</td>
                                                    <td v-if="urt.quantity">@{{ urt.quantity }}</td><td v-else="urt.quantity">-</td>
                                                    <td>@{{ urt.urt_name }}</td>
                                                    <td><button type="button" @click="removeUrtItem(x)" class="btn btn-xs btn-warning">Remove</button></td>
                                                </tr>
                                                <tr class="gradeX">
                                                    <td></td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="item.quantity">
                                                    </td>
                                                    <td>
                                                        <p>@{{ item.urt_name }} <button type="button" @click="showHidePickUrt()" class="btn btn-xs btn-info"><em class="fa fa-pencil"></em></button></p>
                                                    </td>
                                                    <td>
                                                        <button @click="addItem()" type="button" class="btn btn-xs btn-primary pull-right">Add URT</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="food_ingredient_urts" v-model="JSON.stringify(food_ingredient_urts)">
                            <fieldset>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            @include('includes.form_validation_notif')
        </div>
        <div id="pick-urt" class="my-popup" v-bind:class="{'my-popup-hide':!show_urt_popup, 'my-popup-show':show_urt_popup}">
            <div class="col-md-12">
                <h4>Choose URT <a class="btn btn-xs pull-right" @click="showHidePickUrt()"><em class="fa fa-remove"></em></a></h4>
            </div>
            <table class="table table-bordered table-striped data-table-popup">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($urts as $u)
                    <tr>
                        <td><a href="javascript:void(0)">{{ $u->id }}</a></td>
                        <td><a href="javascript:void(0)" @click="pickUrt('{{ json_encode($u) }}')">{{ $u->name }}</a></td>
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
    <script>
        $(function () {
            $('.data-table-popup').DataTable({
                lengthMenu: [5]
            });
        });
    </script>
    @include('manage.food_ingredient.scripts.edit')
@endsection