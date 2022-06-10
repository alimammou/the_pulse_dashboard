import google from './loader';
(function () {
    XonBoard.Dashboard1Overall = {
        list: {


            init: function () {
                $.get('/dashboard1/starting-date')
                    .done(function (result) {
                    var    series= [

                                 {
                                     name: 'Levi Lincoln',
                                     data: [
                                         {
                                             x: 'Secretary of State',
                                             y: [
                                                 1420070400,
                                                 1420070450
                                             ]
                                         }
                                     ]
                                 },
                        ]
//console.log(  new Date(1800, 4, 13).getTime())
                        var date =new  Date()+10000

                        var options = {
                            series: result
                            ,
                            chart: {
                                height: 350,
                                width: 10000,
                                type: 'rangeBar',
                                zoom: {
                                    enabled: false,
                                },
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: true,
                                    barHeight: '50%',
                                    rangeBarGroupRows: true
                                }
                            },
                            colors:['#dbf0e5','#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],

                            fill: {
                                type: 'solid'
                            },
                            xaxis: {
                                type: 'datetime',
                                max: date
                            },
                            legend: {
                                show:false,
                                position: 'right'
                            },
                            tooltip: {
                                custom: function(opts) {
                                 //   const fromYear = new Date(values['start']).getFullYear()
                                    const values = opts.ctx.rangeBar.getTooltipValues(opts)
                                    var toYear = new  Date(values['start']).getFullYear()

                                    return"<div>"+
                                        "<li>"+ toYear+"</li>"+
                                        "<li>"+ values['seriesName']+"</li>"+
                                        "</div>"

                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#scatter_category"), options);
                        chart.render();

                        // var options = {
                        //     chart: {
                        //         zoom: {
                        //             enabled: true,
                        //             type: 'y',
                        //             autoScaleYaxis: false,
                        //             zoomedArea: {
                        //                 fill: {
                        //                     color: '#90CAF9',
                        //                     opacity: 0.4
                        //                 },
                        //                 stroke: {
                        //                     color: '#0D47A1',
                        //                     opacity: 0.4,
                        //                     width: 1
                        //                 }
                        //             }
                        //         },
                        //         height: 380,
                        //         width: "100%",
                        //         type: "scatter",
                        //     },
                        //     colors:['#92d3b0'],
                        //     series: [
                        //         {
                        //             name: "Series 1",
                        //             data:
                        //                 result
                        //
                        //         }
                        //     ],
                        //     xaxis: {
                        //         type: "numeric",
                        //         show: false,
                        //         labels: {
                        //             show: false,
                        //         }
                        //     },
                        //     yaxis: {
                        //         type: "numeric",
                        //         min: 2004,
                        //         max: 2022,
                        //         labels: {
                        //             style: {
                        //                 colors: ['#000000'],
                        //             }
                        //         }
                        //     },
                        //     tooltip: {
                        //         custom: function({series, seriesIndex, dataPointIndex, w}) {
                        //             var data = w.globals.initialSeries[seriesIndex].data[dataPointIndex];
                        //
                        //             return '<ul style=\"color: #0a2d2a;\">' +
                        //                 '<li><b>Name</b>: ' + data.name + '</li>' +
                        //                 '<li><b>Year</b>: ' + data.date + '</li>' +
                        //                 '</ul>';
                        //         }
                        //     }
                        // };
                        //
                        // var chart = new ApexCharts(document.querySelector("#scatter_category"), options);
                        //
                        // chart.render();

                    })
                $.get(`/dashboard1/website-count`)
                    .done(function (result) {
                        var options = {
                            series: [Math.round(result)],
                            chart: {
                                type: 'radialBar',
                                width:450,
                                offsetX: 0,
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
                            colors: [ '#a9de8e'],
                            labels:['Has a Website'],
                            legend: {
                                show: false,
                            },

                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        show: true,
                                        value: {
                                            show: true,
                                            fontSize: '16px',
                                            fontFamily: undefined,
                                            fontWeight: 400,
                                            color: '#000000',
                                            offsetY: 16,
                                        },
                                    }
                                }
                                },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 500
                                    },
                                    legend: {
                                        position: 'bottom',
                                        floating: true
                                    }
                                }
                            },
                                {
                                    breakpoint: 1650,
                                    options: {
                                        chart: {
                                            toolbar: {
                                                show: true,
                                                offsetX: -60,
                                                offsetY: 0,
                                            }
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                        };
                        var chart = new ApexCharts(document.querySelector("#website-chart"), options);
                        chart.render();
                    });

                   $.get('/dashboard1/financing').done(function (result)
                   {

                       var options = {
                           series: result.count,
                           chart: {
                               height: 380,
                               type: 'radialBar',
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
                           plotOptions: {
                               radialBar: {
                                   offsetY: 0,
                                   startAngle: 0,
                                   endAngle: 270,
                                   hollow: {
                                       margin: 5,
                                       size: '30%',
                                       background: 'transparent',
                                       image: undefined,
                                   },
                                   dataLabels: {
                                       name: {
                                           show: true,
                                       },
                                       value: {
                                           show: true,
                                       }
                                   }
                               }
                           },
                           colors: ['var(--color_1)', 'var(--color_2)', 'var(--color_3)'],
                           labels: result.type,
                           legend: {
                               horizontalAlign: 'left',
                               show: true,
                               // floating: false,
                               // fontSize: '16px',
                               position: 'bottom',
                               // offsetX: 160,
                               // offsetY: 15,
                               labels: {
                                   useSeriesColors: false,
                               },
                               markers: {
                                   size: 0
                               },
                               formatter: function(seriesName, opts) {
                                   return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                               },
                               onItemClick: {
                                   toggleDataSeries: false
                               },
                               onItemHover: {
                                   highlightDataSeries: true
                               },
                               itemMargin: {
                                   vertical: 3
                               }
                           },
                           responsive: [{
                               breakpoint: 480,
                               options: {
                                   legend: {
                                       show: true
                                   }
                               }
                           }]
                       };

                       var chart = new ApexCharts(document.querySelector("#financing-chart"), options);
                       chart.render();
                   });


                $.get(`/dashboard1/distribution-data`)
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
                        show: true,
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
                                d[dataPointIndex]+
                                '</p></div>';
                        },
                        fixed: {
                            enabled: true,
                            position: 'topRight',
                            offsetX: 0,
                            offsetY: 0,
                        },
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
                var chart = new ApexCharts(document.querySelector("#columns_basic"), options);
                        chart.render()
                    });
                $.get(`/dashboard1/registration-status`)
                    .done(function (result) {
                        var options = {
                            series: [{
                                data: result.count
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
                            colors:['#dbf0e5','#b7e1cb','#92d3b0','#6dc495','#c9e9d8','#80cba3','#a4dabd'],
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: ['#E6EDF7'],
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
                                        d[dataPointIndex]+
                                        '</p></div>';
                                },
                                fixed: {
                                    enabled: true,
                                    position: 'topRight',
                                    offsetX: 0,
                                    offsetY: 0,
                                },
                            },
                            legend: {
                                markers: {
                                    width: 10,
                                    height: 10,
                                    radius: 10,
                                },
                                show: true,
                                horizontalAlign: 'left',
                                onItemHover: {
                                    highlightDataSeries: true
                                },
                                onItemClick: {
                                    toggleDataSeries: true
                                },

                            },
                            xaxis: {
                                categories: result.type,
                                labels: {
                                    show: false,
                                    rotateAlways: false,
                                    hideOverlappingLabels: true,
                                    showDuplicates: false,
                                    trim: false,
                                    minHeight: undefined,
                                    maxHeight: 120,
                                    style: {
                                        fontSize: '9px'
                                    }
                                }
                            }
                        };
                        var chart = new ApexCharts(document.querySelector("#registration-status"), options);
                        chart.render()
                    });

            }
        },

    }
})();

