@extends('layout.main')
@section('page-title')
    Pregled prodaje jela sa jelovnika
@stop
@section('content')

    <div class="container">

        @foreach($data as $d)

            {{$d->name}}, {{$d->completion_date}}, {{$d->is_online}}<br>
        @endforeach
    </div>

@stop