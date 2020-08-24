@extends('admin.dash')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/select2/select2.css')}}"/>
@stop

@section('content')
    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin/home'); ?>">Admin</a></li>
            <li class="active">{{__('Edit Role')}}</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> {{__('Forma za editovanje Rola')}}</h3>
        </div>
        <div class="section-body">
            <div class="row">

                <!-- START HORIZONTAL BORDERED FORM -->
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light"></h4></header>
                        </div>
                        <div class="box-body no-padding">
                            {!! Form::model($role, array('method' => 'PATCH', 'url' => 'admin/roles/'.$role->id, 'class' => 'form-horizontal form-bordered form-validate', 'role' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
                            @include('admin.forms.roles', ['submit' => 'Edit'])
                            {!! Form::close() !!}
                            @include('admin.forms.error')
                        </div>
                    </div>
                </div>
                <!-- END HORIZONTAL BORDERED FORM -->

            </div>
        </div>
    </section>
@stop
