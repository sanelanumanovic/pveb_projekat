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
    			{{ Form::radio('timeType', '1', true) }}
    			{{Form::label('Interval')}}
    		</div>

			<div class="col-12 col-md-9">
				<div class="timeType-1">
					{{ Form::input('date', 'fromDate', date('Y-m-d', strtotime('-1 day'))) }}
					{{Form::label('-')}}
					{{ Form::input('date', 'toDate', date('Y-m-d', strtotime('+0 day'))) }}
				</div>
			</div>

			<div class="col-6 col-md-3">
    			{{Form::radio('timeType', '2')}}
    			{{Form::label('Period')}}
    		</div>

			<div class="col-12 col-md-9">
				<div class="timeType-2">
					{{Form::radio('timeSubType', '1', true)}}
	    			{{Form::label('1 mesec')}}
	    			<br>
	    			{{Form::radio('timeSubType', '2')}}
	    			{{Form::label('3 meseca')}}
	    			<br>
	    			{{Form::radio('timeSubType', '3')}}
	    			{{Form::label('6 meseci')}}
	    			<br>
	    			{{Form::radio('timeSubType', '4')}}
	    			{{Form::label('1 godina')}}
    			</div>
			</div>

			<div class="col-6 col-md-3">
    			{{Form::radio('timeType', '3')}}
    			{{Form::label('Godina')}}
    		</div>

			<div class="col-12 col-md-9">
				<div class="timeType-3">
					{{ Form::selectYear('year', 2018, 1990) }}
				</div>
			</div>  

			<div class="col-6 col-md-3">
    			{{Form::radio('timeType', '4')}}
    			{{Form::label('Sve transakcije')}}
    		</div>

			<div class="col-12 col-md-9">
				<div class="timeType-4"></div>
			</div>   		

			<div class="col-6 col-md-9 float-right text-danger">
				{{$message or ''}}
			</div>

			<div class="col-6 col-md-3">
			</div>

			<div class="col-6 col-md-9">
			</div>

			<div class="col-6 col-md-3">
				<button class="btn btn-success btn-block" type="submit">Kreiraj izveštaj</button>
			</div>

			{{ Form:: close() }} 

	</div>

	{{HTML::script('js/financies.js')}}
@stop