@extends('layout.main')
@section('page-title')
	
@stop
@section('content')
	
	<div class="container">
		<h4>
			{{$title}} 
			@if($modelData != null)
				 u periodu od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}
			@endif
			@if(count($modelData) > 0)
			<span style="float: right; cursor: pointer;" title="Kreiraj Excel dokumet"> 
				<a  href="{{ action( 'FinancialReportController@downloadExcelDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType) ) }}" >
					<i class="fa fa-file-excel-o default-green"></i> 
				</a>
			</span>
			<span style="float: right; cursor: pointer; margin: 0px 10px;" title="Prikaži graph">
				<a  href="{{ action( 'FinancialReportController@plotGraph', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType, 'title' => $title) ) }}" >
					<i class="fa fa-bar-chart default-blue"></i>
				</a>
			</span>
			@endif
		</h4>
		<div>
			<canvas id="firstPieChart" height="100px"></canvas>
			<canvas id="secondPieChart" height="100px"></canvas>
		</div>

		<div>
			<canvas id="thirdPieChart" height="100px"></canvas>
		</div>
	</div>

	{{HTML::script('mdbootstrap/js/mdb.min.js')}}
	{{HTML::style('mdbootstrap/css/mdb.min.css')}}

	<script>
	    
	    var modelData = {{json_encode($modelData)}};

	    var firstPieData = {};
	    var secondPieData = {};
	    var thridPieData = {};

	    modelData.forEach(function(item) {
	    	var type = item.info.toLowerCase();
	        if (type == 'plata' || type == 'nabavka namirnica' || type == 'nabavka inventara') {
	        	firstPieData[item.info] = firstPieData[item.info] || 0;
	        	firstPieData[item.info] += parseFloat(item.total);

	        	thridPieData['Rashod'] = thridPieData['Rashod'] || 0;
	        	thridPieData['Rashod'] += parseFloat(item.total);
	        } else {
	        	secondPieData[item.info] = secondPieData[item.info] || 0;
	        	secondPieData[item.info] += parseFloat(item.total);

	        	thridPieData['Prihod'] = thridPieData['Prihod'] || 0;
	        	thridPieData['Prihod'] += parseFloat(item.total);
	        }
	    });
	    
	  	if (Object.keys(firstPieData).length > 0) {
	  		var backgroundColors = ["#E51414", "#F57D21", "#7254BD"];
	  		var hoverBackgroundColors = ["#F24444", "#FF9A4D", "#9379D4"];
	  		createPie("firstPieChart", firstPieData, backgroundColors, hoverBackgroundColors);
	  	}

	  	if (Object.keys(secondPieData).length > 0) {
	  		var backgroundColors = ["#3D87CF", "#38B247"];
	  		var hoverBackgroundColors = ["#609FDC", "#59C867"];
	  		createPie("secondPieChart", secondPieData, backgroundColors, hoverBackgroundColors);
	  	}

	  	if (Object.keys(firstPieData).length > 0 && Object.keys(secondPieData).length > 0) {
	  		var hoverBackgroundColors = ["#609FDC", "#F24444"];
	  		var backgroundColors = ["#3D87CF", "#E51414"];
	  		createPie("thirdPieChart", thridPieData, backgroundColors, hoverBackgroundColors);
	  	}

	    function createPie(elementId, data, backgroundColors, hoverBackgroundColors) {
	    	var ctxP = document.getElementById(elementId).getContext('2d');
		    var myPieChart = new Chart(ctxP, {
		        type: 'pie',
		        data: {
		            labels: Object.keys(data),
		            datasets: [
		                {
		                    data: Object.values(data),
		                    backgroundColor: backgroundColors,
		                    hoverBackgroundColor: hoverBackgroundColors
		                }
		            ]
		        },
		        options: {
		            responsive: true
		        }    
	    	});
		}
	</script>

	

@stop