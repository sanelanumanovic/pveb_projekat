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
            createPie("firstPieChart", firstPieData);
        }

        if (Object.keys(secondPieData).length > 0) {
            createPie("secondPieChart", secondPieData);
        }

        if (Object.keys(firstPieData).length > 0 && Object.keys(secondPieData).length > 0) {
            createPie("thirdPieChart", thridPieData);
        }

        function createPie(elementId, data) {
            var ctxP = document.getElementById(elementId).getContext('2d');
            var myPieChart = new Chart(ctxP, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [
                        {
                            data: Object.values(data),
                            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                        }
                    ]
                },
                options: {
                    responsive: true
                }    
            });
        }