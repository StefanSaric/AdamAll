@extends('admin.dash')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/libs/multi-select/multi-select.css')}}"/>
@stop
@section('content')
    @if(Session::has('message'))
        <input id="message" type="hidden" value="{{ Session::get('message') }}" />
    @endif

    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin'); ?>">Admin</a></li>
            <li class="active">{{__('All Users')}}</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> {{__('Users')}} <small>{{__('Add/Edit')}}</small></h3>
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
                                    <th>{{__('E-mail')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th style="min-width: 85px">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $num => $user)
                                    <tr id="{{ $user->id }}" class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;{{ $num + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@foreach($user->roles as $key => $role){{ $role->name }}@if($key != count($user->roles)-1){{','}}@endif @endforeach</td>
                                        <td>
                                            <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-xs btn-success editUser" data-toggle="tooltip" data-placement="top" data-original-title="{{__('Edit User')}}"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('admin/users/delete/'.$user->id)}}" class="btn btn-xs btn-danger deleteUser" data-toggle="tooltip" data-placement="top" data-original-title="{{__('Delete User')}}"><i class="fa fa-trash-o"></i></a>
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
    <script src="{{ asset('/assets/js/datatable.js') }}"></script>
    <script src="{{ asset('/assets/js/users.js') }}"></script>

@stop
