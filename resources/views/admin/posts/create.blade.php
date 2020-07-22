@extends('admin.dash')
@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/wysihtml5/wysihtml5.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/wysihtml5/bootstrap-wysihtml5.css')}}"/>
@stop
@section('content')
    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin/home'); ?>">Admin</a></li>
            <li class="active">Dodaj Post</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> Forma za dodavanje Postova</h3>
        </div>
        <div class="section-body">
            <div class="row">

                <!-- START HORIZONTAL BORDERED FORM -->
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light">Dodaj Post:</h4></header>
                        </div>
                        <div class="box-body no-padding">
                            {!! Form::open(array('method' => 'POST', 'url' => 'admin/posts', 'id' => 'fileupload', 'class' => 'form-horizontal form-bordered form-validate', 'role' => 'form', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                            @include('admin.forms.posts', ['submit' => 'Dodaj'])
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
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/additional-methods.js') }}"></script>

    <script src="{{ asset('assets/js/admin/posts.js') }}"></script>
    <script src="{{ asset('assets/js/admin/category.js') }}"></script>
    <script src="{{ asset('assets/js/libs/wysihtml5/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('assets/js/libs/wysihtml5/bootstrap-wysigtml5.js') }}"></script>
    <script>
        $("#wysiwyg").wysihtml5();
    </script>

@stop
