@extends('layouts.app')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dashboardPower.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/jquery-ui-boostbox.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/libs/fullcalendar/fullcalendar.css')}}"/>

@stop

@section('content')
    @if(Session::has('message'))
        <input id="message" type="hidden" value="{{ Session::get('message') }}" />
    @endif

    <section>
        <ol class="breadcrumb">
            <li>AdamAll</li><li><a href="{{URL('/admin/home')}}">{{__('Admin Page')}}</a></li>
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
                        <li><a href="{{ url('\site') }}"> Adamall</a></li>
                    </ul>
                </div>
            </div>
        </div><!--end .section-body -->
    </section>

@stop
