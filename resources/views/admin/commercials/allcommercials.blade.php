@extends('admin.dash')

@section('pageCss')
    <style>
        #activeImportant:hover{
            cursor: default !important;
        }
    </style>
@stop

@section('content')
    @if(Session::has('message'))
        <input id="message" type="hidden" value="{{ Session::get('message') }}" />
    @endif

    <section>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('admin/home'); ?>">Admin</a></li>
            <li class="active">Reklame</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> Reklame <small>Dodaj/Uredi</small></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light">Tabela sa svim Reklamama</h4></header>
                        </div>
                        <div id="buildingTable" class="box-body table-responsive">
                            {!! Form::open(array('method' => 'DELETE', 'id' => 'commercialsForm', 'role' => 'form')) !!}
                            {!! Form::submit(null, ['id' => 'newsButton', 'class' => 'btn btn-primary createEditButton', 'style' => 'display: none;']) !!}
                            {!! Form::close() !!}
                            <table id="datatable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;#</th>
                                    <th>Slika</th>
                                    <th>Tag slike</th>
                                    <th>Naslov</th>
                                    <th>Link</th>
                                    <th>Tekst</th>
                                    <th style="min-width: 85px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($commercials as $num => $commercial)
                                    <tr id="{{ $commercial->id }}" class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;{{ $num + 1 }}</td>
                                        <td>{{ $commercial->image }}</td>
                                        <td>{{ $commercial->image_tag}}</td>
                                        <td>{{ $commercial->title }}</td>
                                        <td>{{ $commercial->link}}</td>
                                        <td>{{ $commercial->text}}</td>
                                        <td>
                                            <a href="{{ url('admin\commercials\\'.$commercial->id.'\edit') }}" class="btn btn-xs btn-success editCommercial" data-toggle="tooltip" data-placement="top" data-original-title="Uredi Reklamu"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('admin/commercials/delete/'.$commercial->id)}}" class="btn btn-xs btn-danger deleteCommercial" data-toggle="tooltip" data-placement="top" data-original-title="Obriši Reklamu"><i class="fa fa-trash-o"></i></a>
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
    <script src="{{ asset('/assets/js/news.js') }}"></script>

@stop
