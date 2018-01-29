 @extends('layout.main')
@section('page-title')
	
@stop
@section('content')
	
	<div class="container">
		<h5>
			{{$title}} 
			@if($fromDate != null)
				 u periodu od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}
			@endif
			@if(count($modelData) > 0)
			<span style="float: right; cursor: pointer; margin-left: 10px;" title="Kreiraj Excel dokumet"> 
				<a  href="{{ action( 'ProcurementController@downloadExcelDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'supplierId' => $supplier->id)) }}" >
					<i class="fa fa-file-excel-o default-green"></i>
				</a>
			</span>
			<span style="float: right; cursor: pointer;" title="Kreiraj PDF dokumet">
				<a  href="{{ action( 'ProcurementController@downloadPDFDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'supplierId' => $supplier->id) ) }}" >
					<i class="fa fa-file-pdf-o default-red"></i>
				</a>
			</span>
			@endif
		</h5>
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

	