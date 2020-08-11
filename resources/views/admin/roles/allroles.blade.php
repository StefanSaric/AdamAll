@extends('admin.dash')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme-default/libs/multi-select/multi-select.css')}}"/>
@stop
@section('content')
    @if(Session::has('message'))
        <input id="message" type="hidden" value="{{ Session::get('message') }}" />
    @endif

    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin'); ?>">Admin</a></li>
            <li class="active">{{__('Roles')}}</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> {{__('Roles')}} <small>{{__('Add/Edit')}}</small></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light"></h4></header>
                        </div>
                        <div id="buildingTable" class="box-body table-responsive">
                            {!! Form::open(array('method' => 'DELETE', 'id' => 'userForm', 'role' => 'form')) !!}
                            {!! Form::submit(null, ['id' => 'userButton', 'class' => 'btn btn-primary createEditButton', 'style' => 'display: none;']) !!}
                            {!! Form::close() !!}
                            <input type='hidden' id='confirmQuestion' value='{{__('Are you sure that you want to delete this official?')}}'/>
                            <table id="datatable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;#</th>
                                    <th>{{__('Name')}}</th>
                                    <th style="min-width: 85px">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $num => $role)
                                    <tr id="{{ $role->id }}" class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;{{ $num + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-success editUser" data-toggle="tooltip" data-placement="top" data-original-title="{{__('Edit official')}}"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-xs btn-danger deleteUser" data-toggle="tooltip" data-placement="top" data-original-title="{{__('Delete official')}}"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!--end .box-body -->
                    </div><!--end .box -->
                </div><!--end .col-lg-12 -->
            </div>
            <!-- END STRIPED TABLE -->
        </div>
    </section>
@stop

@section('pageScripts')
    <script src="{{ asset('/assets/js/libs/DataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/js/admin/users.js') }}"></script>

@stop
