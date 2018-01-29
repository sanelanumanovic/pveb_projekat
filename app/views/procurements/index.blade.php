@extends('layout.main')
@section('page-title')
	Pregled nabavki
@stop
@section('content')
	<div class="container">
    	<div class="row">
    		<div class="col-6 col-md-3 margin-bottom-10">
    			Dobavljač
    		</div>

    		
    		<div class="col-12 col-md-9 margin-bottom-10">
    			{{Form::open(array('action' => 'ProcurementController@procurementsBySupplierAndDate'))}} 
    			{{Form::select('supplierId', $suppliers, null, array('class' => 'select-field'))}}
    		</div>

    		@include('layout.timeFilter')
			<div class="col-6 col-md-9 float-right text-danger">
				{{$message or ''}}
			</div>

			<div class="col-6 col-md-3">
			</div>

			<div class="col-6 col-md-9">
			</div>

			<div class="col-6 col-md-3">
				<button class="btn btn-success btn-block" type="submit">Prikaži nabavke</button>
			</div>

			{{Form::close()}} 

	</div>

	{{HTML::script('js/financies.js')}}
@stop