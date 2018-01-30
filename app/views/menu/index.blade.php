
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
        <div class="row">

            <div class="col-6 col-md-8">
            </div>

            <div class="col-6 col-md-4">
                <button class="btn btn-success btn-block" type="submit">Pregledaj poručena jela</button>
            </div>
        </div>

        {{ Form:: close() }}
    </div>
    </div>


    {{HTML::script('js/financies.js')}}

@stop