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
            <li class="active">Post</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> Postovi <small>Dodaj/Uredi</small></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light">Tabela sa svim Postovima</h4></header>
                        </div>
                        <div id="buildingTable" class="box-body table-responsive">
                            {!! Form::open(array('method' => 'DELETE', 'id' => 'newsForm', 'role' => 'form')) !!}
                            {!! Form::submit(null, ['id' => 'newsButton', 'class' => 'btn btn-primary createEditButton', 'style' => 'display: none;']) !!}
                            {!! Form::close() !!}
                            <table id="datatable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;#</th>
                                    <th>Naslov</th>
                                    <th>Izvor</th>
                                    <th>Link</th>
                                    <th>Tip</th>
                                    <th>Kategorija</th>
                                    <th>Potpis</th>
                                    <th style="min-width: 85px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $num => $one_post)
                                    <tr id="{{ $one_post->id }}" class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;{{ $num + 1 }}</td>
                                        <td>{{ $one_post->title }}</td>
                                        <td>{{ $one_post->source }}</td>
                                        <td>{{ $one_post->link }}</td>
                                        <td>{{ $one_post->type->name}}</td>
                                        <td>{{ $one_post->category->name}}</td>
                                        <td>{{ $one_post->signature }}</td>
                                        <td>
                                            <a href="{{ url('admin\posts\\'.$one_post->id.'\edit') }}" class="btn btn-xs btn-success editPost" data-toggle="tooltip" data-placement="top" data-original-title="Uredi Vest"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('admin/posts/delete/'.$one_post->id)}}" class="btn btn-xs btn-danger deletePost" data-toggle="tooltip" data-placement="top" data-original-title="Obriši Vest"><i class="fa fa-trash-o"></i></a>
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
