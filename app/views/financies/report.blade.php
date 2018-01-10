@extends('layout.main')
@section('page-title')
	
@stop
@section('content')
	
	<div class="container">
		<h4>
			{{$title}} od {{$fromDate}} do {{$toDate}}
			<span style="float: right; cursor: pointer;" title="Kreiraj Excel dokumet"> 
				<a  href="{{ action( 'FinancialReportController@downloadExcelDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType) ) }}" >
					<i class="fa fa-file-excel-o default-color"></i> 
				</a>
			</span>
		</h4>
    	<table class="table">
		    <thead>
		    	<tr>
			        <th>Tip</th>
			        <th>ID</th>
			        <th>Datum</th>
			        <th align="center">Iznos</th>
		      	</tr>
		    </thead>
		    <tbody>
		    	@foreach($modelData as $d)  
		    	<tr>
			        <td>{{$d->info}}</td>
			        <td>{{$d->id}}</td>
			        <td>{{$d->date}}</td>
			        <td align="right">{{$d->total}}</td>
		      	</tr>
		      	@endforeach
	        </tbody>
        </table>

	</div>
@stop

	