// var _scatterCategoryLightExample = function(data) {
//     if (typeof echarts == 'undefined') {
//         console.warn('Warning - echarts.min.js is not loaded.');
//         return;
//     }
//
//     // Define element
//     var scatter_category_element = document.getElementById('scatter_category');
//
//
//     //
//     // Charts configuration
//     //
//
//     if (scatter_category_element) {
//
//         // Initialize chart
//         var scatter_category = echarts.init(scatter_category_element);
//
//
//         //
//         // Chart config
//         //
//
//         // Options
//         console.log(data[0].name)
//         scatter_category.setOption({
//
//             xAxis: {},
//             yAxis: {},
//             series: [
//                 {
//                     symbolSize: 20,
//                     data: {name: data[0].name,value: [data[0].starting_date]},
//                     type: 'scatter'
//                 }
//             ]
//         });
//     }
//
//
//     //
//     // Resize charts
//     //
//
//     // Resize function
//     var triggerChartResize = function() {
//         scatter_category_element && scatter_category.resize();
//     };
//
//     // On sidebar width change
//     var sidebarToggle = document.querySelectorAll('.sidebar-control');
//     if (sidebarToggle) {
//         sidebarToggle.forEach(function(togglers) {
//             togglers.addEventListener('click', triggerChartResize);
//         });
//     }
//
//     // On window resize
//     var resizeCharts;
//     window.addEventListener('resize', function() {
//         clearTimeout(resizeCharts);
//         resizeCharts = setTimeout(function () {
//             triggerChartResize();
//         }, 200);
//     });
// };
//
//
// //
// // Return objects assigned to module
// //
//
// return {
//     init: function(data) {
//         _scatterCategoryLightExample(data);
//     }
// }
