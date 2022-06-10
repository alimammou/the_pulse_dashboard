(function () {
    XonBoard.ForthDashboard = {
        list: {


            init: function () {
                $.get(`/fb-likes`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count,
                                name:['Count']
                            }],
                            chart: {
                                height: 2000,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    distributed: true,
                                    horizontal: true,

                                }
                            },
                            colors:['#dbf0e5','#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            dataLabels: {
                                enabled: false
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
                                        '</p></div>';
                                },
                                // fixed: {
                                //     enabled: true,
                                //     position: 'topRight',
                                //     offsetX: 0,
                                //     offsetY: 0,
                                // },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: false,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#fb-likes"), options);
                        chart.render()
                    });
                $.get(`/insta-followers`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count,
                                name:['Count']
                            }],
                            chart: {
                                height: 2000,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    distributed: true,
                                    horizontal: true,

                                }
                            },
                            colors:['#dbf0e5','#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            dataLabels: {
                                enabled: false
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
                                        '</p></div>';
                                },
                                // fixed: {
                                //     enabled: true,
                                //     position: 'topRight',
                                //     offsetX: 0,
                                //     offsetY: 0,
                                // },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: false,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#insta-followers"), options);
                        chart.render()
                    });
                $.get(`/twitter-followers`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count,
                                name:['Count']
                            }],
                            chart: {
                                height: 2000,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        // console.log(chart, w, e)
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    distributed: true,
                                    horizontal: true,

                                }
                            },
                            colors:['#dbf0e5','#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            dataLabels: {
                                enabled: false
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
                                        '</p></div>';
                                },
                                // fixed: {
                                //     enabled: true,
                                //     position: 'topRight',
                                //     offsetX: 0,
                                //     offsetY: 0,
                                // },
                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: false,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };
                        var isRendered = false;
                        var chart = new ApexCharts(document.querySelector("#twitter-followers"), options);
                        chart.render()
                    });
            }
        },

    }
})();

