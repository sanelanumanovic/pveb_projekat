@extends('layout.main')
@section('page-title')
	
@stop
@section('content')
	
	<div class="container">
		<h4>
			{{$title}} 
			@if($fromDate != null)
				 u periodu od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}
			@endif
			@if(count($modelData) > 0)
			<span style="float: right; cursor: pointer;" title="Kreiraj Excel dokumet"> 
				<a  href="{{ action( 'FinancialReportController@downloadExcelDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType) ) }}" >
					<i class="fa fa-file-excel-o default-green"></i> 
				</a>
			</span>
			<span style="float: right; cursor: pointer;" title="Kreiraj PDF dokumet">
				<a  href="{{ action( 'FinancialReportController@downloadPDFDocument', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType) ) }}" >
					<i class="fa fa-file-pdf-o default-red"></i>
				</a>
			</span>
			<span style="float: right; cursor: pointer; margin: 0px 10px;" title="Prikaži pie chart">
				<a  href="{{ action( 'FinancialReportController@drawPieChart', array('fromDate' => $fromDate, 'toDate' => $toDate, 'type' => $reportType, 'title' => $title) ) }}" >
					<i class="fa fa-pie-chart default-orange"></i>
				</a>
			</span>
			@endif
		</h4>

	</div>

	<svg class="graph" width="100%" height="300px" preserveAspectRatio="false"></svg>



	<script src="https://fastcdn.org/D3.js/3.5.6/d3.min.js"></script>
	<script>


        let groups = {};
        let data = {{json_encode($modelData)}};
        data.forEach(d => {
            d.total = parseFloat(d.total);
        let type = d.info.toLowerCase();
        if(type == 'plata' || type == 'nabavka namirnica' || type == 'nabavka inventara'){
            d.total = -d.total;
        }
        groups[d.date] = groups[d.date] || 0;
        groups[d.date] += d.total;
        });
        let graphData = Object.keys(groups).sort().map(d => {return {date: d, total: groups[d]}});

        let graphElement = document.querySelector('.graph');
        let width = graphElement.width.baseVal.value,
            height = graphElement.height.baseVal.value / 2;
		width = width - 2 * 10;
		height = height - 2 * 25;
        let x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .1).domain(graphData.map(d => d.date));

        let maxAbsTotal = d3.max(graphData, d => Math.abs(d.total));
        let y = d3.scale.linear()
        .domain([maxAbsTotal, -maxAbsTotal])
		.range([-height, height]);
        let chart = d3.select(".graph");
        let barWidth = width / graphData.length;

		chart = chart.append("g").attr("transform", "translate(10, 25)");
        let bar = chart.selectAll("g")
            .data(graphData)
            .enter().append("g")
            .attr("transform", (d, i) => "translate(" + x(d.date) + ",0)");

        let bars = bar.append("rect")
			.attr("x", d => x(d.name)).attr("y", d => y(d.total) < 0 ? height - Math.abs(y(d.total)) : height)
        .attr("height", d => Math.abs(y(d.total)))
        .attr("width", x.rangeBand())
			.attr("onclick", d=> 'selectDate(this, "' + d.date + '")')
            .append("svg:title").text(d => d.date +" = " + d.total);


        let xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

        chart.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," +  2 * height + ")")
            .call(xAxis)
            .selectAll("text")
            .attr("y", 0)
            .attr("x", 9)
            .attr("dy", ".35em")
            .attr("transform", "rotate(90)")
            .style("text-anchor", "start");


        let yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);

        chart.append("g")
            .attr("class", "y axis")
			.attr("transform", "translate(" + width / 2 + ", " + height + ")")
            .call(yAxis);
        d3.selectAll('y axis > text').attr("transform", "rotate(90, 0)");

		let selectDate = (function() {
		    let selectedElement = null;
            return function(el, date) {
                let dataSelected = data.filter(d => d.date === date);
                let rows = dataSelected.map(data => {
                    return '<tr><td>' + data.info + '</td><td>' + data.id + '</td><td>' + data.date + '</td><td align="right">' + data.total + '</td></tr>';
                });
                let tableDiv = document.querySelector("#selected-date-table");
                tableDiv.querySelector("tbody").innerHTML = rows;
                tableDiv.style.display = 'block';
                if(!!selectedElement){
                    selectedElement.classList.remove('selected-column');
				}
				el.classList.add('selected-column');
                selectedElement = el;

            }
        })()

	</script>

	<style>

		.graph rect {
			fill: steelblue;
		}

		rect:hover{
			opacity: .3;
		}
		.graph rect.selected-column {
			fill: green;
		}
		.graph text {
			fill: white;
			font: 10px sans-serif;
			text-anchor: middle;
		}

		.axis text {
			font: 10px sans-serif;
			fill: #2e3133;
		}

		.axis path,
		.axis line {
			fill: none;
			stroke: #000;
			shape-rendering: crispEdges;
		}
		#selected-date-table {
			display: none;
		}

	</style>



	<div id="selected-date-table">

		<table class="table">
			<thead>
			<tr>
				<th width="40%">Tip</th>
				<th width="20%">ID</th>
				<th width="30%">Datum</th>
				<th width="10%">Iznos</th>
			</tr>
			</thead>
			<tbody>


			</tbody>
		</table>
	</div>
@stop

	