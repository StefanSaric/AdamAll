<!DOCTYPE html>
<html lang="en">
<head>
    <title>Boostbox - Locked</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->

    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{ asset("/assets/css/theme-default/bootstrap.css?1403937764") }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset("/assets/css/theme-default/boostbox.css?1403937765")}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset("/assets/css/theme-default/boostbox_responsive.css?1403937765")}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset("/assets/css/theme-default/font-awesome.min.css?1401481653")}}" />
    <!-- END STYLESHEETS -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset("/assets/js/libs/utils/html5shiv.js?1401481649")}}"></script>
    <script type="text/javascript" src="{{ asset("/assets/js/libs/utils/respond.min.js?1401481651")}}"></script>
    <![endif]-->
</head>
<body class="body-dark">
<!-- START LOGIN BOX -->
<div class="box-type-login">
    <div class="box text-center">
        <div class="box-head">
            <h2 class="text-light text-white">Boost<strong>Box</strong> <i class="fa fa-rocket fa-fw"></i></h2>
            <h4 class="text-light text-inverse-alt">Ease your output with BoostBox</h4>
        </div>
        <div class="box-body box-centered style-inverse">
            <h2 class="text-light">Sign in to your account</h2>
            <br/>
            <form method="POST" action="{{ url('postlogin') }}">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 text-left">
                        <div data-toggle="buttons">
                            <label class="btn checkbox-inline btn-checkbox-primary-inverse">
                                <input type="checkbox" value="default-inverse1"> Remember me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                    </div>
                </div>
            </form>
        </div><!--end .box-body -->
        <div class="box-footer force-padding text-white">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
</div>
<!-- END LOGIN BOX -->

<!-- BEGIN JAVASCRIPT -->
<script src="{{ asset("/assets/js/libs/jquery/jquery-1.11.0.min.js")}}"></script>
<script src="{{ asset("/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js")}}"></script>
<script src="{{ asset("/assets/js/core/BootstrapFixed.js")}}"></script>
<script src="{{ asset("/assets/js/libs/bootstrap/bootstrap.min.js")}}"></script>
<script src="{{ asset("/assets/js/libs/spin.js/spin.min.js")}}"></script>
<script src="{{ asset("/assets/js/libs/slimscroll/jquery.slimscroll.min.js")}}"></script>
<script src="{{ asset("/assets/js/core/App.js")}}"></script>
<script src="{{ asset("/assets/js/core/demo/Demo.js")}}"></script>
<!-- END JAVASCRIPT -->

</body>
</html>
