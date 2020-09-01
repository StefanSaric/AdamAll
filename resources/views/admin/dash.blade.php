@extends('layouts.app')

@section('pageCss')
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dashboardPower.css')}}"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/jquery-ui/jquery-ui-boostbox.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-1/libs/fullcalendar/fullcalendar.css')}}"/>

@stop

@section('content')
    @if(Session::has('message'))
        <input id="message" type="hidden" value="{{ Session::get('message') }}" />
    @endif

    <section>
        <ol class="breadcrumb">
            <li>AdamAll</li><li>Dashboard</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i>Dashboard</h3>
        </div>
        <br>
        <div class="section-body">
            <div class="box">
                <div class="box-tiles">
                    <div class='row'>
                        <div class='col-md-10'>
                            <h2>{{__('Welcome to admin page')}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-bordered">
                <div class="box-head">
                    <h3></h3>
                </div>
                <div class="box-body">
                    <ul>
                        <li><a href="{{ url('/') }}"> Adamall</a></li>
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <h2 style="text-align:left;">Logovi</h2>
            <div class="box-bordered">
                <br>
                <ol>
                    <?php if(isset($lines))
                    if(count($lines) >= 5){
                    for($i = count($lines)-1; $i > count($lines)-6;$i--)
                    {
                    echo "<li> $lines[$i]</li>";
                    }
                    }
                    else
                    foreach ($lines as $line)
                    echo "<li> $line</li>"?>
                </ol>
            </div>
        </div><!--end .section-body -->
    </section>

@stop
