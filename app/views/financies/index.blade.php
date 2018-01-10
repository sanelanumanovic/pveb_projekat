@extends('layout.main')
@section('page-title')
	Kreiranje finansijskog izveštaja
@stop
@section('content')
	<div class="container">
    	<div class="row">
    		<div class="col-6 col-md-3">
    			Tip izveštaja
    		</div>

    		
    		<div class="col-12 col-md-9">
    		{{ Form:: open(array('action' => 'FinancialReportController@generateReport')) }} 
    			{{ Form::radio('reportType', '1', true) }}
    			{{Form::label('prihod')}}
    			<br>
				{{ Form::radio('reportType', '2') }}
				{{Form::label('rashod')}}
				<br>
				{{ Form::radio('reportType', '3') }}
				{{Form::label('sve')}}
    		</div>

    		<div class="col-6 col-md-3">
    			Period: 
    		</div>

			<div class="col-12 col-md-9">
				{{ Form::input('date', 'fromDate') }}
				{{Form::label('-')}}
				{{ Form::input('date', 'toDate') }}
			</div>

			<div class="col-6 col-md-9">
			</div>

			<div class="col-6 col-md-3">
				<button class="btn btn-success btn-block" type="submit">Kreiraj izveštaj</button>
			</div>

			{{ Form:: close() }} 
	</div>

@stop