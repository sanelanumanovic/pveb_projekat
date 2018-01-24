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

	<svg class="graph" width="100%" height="300px" preserveAspectRatio="false"></svg>


	<script src="https://fastcdn.org/D3.js/3.5.6/d3.min.js"></script>
	<script>


		var groups = {};
		var data = {{json_encode($modelData)}};
		data.forEach(d => {
		    d.total = parseFloat(d.total);
		    var tip = d.info.toLowerCase();
		    if(tip == 'plata' || tip == 'nabavka namirnica' || tip == 'nabavka inventara'){
		        d.total = -d.total;
			}
		    groups[d.date] = groups[d.date] || {date: d.date, total: 0};
		    groups[d.date].total += d.total;
		});
		var graphData = Object.keys(groups).map(d => {return {date: groups[d].date, total: groups[d].total}});
		console.log("graphData", graphData);
        var graphElement = document.querySelector('.graph');
        var width = graphElement.width.baseVal.value,
            height = graphElement.height.baseVal.value / 2;

        var y = d3.scale.linear()
            .range([-height, height]);

        var chart = d3.select(".graph");
		var maxAbsTotal = d3.max(graphData, d => Math.abs(d.total));
        y.domain([-maxAbsTotal, maxAbsTotal]);

        var barWidth = width / graphData.length;
		console.log("Y: 100", y(100));
        console.log("Y: -100", y(-100));
        var bar = chart.selectAll("g")
            .data(graphData)
            .enter().append("g")
            .attr("transform", function(d, i) { return "translate(" + i * barWidth + ",0)"; });

        var bars = bar.append("rect")
            .attr("y", function(d) { return d.total >= 0 ? height - y(d.total) : height; })
            .attr("height", function(d) { return Math.abs(y(d.total)); })
            .attr("width", barWidth - 1)
			.append("svg:title").text(d => d.date +" = " + d.total);
        bar.append("text")
            .attr("x", 0.2 * barWidth )
            .attr("y", function(d) { return y(d.total) - 20; })
            .attr("dy", ".75em")
            .text(function(d) { return d.total; });

		console.log(data);
	</script>

	<style>

		.graph rect {
			fill: steelblue;
		}

		.graph text {
			fill: white;
			font: 10px sans-serif;
			text-anchor: middle;
		}

	</style>
@stop

	