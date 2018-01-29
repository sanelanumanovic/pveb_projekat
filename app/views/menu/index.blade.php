
@extends('layout.main')
@section('page-title')
    Pregled prodaje jela sa jelovnika
@stop
@section('content')

    <div class="container">
        <div class="row">

        <div>

            {{ Form:: open(array('action' => 'MenuController@showGraph')) }}
        </div>


                @include('layout.timeFilter')

            <div class="col-6 col-md-9 float-right text-danger">

            {{$message or ''}}
            </div>
        </div>

        <div class="col-6 col-md-3">
        </div>

        <div class="col-6 col-md-9">
        </div>

        <div class="col-6 col-md-3">
            <button class="btn btn-success btn-block" type="submit">Pregledaj poručena jela</button>
        </div>

        {{ Form:: close() }}
    </div>
    </div>


    {{HTML::script('js/financies.js')}}

@stop