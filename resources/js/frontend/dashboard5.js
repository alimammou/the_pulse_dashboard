(function () {
    XonBoard.FifthDashboard = {
        list: {


            init: function () {
                $.get(`/social-media-frequency`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count,
                                name:['Count']
                            }],
                            chart: {
                                height: 350,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                }
                            },
                            colors:['#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    return val+'%'
                                },
                            },
                            legend: {
                                markers: {
                                    width: 10,
                                    height: 10,
                                    radius: 10,
                                },
                                horizontalAlign: 'left',
                                show: false,
                                onItemHover: {
                                    highlightDataSeries: true
                                },
                                onItemClick: {
                                    toggleDataSeries: true
                                },
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        //  colors: ['#E6EDF7'],
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                                marker: {
                                    show: true,
                                },
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                    var d=result.list

                                    return '<div class="tip_div" style=\"color: #0a2d2a; z-index: 999;\"><p class="tip">' +
                                        series[seriesIndex][dataPointIndex]+
                                        '%</p></div>';
                                },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: true,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#frequency-chart"), options);
                        chart.render()
                    });
                $.get(`/social-media-presence`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count,
                                name:['Count']
                            }],
                            chart: {
                                height: 350,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                }
                            },
                            colors:['#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    return val+'%'
                                },
                            },
                            legend: {
                                markers: {
                                    width: 10,
                                    height: 10,
                                    radius: 10,
                                },
                                horizontalAlign: 'left',
                                show: false,
                                onItemHover: {
                                    highlightDataSeries: true
                                },
                                onItemClick: {
                                    toggleDataSeries: true
                                },
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        //  colors: ['#E6EDF7'],
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                                marker: {
                                    show: true,
                                },
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                    var d=result.list

                                    return '<div class="tip_div" style=\"color: #0a2d2a; z-index: 999;\"><p class="tip">' +
                                        series[seriesIndex][dataPointIndex]+
                                        '%</p></div>';
                                },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: true,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#presence-chart"), options);
                        chart.render()
                    });
                $.get(`/social-media-score`)
                    .done(function (result) {
                        var options = {
                                series: [{
                                    name: ['Overall Score'],
                                    data: result.first
                                },
                                    {
                                        name: ['Activity Score'],
                                        data: result.second
                                    },
                                    {
                                        name: ['Popularity Score'],
                                        data: result.third
                                    }
                                ],
                            chart: {
                                height: 4000,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: true,

                                }
                            },
                            colors:['#b7e1cb','#92d3b0','#6dc495'],
                            dataLabels: {
                                enabled: false,
                                formatter: function (val, opts) {
                                    return val+'%'
                                },
                            },
                            legend: {
                                markers: {
                                    width: 10,
                                    height: 10,
                                    radius: 10,
                                },
                                horizontalAlign: 'left',
                                show: true,
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        //  colors: ['#E6EDF7'],
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                                marker: {
                                    show: true,
                                },
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                    var d=result.list

                                    return '<div class="tip_div" style=\"color: #0a2d2a; z-index: 999;\"><p class="tip">' +
                                        series[seriesIndex][dataPointIndex]+
                                        '</p></div>';
                                },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: true,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#score-chart"), options);
                        chart.render()
                    });
            }
        },

    }
})();

