@extends('admin.dash')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/multi-select/multi-select.css')}}"/>
@stop

@section('content')
    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin/home'); ?>">Admin</a></li>
            <li class="active">{{__('Add Users')}}</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> {{__('Form for adding User')}}</h3>
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
                            {!! Form::open(array('method' => 'POST', 'url' => 'admin/users', 'id' => 'fileupload', 'class' => 'form-horizontal form-bordered form-validate', 'role' => 'form', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                            @include('admin.forms.users', ['submit' => 'Add'])
                            {!! Form::close() !!}
                            @include('admin.forms.error')
                        </div><!-- end of form group -->
                    </div>
                </div>
                <!-- END HORIZONTAL BORDERED FORM -->

            </div>
        </div>
    </section>
@stop


@section('pageScripts')

    <!-- END FILE UPLOAD TEMPLATES -->
    <script src="{{ asset('/assets/js/libs/DataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/additional-methods.js') }}"></script>

@stop
