(function () {
    XonBoard.ThirdDashboardIndividual = {
        list: {


            init: function (name) {
                $('select').select2({
                    sortField: 'text'
                });
                $.get('/dashboard3/weapons/'+name+'')
                    .done(function (result) {
                        var options2 = {
                            chart: {
                                height: 360,
                                type: "radialBar",
                            },
                            series: [result.val],
                            labels: [result.label],
                            colors:['var(--color_1)'],
                            plotOptions: {
                                radialBar: {
                                    startAngle: -90,
                                    endAngle: 90,
                                    track: {
                                        startAngle: -90,
                                        endAngle: 90,
                                    },
                                    dataLabels: {
                                        name: {
                                            offsetY: 100,
                                            show: false,
                                            fontSize: "6px"

                                        },
                                        value: {
                                            show: true,
                                            fontSize: "20px",
                                            formatter: function (val) {
                                                var v = val / 25
                                                if(v==1)
                                                {
                                                    return "Weapon correlated with region status";
                                                }
                                                if(v==2)
                                                {
                                                    return "With application of Taif Agreement";
                                                }
                                                if(v==3)
                                                {
                                                    return "With defense strategy for \"the resistance\".";
                                                }
                                                if(v==4)
                                                {
                                                    return "Totally Against";
                                                }
                                                if(v==0)
                                                {
                                                    return "With immediate disarmament";
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shade: "dark",
                                    type: "horizontal",
                                    gradientToColors: ["#87D4F9"],
                                    stops: [0, 100]
                                }
                            },
                            stroke: {
                                lineCap: "butt"
                            },
                        };

                        new ApexCharts(document.querySelector("#weapons-chart"), options2).render();
                    });
                $.get('/dashboard3/neutrality/'+name+'')
                    .done(function (result) {
                        var options2 = {
                            chart: {
                                height: 360,
                                type: "radialBar",
                            },
                            series: [result.val],
                            labels: ['no opinion  \r  \n     against'],
                            colors:['var(--color_2)'],
                            plotOptions: {
                                radialBar: {
                                    startAngle: -90,
                                    endAngle: 90,
                                    track: {
                                        startAngle: -90,
                                        endAngle: 90,
                                    },
                                    dataLabels: {
                                        name: {
                                            offsetY: 50,
                                            show: false,
                                            formatter: function () {
                                               return 'no opinion  \r  \n' +
                                                   '            against'
                                            }

                                        },
                                        value: {
                                            show: true,
                                            fontSize: "20px",
                                            formatter: function (val) {
                                                var v =val / 50
                                                if(v==1)
                                                {
                                                    return "With a state-sponsored solution";
                                                }
                                                if(v==2)
                                                {
                                                    return "With, unconditionally";
                                                }
                                                if(v==0)
                                                {
                                                    return "No Opinion";
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shade: "dark",
                                    type: "horizontal",
                                    gradientToColors: ["#87D4F9"],
                                    stops: [0, 100]
                                }
                            },
                            stroke: {
                                lineCap: "butt"
                            },
                        };

                        new ApexCharts(document.querySelector("#neutrality-chart"), options2).render();
                    });
                $.get('/dashboard3/same-opinion/'+name+'')
                    .done(function (result) {
                        var options = {
                            series: [Math.round(result)],
                            chart: {
                                height:400,
                                type: 'radialBar',
                            },
                            colors:['var(--color_2)'],
                            labels:['same opinions'],
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
                                            offsetY: 16,
                                        },
                                    }
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 320
                                    },
                                    legend: {
                                        position: 'bottom',
                                        floating: true
                                    }
                                }
                            }]
                        };
                        var chart = new ApexCharts(document.querySelector("#same-opinion-chart"), options);
                        chart.render();
                    });


            }
        },

    }
})();

