@extends('layout.main')
@section('page-title')
    Pregled prodaje jela sa jelovnika
@stop
@section('content')

    <div class="container">
        <div class="row">

            <div class="container">
                <h4>
                    Prodaja jela iz jelovnika
                    @if($fromDate != null)
                        u periodu od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}
                    @endif
                    @if(count($data) > 0)

                    @endif
                </h4>

            </div>


        </div>
    </div>
                <svg class="graph" width="100%" height="300px" preserveAspectRatio="false"></svg>

    <div><div  class="green"></div>Online narudzbine</div>
    <div><div class="blue"></div>Offline narudzbine</div>

            <script src="https://fastcdn.org/D3.js/3.5.6/d3.min.js"></script>

            <script>

                window.onload = () => {
                    let graphData = {{json_encode($data)}};
                    graphData.forEach(d => {
                        d.online_no = parseInt(d.online_no);
                        d.offline_no = parseInt(d.offline_no);
                    });
                    console.log("data", graphData);





                    let graphElement = document.querySelector('.graph');
                    let width = graphElement.width.baseVal.value,
                        height = graphElement.height.baseVal.value;
                    width = width - 100;
                    height = height - 2 * 10;


                    let fullHeight = graphData.length * 100;


                    let y = d3.scale.ordinal()
                        .rangeRoundBands([0, fullHeight - 30], .1).domain(graphData.map(d => d.name));


                    let maxValue = d3.max(graphData, d => d.online_no + d.offline_no);
                    let x = d3.scale.linear()
                        .domain([0, maxValue])
                        .range([0, width]);


                    let chart = d3.select(".graph").attr("height", fullHeight + 'px');

                    chart = chart.append("g").attr("transform", "translate(100, 10)");
                    let bar = chart.selectAll("g")
                        .data(graphData)
                        .enter().append("g")
                        .attr("transform", (d, i) => "translate(0, " + y(d.name) + ")");

                    let bars = bar.append("rect")
                        .attr("x", 0).attr("y", 0)
                        .attr("height", y.rangeBand())
                        .attr("width", d => x(d.offline_no))
                        .attr("class", "offline");

                    bar.append("rect")
                        .attr("x", d => x(d.offline_no))
                        .attr("y", 0)
                        .attr("height", y.rangeBand())
                        .attr("width", d => x(d.online_no))
                        .attr("class", "online");
                    let xAxis = d3.svg.axis()
                            .scale(x)
                            .orient("bottom").ticks(10);

                    chart.append("g")
                        .attr("class", "x axis")
                        .attr("transform", "translate(0," +  (fullHeight - 30) + ")")
                        .call(xAxis)
                        .selectAll("text")
                        .attr("y", 5)
                        .attr("x", 9)
                        .attr("dy", ".35em")
                        .style("text-anchor", "start");


                    let yAxis = d3.svg.axis()
                        .scale(y)
                        .orient("left")
                        .ticks(10);

                    chart.append("g")
                        .attr("class", "y axis")
                        .call(yAxis);


                };
            </script>

            <style>


                .green {
                    background-color: green;
                    width: 15px;
                    float: left;
                }

                .blue {
                    width: 15px;
                    background-color: steelblue;
                    float: left;
                }

                .green::before{
                    content: "\200B";
                }

                .blue::before{
                    content: "\200B";
                }
                .graph rect.online {
                    fill: green;
                }


                .graph rect.offline {
                    fill: steelblue;
                }

                rect:hover{
                    opacity: .3;
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


            </style>


@stop