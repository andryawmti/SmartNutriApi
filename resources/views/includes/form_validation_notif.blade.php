@if($errors->all())
    <style>
        #form-validation-notif {
            position: fixed;
            top: 50%;
            width: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    </style>
    <div id="form-validation-notif" class="alert alert-danger alert-dismissible fade show">
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul style="margin:0;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif