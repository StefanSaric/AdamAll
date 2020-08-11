@extends('admin.dash')

@section('pageCss')
@stop

@section('content')
    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin/home'); ?>">Admin</a></li>
            <li class="active">{{__('Edit Ads')}}</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> {{__('Form for editing Ads')}}</h3>
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
                            {!! Form::model($ad, array('method' => 'PATCH', 'url' => 'admin/ads/'.$ad->id, 'class' => 'form-horizontal form-bordered form-validate', 'role' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
                            @include('admin.forms.ads', ['submit' => 'Edit'])
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


@section('pageScripts')
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery-validation/dist/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/admin/ads.image.js') }}"></script>
@stop

