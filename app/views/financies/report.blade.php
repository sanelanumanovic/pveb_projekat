@extends('layout.main')
@section('page-title')
	
@stop
@section('content')
	
	<div class="container">
		<h4>
			{{$title}} od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}
			@if(count($modelData) > 0)
			<span style="float: right; cursor: pointer;" title="Kreiraj Excel dokumet"> 
				<a  href="{{ action( 'FinancialReportController@downloadExcelDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType) ) }}" >
					<i class="fa fa-file-excel-o default-color"></i>
				</a>
			</span>
			<span style="float: right; cursor: pointer;" title="Prikazi graph">
				<a  href="{{ action( 'FinancialReportController@plotGraph', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType, 'title' => $title) ) }}" >
					<i class="fa fa-align-center"></i>
				</a>
			</span>
			@endif
		</h4>
		@if(count($modelData) == 0)
			<p> {{$emptyResult}} </p>
		@else
    	<table class="table">
		    <thead>
		    	<tr>
			        <th>Tip</th>
			        <th>ID</th>
			        <th>Datum</th>
			        <th>Iznos</th>
		      	</tr>
		    </thead>
		    <tbody>
		    	@foreach($modelData as $d)  
		    	<tr>
			        <td>{{$d->info}}</td>
			        <td>{{$d->id}}</td>
			        <td>{{date('d.m.Y.', strtotime($d->date))}}</td>
			        <td align="right">{{number_format($d->total, 2)}}</td>
		      	</tr>
		      	@endforeach
	        </tbody>
        </table>
        @endif
	</div>
@stop

	