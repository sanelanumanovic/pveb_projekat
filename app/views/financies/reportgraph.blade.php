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
			@endif
		</h4>

	</div>

	<script>

		var data = {{json_encode($modelData)}};

		console.log(data);
	</script>
@stop

	