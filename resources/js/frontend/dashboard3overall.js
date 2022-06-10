(function () {
    XonBoard.ThirdDashboard = {
        list: {


            init: function () {
                $.get(`/dashboard3/neutrality`)
                    .done(function (result) {

                        var options = {
                            series: result.count,
                            chart: {
                                type: 'pie',
                                offsetX: 200,
                                offsetY: 0,
                                width:550,
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            tooltip: {
                                enabled: true,
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                    var d=result.list
                                    return '<div class="tip_div" style=\"color: #0a2d2a; z-index: 999; background-color: white;\"><p class="tip">' +
                                        d[seriesIndex]+
                                        '</p></div>';
                                },
                                fixed: {
                                    enabled: true,
                                    position: 'topRight',
                                    offsetX: 0,
                                    offsetY: 0,
                                },
                            },
                            labels:result.type,
                            dataLabels: {

                                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                                    return value.toFixed(0) +'%'                               }
                            },
                            legend: {
                                show:true,
                                position: 'bottom',
                                horizontalAlign: 'center',

                            },
                            colors:['var(--color_1)','var(--color_2)','var(--color_3)'],
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 320
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            },
                                {
                                    breakpoint: 2000,
                                    options: {
                                        chart: {
                                            width: 550,
                                            offsetX: 80,

                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                },
                                {
                                    breakpoint: 1400,
                                    options: {
                                        chart: {
                                            width: 500,
                                            offsetX: -50,
                                            toolbar: {
                                                show: true,
                                                offsetX: -130,
                                                offsetY: 0,
                                            }
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                        };

                        var chart = new ApexCharts(document.querySelector("#neutrality-chart"), options);
                        chart.render();

                    })
                $.get(`/dashboard3/civil-state`)
                    .done(function (result) {

                        var options = {
                            series: result.count,
                            chart: {
                                type: 'pie',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            labels:result.type,
                            dataLabels: {

                                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                                    return value.toFixed(0) +'%'                               }
                            },
                            legend: {
                                show:true,
                                position: 'bottom',
                            },
                            colors:['var(--color_1)','var(--color_2)','var(--color_3)'],
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 320
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#civil-state-chart"), options);
                        chart.render();

                    })
                $.get(`/dashboard3/weapons-opinion`)
                    .done(function (result) {
                        var options = {
                            series: result.count,
                            chart: {
                                width: 1200,
                                offsetX: -100,
                                offsetY: -50,
                                type: 'donut',
                                toolbar: {
                                    show: true,
                                    offsetX: -30,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            tooltip: {
                                enabled: true,
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                    var d=result.list
                                    return '<div class="tip_div" style=\"color: #0a2d2a; z-index: 999; background-color: white;\"><p class="tip">' +
                                        d[seriesIndex]+
                                        '</p></div>';
                                },
                                fixed: {
                                    enabled: true,
                                    position: 'topRight',
                                    offsetX: 0,
                                    offsetY: 0,
                                },
                            },
                            labels:result.type,
                            dataLabels: {

                                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                                    return value.toFixed(0) +'%'                               }
                            },
                            legend: {
                                show: true,
                                position: 'left',
                                offsetY: 250,
                                offsetX: 50,

                                horizontalAlign: 'left',
                                fontWeight: 400,
                                customLegendItems: [],
                                formatter: function(seriesName, opts) {
                                    return [seriesName]
                                },
                                //
                                onItemHover: {
                                    highlightDataSeries: true
                                },
                            },
                            colors:['var(--color_1)','var(--color_2)','var(--color_3)','var(--color_6)','var(--color_7)'],
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 300
                                    },
                                    legend: {
                                        show:false,
                                        position: 'top',
                                        floating: true
                                    }
                                }
                            },
                                {
                                    breakpoint: 2000,
                                    options: {
                                        chart: {
                                            width: 550,
                                            offsetX: 80,
                                            offsetY: 0,

                                            toolbar: {
                                                show: true,
                                                offsetX: 0,
                                                offsetY: 0,
                                            }

                                        },
                                        legend: {
                                            position: 'bottom',
                                            offsetY: 0,
                                            offsetX: 0,
                                        }
                                    }
                                },
                                {
                                    breakpoint: 1400,
                                    options: {
                                        chart: {
                                            width: 500,
                                            offsetX: -50,
                                            offsetY: 60,

                                        },
                                        legend: {
                                            position: 'bottom',

                                            offsetY: 0,
                                            offsetX: 0,
                                        }
                                    }
                                }]
                        };
                        var chart = new ApexCharts(document.querySelector("#weapons-chart"), options);
                        chart.render();
                    });
                $.get(`/dashboard3/economic-plan`)
                    .done(function (result) {
                        var options = {
                            series: result.count,
                            chart: {
                                type: 'donut',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            labels:result.type,
                            dataLabels: {

                                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                                    return value.toFixed(0) +'%'                               }
                            },

                            // tooltip: {
                            //     custom: function ({series, seriesIndex, dataPointIndex, w}) {
                            //         console.log(series)
                            //         return '<div class="arrow_box">' +
                            //             '<span>' + series[seriesIndex][dataPointIndex] + '</span>' +
                            //             '</div>'
                            //     }
                            // },
                            legend: {
                                show:true,
                                position: 'bottom',
                            },
                            colors:['var(--color_1)','var(--color_2)','var(--color_3)'],
                                responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 320
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };
                        var chart = new ApexCharts(document.querySelector("#economic_plan1"), options);
                        chart.render();

                    });
                $.get(`/dashboard3/decentralization`)
                    .done(function (result) {
                        var options = {
                            series: result.count,
                            chart: {
                                type: 'pie',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            labels:result.type,
                            dataLabels: {

                                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                                    return value.toFixed(0) +'%'                               }
                            },
                            legend: {
                                show:true,
                                position: 'bottom',
                            },
                            colors:['var(--color_1)','var(--color_2)','var(--color_3)'],
                            plotOptions: {
                                pie: {
                                    startAngle: 0,
                                    endAngle: 360,
                                    expandOnClick: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    customScale: 1,
                                    dataLabels: {
                                        offset: 0,
                                        minAngleToShowLabel: 10
                                    },
                                    donut: {
                                        size: '65%',
                                        background: 'transparent',
                                        labels: {
                                            show: false,
                                            // name: {
                                            //     show: true,
                                            //     fontSize: '12px',
                                            //     fontFamily: 'Helvetica, Arial, sans-serif',
                                            //     fontWeight: 600,
                                            //     color: undefined,
                                            //     offsetY: -10,
                                            //     formatter: function (val) {
                                            //         return val
                                            //     }
                                            // },
                                            // value: {
                                            //     show: true,
                                            //     fontSize: '16px',
                                            //     fontFamily: 'Helvetica, Arial, sans-serif',
                                            //     fontWeight: 400,
                                            //     color: undefined,
                                            //     offsetY: 16,
                                            //     formatter: function (val) {
                                            //         return val+"%"
                                            //     }
                                            // },
                                        }
                                    },
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 320
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };
                        var chart = new ApexCharts(document.querySelector("#decetralization_plan"), options);
                        chart.render();

                    });
            }
        },

    }
})();

