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
            <li class="active">Najcitanije Vesti</li>
        </ol>
        <div class="section-header">
            <h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> Vesti <small>Dodaj/Uredi</small></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-outlined">
                        <div class="box-head">
                            <header><h4 class="text-light">Tabela sa svim Vestima</h4></header>
                        </div>
                        <div id="buildingTable" class="box-body table-responsive">
                            {!! Form::open(array('method' => 'DELETE', 'id' => 'newsForm', 'role' => 'form')) !!}
                            {!! Form::submit(null, ['id' => 'newsButton', 'class' => 'btn btn-primary createEditButton', 'style' => 'display: none;']) !!}
                            {!! Form::close() !!}
                            <table id="datatable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;#</th>
                                    <th>Slika</th>
                                    <th>Naslov</th>
                                    <th>Tekst</th>
                                    <th>Link ka Postu</th>
                                    <th style="min-width: 85px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $num => $one_news)
                                    <tr id="{{ $one_news->id }}" class="gradeX">
                                        <td>{{ $num + 1 }}</td>
                                        <td><img src="{{asset($one_news->image)}}" height="150" width="150"></td>
                                        <td>{{ $one_news->title }}</td>
                                        <td>{{ $one_news->text }}</td>
                                        <td>{{ $one_news->post_link}}</td>
                                        <td>
                                            <a href="{{ url('admin\news\\'.$one_news->id.'\edit') }}" class="btn btn-xs btn-success editNews" data-toggle="tooltip" data-placement="top" data-original-title="Uredi Vest"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('admin/news/delete/'.$one_news->id)}}" class="btn btn-xs btn-danger deleteNews" data-toggle="tooltip" data-placement="top" data-original-title="Obriši Vest"><i class="fa fa-trash-o"></i></a>
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

@stop
