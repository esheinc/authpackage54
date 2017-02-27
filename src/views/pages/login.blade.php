@extends('AuthView::master')

@section('head-addon')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ url('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('content')
<!-- BEGIN LOGIN -->
<div class="content hidden">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ route('login.post') }}"" method="post">
    {{ csrf_field() }}
        <h3 class="form-title font-green">Sign In</h3>
       
       @if(count($errors) > 0)
        <div class="alert alert-danger dismissable fade in">
            @foreach($errors->all() as $e)
               {{ $e }}
            @endforeach
        </div>
        @endif

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /></div>
        <div class="form-actions">
            <input type="submit" class="btn green uppercase" id="loginBtn" value="Login" disabled="true">
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />Remember
                <span></span>
            </label>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
@endsection
@section('scripts-addon')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('assets/pages/scripts/login.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
@endsection
