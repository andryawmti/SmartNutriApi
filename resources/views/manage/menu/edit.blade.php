@extends('layouts.appv2')

@section('page_title')
    Edit Menu
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
    <div id="edit-menu-wrapper">
        <div class="content-wrapper">
            <div class="content-heading">
                <div>
                    Manage Menu
                    <ol class="breadcrumb breadcrumb px-0 pb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <!-- DATATABLE DEMO 1-->
                <div class="card card-default" role="tabpanel">
                    <div class="card-header"><h4>Edit Menu</h4></div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('menu.update', ['id' => $menu->id])}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" value="{{ $menu->name }}" name="name" type="text" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Description</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="description" required>{{ $menu->description }}</textarea>
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
                                                <th>Calorie</th>
                                                <th>Quantity</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(item, x) in menu_items" class="gradeX">
                                                <td>@{{ x+1 }}</td>
                                                <td>
                                                    <a :href="food_ingredient_url + '/' + item.food_ingredient_id" target="_blank">
                                                        @{{ item.food_ingredient_name }}
                                                    </a>
                                                </td>
                                                <td>@{{ item.calorie }}</td>
                                                <td>@{{ item.quantity }}</td>
                                                <td><button type="button" @click="removeItem(x)" class="btn btn-xs btn-warning">Remove</button></td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td></td>
                                                <td>
                                                    <p>@{{ item.food_ingredient_name }} <button type="button" @click="showHidePickFoodIngredient()" class="btn btn-xs btn-info"><em class="fa fa-pencil"></em></button></p>
                                                </td>
                                                <td>@{{ item.calorie }}</td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="item.quantity">
                                                </td>
                                                <td>
                                                    <button @click="addItem()" type="button" class="btn btn-xs btn-primary pull-right">Add Food Ingredient</button>
                                                </td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td colspan="2">
                                                    Total Calorie
                                                </td>
                                                <td colspan="3">@{{ total_calorie }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="menu_items" v-model="JSON.stringify(menu_items)" required>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Nutrition</label>
                                    <div class="col-md-10">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Calorie</th>
                                                <th>Carbohydrate</th>
                                                <th>Protein</th>
                                                <th>Fat</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {% $menuItems = $menu->menuItems %}
                                            {% $calorie = 0 %}
                                            {% $carbohydrate = 0 %}
                                            {% $protein = 0 %}
                                            {% $fat = 0 %}
                                            @foreach($menuItems as $item)
                                                {% $category = $item->foodIngredient->foodIngredientCategory %}
                                                {% $calorie += $category->calorie * $item->quantity %}
                                                {% $carbohydrate += $category->carbohydrate * $item->quantity %}
                                                {% $protein += $category->protein * $item->quantity %}
                                                {% $fat += $category->fat * $item->quantity %}
                                            @endforeach
                                            <tr class="gradeX">
                                                <td>{{ $calorie }} gr</td>
                                                <td>{{ $carbohydrate }} gr</td>
                                                <td>{{ $protein }} gr</td>
                                                <td>{{ $fat }} gr</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
            @include('includes.form_validation_notif')
        </div>
        <div class="my-popup" v-bind:class="{'my-popup-hide':!show_food_ingredient_popup, 'my-popup-show':show_food_ingredient_popup}">
            <div class="col-md-12">
                <h4>Choose Food Ingredient <a class="btn btn-xs pull-right" @click="showHidePickFoodIngredient()"><em class="fa fa-remove"></em></a></h4>
            </div>
            <table class="table table-bordered table-striped data-table-popup">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Weight</th>
                    <th>Calorie</th>
                    <th>Carbohydrate</th>
                    <th>Protein</th>
                    <th>Fat</th>
                    <th>URT</th>
                </tr>
                </thead>
                <tbody>
                @foreach($food_ingredients as $ingredient)
                    <tr class="gradeX">
                        <td>{{ $ingredient->id }}</td>
                        {% $cat = $ingredient->foodIngredientCategory %}
                        {% $param['id'] = $ingredient->id %}
                        {% $param['name'] = $ingredient->name %}
                        {% $param['calorie'] = $cat->calorie %}
                        <td>
                            <a href="javascript:void(0)" @click="pickFoodIngredient('{{ json_encode($param) }}')">
                                {{ $ingredient->foodIngredientCategory->name }}
                            </a>
                        </td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->weight }}</td>
                        <td>@if($cat->calorie) {{ $cat->calorie }} @else - @endif</td>
                        <td>@if($cat->carbohydrate) {{ $cat->carbohydrate }} @else - @endif</td>
                        <td>@if($cat->protein) {{ $cat->protein }} @else - @endif</td>
                        <td>@if($cat->fat) {{ $cat->fat }} @else - @endif</td>
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
    <script>
        $(function () {
            $('.data-table-popup').DataTable({
                lengthMenu: [5]
            });
        });
    </script>
    @include('manage.menu.scripts.edit')
@endsection