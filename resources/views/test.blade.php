@extends('layouts.app')

@section('content')
    <div id="content">
        <section>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                    <h2 style="text-align: center">Welcome</h2>
                    @if(Auth::user())
                        <p style="text-align: center">{{Auth::user()->name}}</p>
                    @endif

                </div>
                </div>
            </div>
        </section>
    </div>
@stop
