@extends('layouts.appv2')

@section('page_title')
    Show Consultation
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
                Show Consultation
                <ol class="breadcrumb breadcrumb px-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('consultation.index') }}">Consultation</a>
                    </li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <!-- DATATABLE DEMO 1-->
            <div class="card card-default" role="tabpanel">
                <div class="card-header"><h4>Show Consultation</h4></div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="#">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">User</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->user->first_name }} {{ $consultation->user->last_name }}" name="user" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Weight</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->weight }} cm" name="weight" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Bed Time</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->bed_time }} hour(s)" name="bed_time" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Activity</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->activity }}%" name="activity" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Pregnancy Age</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->pregnancy_age }} week" name="pregnancy_age" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Calorie Need</label>
                                <div class="col-md-10">
                                    <input class="form-control" value="{{ $consultation->calorie_need }} KKal" name="calorie_need" type="text" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Menu Suggestion</label>
                                <div class="col-md-10">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Calorie</th>
                                            <th>Carbohydrate</th>
                                            <th>Protein</th>
                                            <th>Fat</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {% $totalCalorie = 0 %}
                                        {% $totalCarbohydrate = 0 %}
                                        {% $totalProtein = 0 %}
                                        {% $totalFat = 0 %}
                                        @foreach($consultation->menuSuggestion as $x => $m)
                                            <tr class="gradeX">
                                                <td>{{ $x+1 }}</td>
                                                <td>{{ $m->menu->name }}</td>

                                                {% $menuItems = $m->menu->menuItems %}
                                                {% $calorie = 0 %}
                                                {% $carbohydrate = 0 %}
                                                {% $protein = 0 %}
                                                {% $fat = 0 %}
                                                @foreach($menuItems as $item)
                                                    {% $category = $item->foodIngredient->foodIngredientCategory %}
                                                    {% $calorie += $category->calorie %}
                                                    {% $carbohydrate += $category->carbohydrate %}
                                                    {% $protein += $category->protein %}
                                                    {% $fat += $category->fat %}
                                                @endforeach

                                                <td>{{ $calorie }} gr</td>
                                                <td>{{ $carbohydrate }} gr</td>
                                                <td>{{ $protein }} gr</td>
                                                <td>{{ $fat }} gr</td>
                                            </tr>
                                            {% $totalCalorie += $calorie  %}
                                            {% $totalCarbohydrate += $carbohydrate %}
                                            {% $totalProtein += $protein %}
                                            {% $totalFat += $fat %}
                                        @endforeach
                                        <tr class="gradeX">
                                            <td></td>
                                            <td>
                                                Total
                                            </td>
                                            <td>{{ $totalCalorie }} gr</td>
                                            <td>{{ $totalCarbohydrate }} gr</td>
                                            <td>{{ $totalProtein }} gr</td>
                                            <td>{{ $totalFat }} gr</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
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
@endsection