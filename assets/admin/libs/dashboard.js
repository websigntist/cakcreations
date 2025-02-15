"use strict";
var KTDashboard = function () {
    var t = function (t, e, a, r) {
        if (0 != t.length) {
            var o = {
                type: "line",
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                    datasets: [{
                        label: "",
                        borderColor: a,
                        borderWidth: r,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 12,
                        pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                        pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                        pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                        pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                        fill: !1,
                        data: e
                    }]
                },
                options: {
                    title: {display: !1},
                    tooltips: {
                        enabled: !1,
                        intersect: !1,
                        mode: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {display: !1, labels: {usePointStyle: !1}},
                    responsive: !0,
                    maintainAspectRatio: !0,
                    hover: {mode: "index"},
                    scales: {
                        xAxes: [{display: !1, gridLines: !1, scaleLabel: {display: !0, labelString: "Month"}}],
                        yAxes: [{
                            display: !1,
                            gridLines: !1,
                            scaleLabel: {display: !0, labelString: "Value"},
                            ticks: {beginAtZero: !0}
                        }]
                    },
                    elements: {point: {radius: 4, borderWidth: 12}},
                    layout: {padding: {left: 0, right: 10, top: 5, bottom: 0}}
                }
            };
            return new Chart(t, o)
        }
    };
    return {
        init: function () {
            var e, a;
            !function () {
                var t = KTUtil.getByID("kt_chart_daily_sales");
                if (t) {
                    var e = {
                        labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7", "Label 8", "Label 9", "Label 10", "Label 11", "Label 12", "Label 13", "Label 14", "Label 15", "Label 16"],
                        datasets: [{
                            backgroundColor: KTApp.getStateColor("success"),
                            data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20]
                        }, {
                            backgroundColor: "#f3f3fb",
                            data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20]
                        }]
                    };
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: {
                            title: {display: !1},
                            tooltips: {intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10},
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            barRadius: 4,
                            scales: {
                                xAxes: [{display: !1, gridLines: !1, stacked: !0}],
                                yAxes: [{display: !1, stacked: !0, gridLines: !1}]
                            },
                            layout: {padding: {left: 0, right: 0, top: 0, bottom: 0}}
                        }
                    })
                }
            }(), function () {
                if (KTUtil.getByID("kt_chart_profit_share")) {
                    var t = {
                        type: "doughnut",
                        data: {
                            datasets: [{
                                data: [35, 30, 35],
                                backgroundColor: [KTApp.getStateColor("success"), KTApp.getStateColor("danger"), KTApp.getStateColor("brand")]
                            }], labels: ["Angular", "CSS", "HTML"]
                        },
                        options: {
                            cutoutPercentage: 75,
                            responsive: !0,
                            maintainAspectRatio: !1,
                            legend: {display: !1, position: "top"},
                            title: {display: !1, text: "Technology"},
                            animation: {animateScale: !0, animateRotate: !0},
                            tooltips: {
                                enabled: !0,
                                intersect: !1,
                                mode: "nearest",
                                bodySpacing: 5,
                                yPadding: 10,
                                xPadding: 10,
                                caretPadding: 0,
                                displayColors: !1,
                                backgroundColor: KTApp.getStateColor("brand"),
                                titleFontColor: "#ffffff",
                                cornerRadius: 4,
                                footerSpacing: 0,
                                titleSpacing: 0
                            }
                        }
                    }, e = KTUtil.getByID("kt_chart_profit_share").getContext("2d");
                    new Chart(e, t)
                }
            }(), function () {
                if (KTUtil.getByID("kt_chart_sales_stats")) {
                    var t = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March", "April"],
                            datasets: [{
                                label: "Sales Stats",
                                borderColor: KTApp.getStateColor("brand"),
                                borderWidth: 2,
                                backgroundColor: KTApp.getStateColor("brand"),
                                pointBackgroundColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color(KTApp.getStateColor("danger")).alpha(.2).rgbString(),
                                data: [10, 20, 16, 18, 12, 40, 35, 30, 33, 34, 45, 40, 60, 55, 70, 65, 75, 62]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10},
                            legend: {display: !1, labels: {usePointStyle: !1}},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            hover: {mode: "index"},
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{display: !1, gridLines: !1, scaleLabel: {display: !0, labelString: "Value"}}]
                            },
                            elements: {point: {radius: 3, borderWidth: 0, hoverRadius: 8, hoverBorderWidth: 2}}
                        }
                    };
                    new Chart(KTUtil.getByID("kt_chart_sales_stats"), t)
                }
            }(), t($("#kt_chart_sales_by_apps_1_1"), [10, 20, -5, 8, -20, -2, -4, 15, 5, 8], KTApp.getStateColor("success"), 2), t($("#kt_chart_sales_by_apps_1_2"), [2, 16, 0, 12, 22, 5, -10, 5, 15, 2], KTApp.getStateColor("danger"), 2), t($("#kt_chart_sales_by_apps_1_3"), [15, 5, -10, 5, 16, 22, 6, -6, -12, 5], KTApp.getStateColor("success"), 2), t($("#kt_chart_sales_by_apps_1_4"), [8, 18, -12, 12, 22, -2, -14, 16, 18, 2], KTApp.getStateColor("warning"), 2), t($("#kt_chart_sales_by_apps_2_1"), [10, 20, -5, 8, -20, -2, -4, 15, 5, 8], KTApp.getStateColor("danger"), 2), t($("#kt_chart_sales_by_apps_2_2"), [2, 16, 0, 12, 22, 5, -10, 5, 15, 2], KTApp.getStateColor("dark"), 2), t($("#kt_chart_sales_by_apps_2_3"), [15, 5, -10, 5, 16, 22, 6, -6, -12, 5], KTApp.getStateColor("brand"), 2), t($("#kt_chart_sales_by_apps_2_4"), [8, 18, -12, 12, 22, -2, -14, 16, 18, 2], KTApp.getStateColor("info"), 2), function () {
                if (0 != $("#kt_chart_latest_updates").length) {
                    var t = document.getElementById("kt_chart_latest_updates").getContext("2d"), e = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "Sales Stats",
                                backgroundColor: KTApp.getStateColor("danger"),
                                borderColor: KTApp.getStateColor("danger"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("success"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10},
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            hover: {mode: "index"},
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}}
                        }
                    };
                    new Chart(t, e)
                }
            }(), function () {
                if (0 != $("#kt_chart_trends_stats").length) {
                    var t = document.getElementById("kt_chart_trends_stats").getContext("2d"),
                        e = t.createLinearGradient(0, 0, 0, 240);
                    e.addColorStop(0, Chart.helpers.color("#00c5dc").alpha(.7).rgbString()), e.addColorStop(1, Chart.helpers.color("#f2feff").alpha(0).rgbString());
                    var a = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                            datasets: [{
                                label: "Sales Stats",
                                backgroundColor: e,
                                borderColor: "#0dc8de",
                                pointBackgroundColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.2).rgbString(),
                                data: [20, 10, 18, 15, 26, 18, 15, 22, 16, 12, 12, 13, 10, 18, 14, 24, 16, 12, 19, 21, 16, 14, 21, 21, 13, 15, 22, 24, 21, 11, 14, 19, 21, 17]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10},
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            hover: {mode: "index"},
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: .19}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 5, bottom: 0}}
                        }
                    };
                    new Chart(t, a)
                }
            }(), function () {
                if (0 != $("#kt_chart_trends_stats_2").length) {
                    var t = document.getElementById("kt_chart_trends_stats_2").getContext("2d"), e = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                            datasets: [{
                                label: "Sales Stats",
                                backgroundColor: "#d2f5f9",
                                borderColor: KTApp.getStateColor("brand"),
                                pointBackgroundColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#ffffff").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.2).rgbString(),
                                data: [20, 10, 18, 15, 32, 18, 15, 22, 8, 6, 12, 13, 10, 18, 14, 24, 16, 12, 19, 21, 16, 14, 24, 21, 13, 15, 27, 29, 21, 11, 14, 19, 21, 17]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10},
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            hover: {mode: "index"},
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: .19}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 5, bottom: 0}}
                        }
                    };
                    new Chart(t, e)
                }
            }(), function () {
                if (0 != $("#kt_chart_latest_trends_map").length) try {
                    new GMaps({div: "#kt_chart_latest_trends_map", lat: -12.043333, lng: -77.028333})
                } catch (t) {
                    console.log(t)
                }
            }(), 0 != $("#kt_chart_revenue_change").length && Morris.Donut({
                element: "kt_chart_revenue_change",
                data: [{label: "New York", value: 10}, {label: "London", value: 7}, {label: "Paris", value: 20}],
                colors: [KTApp.getStateColor("success"), KTApp.getStateColor("danger"), KTApp.getStateColor("brand")]
            }), 0 != $("#kt_chart_support_tickets").length && Morris.Donut({
                element: "kt_chart_support_tickets",
                data: [{label: "Margins", value: 20}, {label: "Profit", value: 70}, {label: "Lost", value: 10}],
                labelColor: "#a7a7c2",
                colors: [KTApp.getStateColor("success"), KTApp.getStateColor("brand"), KTApp.getStateColor("danger")]
            }), function () {
                var t = KTUtil.getByID("kt_chart_support_requests");
                if (t) {
                    var e = {
                        type: "doughnut",
                        data: {
                            datasets: [{
                                data: [35, 30, 35],
                                backgroundColor: [KTApp.getStateColor("success"), KTApp.getStateColor("danger"), KTApp.getStateColor("brand")]
                            }], labels: ["Angular", "CSS", "HTML"]
                        },
                        options: {
                            cutoutPercentage: 75,
                            responsive: !0,
                            maintainAspectRatio: !1,
                            legend: {display: !1, position: "top"},
                            title: {display: !1, text: "Technology"},
                            animation: {animateScale: !0, animateRotate: !0},
                            tooltips: {
                                enabled: !0,
                                intersect: !1,
                                mode: "nearest",
                                bodySpacing: 5,
                                yPadding: 10,
                                xPadding: 10,
                                caretPadding: 0,
                                displayColors: !1,
                                backgroundColor: KTApp.getStateColor("brand"),
                                titleFontColor: "#ffffff",
                                cornerRadius: 4,
                                footerSpacing: 0,
                                titleSpacing: 0
                            }
                        }
                    }, a = t.getContext("2d");
                    new Chart(a, e)
                }
            }(), function () {
                if (0 != $("#kt_chart_activities").length) {
                    var t = document.getElementById("kt_chart_activities").getContext("2d"),
                        e = t.createLinearGradient(0, 0, 0, 240);
                    e.addColorStop(0, Chart.helpers.color("#e14c86").alpha(1).rgbString()), e.addColorStop(1, Chart.helpers.color("#e14c86").alpha(.3).rgbString());
                    var a = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "Sales Stats",
                                backgroundColor: Chart.helpers.color("#e14c86").alpha(1).rgbString(),
                                borderColor: "#e13a58",
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("light"),
                                pointHoverBorderColor: Chart.helpers.color("#ffffff").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {
                                mode: "nearest",
                                intersect: !1,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 10, bottom: 0}}
                        }
                    };
                    new Chart(t, a)
                }
            }(), function () {
                if (0 != $("#kt_chart_bandwidth1").length) {
                    var t = document.getElementById("kt_chart_bandwidth1").getContext("2d"),
                        e = t.createLinearGradient(0, 0, 0, 240);
                    e.addColorStop(0, Chart.helpers.color("#d1f1ec").alpha(1).rgbString()), e.addColorStop(1, Chart.helpers.color("#d1f1ec").alpha(.3).rgbString());
                    var a = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "Bandwidth Stats",
                                backgroundColor: e,
                                borderColor: KTApp.getStateColor("success"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {
                                mode: "nearest",
                                intersect: !1,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 10, bottom: 0}}
                        }
                    };
                    new Chart(t, a)
                }
            }(), function () {
                if (0 != $("#kt_chart_bandwidth2").length) {
                    var t = document.getElementById("kt_chart_bandwidth2").getContext("2d"),
                        e = t.createLinearGradient(0, 0, 0, 240);
                    e.addColorStop(0, Chart.helpers.color("#ffefce").alpha(1).rgbString()), e.addColorStop(1, Chart.helpers.color("#ffefce").alpha(.3).rgbString());
                    var a = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "Bandwidth Stats",
                                backgroundColor: e,
                                borderColor: KTApp.getStateColor("warning"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {
                                mode: "nearest",
                                intersect: !1,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 10, bottom: 0}}
                        }
                    };
                    new Chart(t, a)
                }
            }(), function () {
                if (0 != $("#kt_chart_adwords_stats").length) {
                    var t = document.getElementById("kt_chart_adwords_stats").getContext("2d"),
                        e = t.createLinearGradient(0, 0, 0, 240);
                    e.addColorStop(0, Chart.helpers.color("#ffefce").alpha(1).rgbString()), e.addColorStop(1, Chart.helpers.color("#ffefce").alpha(.3).rgbString());
                    var a = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "AdWord Clicks",
                                backgroundColor: KTApp.getStateColor("brand"),
                                borderColor: KTApp.getStateColor("brand"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [12, 16, 9, 18, 13, 12, 18, 12, 15, 17]
                            }, {
                                label: "AdWords Views",
                                backgroundColor: KTApp.getStateColor("success"),
                                borderColor: KTApp.getStateColor("success"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {
                                mode: "nearest",
                                intersect: !1,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    stacked: !0,
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 10, bottom: 0}}
                        }
                    };
                    new Chart(t, a)
                }
            }(), function () {
                if (0 != $("#kt_chart_finance_summary").length) {
                    var t = document.getElementById("kt_chart_finance_summary").getContext("2d"), e = {
                        type: "line",
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                            datasets: [{
                                label: "AdWords Views",
                                backgroundColor: KTApp.getStateColor("success"),
                                borderColor: KTApp.getStateColor("success"),
                                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor("danger"),
                                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                                data: [10, 14, 12, 16, 9, 11, 13, 9, 13, 15]
                            }]
                        },
                        options: {
                            title: {display: !1},
                            tooltips: {
                                mode: "nearest",
                                intersect: !1,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {display: !1},
                            responsive: !0,
                            maintainAspectRatio: !1,
                            scales: {
                                xAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Month"}
                                }],
                                yAxes: [{
                                    display: !1,
                                    gridLines: !1,
                                    scaleLabel: {display: !0, labelString: "Value"},
                                    ticks: {beginAtZero: !0}
                                }]
                            },
                            elements: {line: {tension: 1e-7}, point: {radius: 4, borderWidth: 12}},
                            layout: {padding: {left: 0, right: 0, top: 10, bottom: 0}}
                        }
                    };
                    new Chart(t, e)
                }
            }(), t($("#kt_chart_quick_stats_1"), [10, 14, 18, 11, 9, 12, 14, 17, 18, 14], KTApp.getStateColor("brand"), 3), t($("#kt_chart_quick_stats_2"), [11, 12, 18, 13, 11, 12, 15, 13, 19, 15], KTApp.getStateColor("danger"), 3), t($("#kt_chart_quick_stats_3"), [12, 12, 18, 11, 15, 12, 13, 16, 11, 18], KTApp.getStateColor("success"), 3), t($("#kt_chart_quick_stats_4"), [11, 9, 13, 18, 13, 15, 14, 13, 18, 15], KTApp.getStateColor("success"), 3), function () {
                var t = KTUtil.getByID("kt_chart_order_statistics");
                if (t) {
                    var e = Chart.helpers.color, a = {
                        labels: ["1 Jan", "2 Jan", "3 Jan", "4 Jan", "5 Jan", "6 Jan", "7 Jan"],
                        datasets: [{
                            fill: !0,
                            backgroundColor: e(KTApp.getStateColor("brand")).alpha(.6).rgbString(),
                            borderColor: e(KTApp.getStateColor("brand")).alpha(0).rgbString(),
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 12,
                            pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor("brand"),
                            pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                            data: [20, 30, 20, 40, 30, 60, 30]
                        }, {
                            fill: !0,
                            backgroundColor: e(KTApp.getStateColor("brand")).alpha(.2).rgbString(),
                            borderColor: e(KTApp.getStateColor("brand")).alpha(0).rgbString(),
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 12,
                            pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor("brand"),
                            pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                            data: [15, 40, 15, 30, 40, 30, 50]
                        }]
                    }, r = t.getContext("2d");
                    new Chart(r, {
                        type: "line", data: a, options: {
                            responsive: !0,
                            maintainAspectRatio: !1,
                            legend: !1,
                            scales: {
                                xAxes: [{
                                    categoryPercentage: .35,
                                    barPercentage: .7,
                                    display: !0,
                                    scaleLabel: {display: !1, labelString: "Month"},
                                    gridLines: !1,
                                    ticks: {
                                        display: !0,
                                        beginAtZero: !0,
                                        fontColor: KTApp.getBaseColor("shape", 3),
                                        fontSize: 13,
                                        padding: 10
                                    }
                                }],
                                yAxes: [{
                                    categoryPercentage: .35,
                                    barPercentage: .7,
                                    display: !0,
                                    scaleLabel: {display: !1, labelString: "Value"},
                                    gridLines: {
                                        color: KTApp.getBaseColor("shape", 2),
                                        drawBorder: !1,
                                        offsetGridLines: !1,
                                        drawTicks: !1,
                                        borderDash: [3, 4],
                                        zeroLineWidth: 1,
                                        zeroLineColor: KTApp.getBaseColor("shape", 2),
                                        zeroLineBorderDash: [3, 4]
                                    },
                                    ticks: {
                                        max: 70,
                                        stepSize: 10,
                                        display: !0,
                                        beginAtZero: !0,
                                        fontColor: KTApp.getBaseColor("shape", 3),
                                        fontSize: 13,
                                        padding: 10
                                    }
                                }]
                            },
                            title: {display: !1},
                            hover: {mode: "index"},
                            tooltips: {
                                enabled: !0,
                                intersect: !1,
                                mode: "nearest",
                                bodySpacing: 5,
                                yPadding: 10,
                                xPadding: 10,
                                caretPadding: 0,
                                displayColors: !1,
                                backgroundColor: KTApp.getStateColor("brand"),
                                titleFontColor: "#ffffff",
                                cornerRadius: 4,
                                footerSpacing: 0,
                                titleSpacing: 0
                            },
                            layout: {padding: {left: 0, right: 0, top: 5, bottom: 5}}
                        }
                    })
                }
            }(), function () {
                if (0 != $("#kt_dashboard_daterangepicker").length) {
                    var t = $("#kt_dashboard_daterangepicker"), e = moment(), a = moment();
                    t.daterangepicker({
                        direction: KTUtil.isRTL(),
                        startDate: e,
                        endDate: a,
                        opens: "left",
                        ranges: {
                            Today: [moment(), moment()],
                            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                            "Last 7 Days": [moment().subtract(6, "days"), moment()],
                            "Last 30 Days": [moment().subtract(29, "days"), moment()],
                            "This Month": [moment().startOf("month"), moment().endOf("month")],
                            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                        }
                    }, r), r(e, a, "")
                }

                function r(t, e, a) {
                    var r = "", o = "";
                    e - t < 100 || "Today" == a ? (r = "Today:", o = t.format("MMM D")) : "Yesterday" == a ? (r = "Yesterday:", o = t.format("MMM D")) : o = t.format("MMM D") + " - " + e.format("MMM D"), $("#kt_dashboard_daterangepicker_date").html(o), $("#kt_dashboard_daterangepicker_title").html(r)
                }
            }(), 0 !== $("#kt_datatable_latest_orders").length && $(".kt-datatable").KTDatatable({
                data: {
                    type: "remote",
                    source: {read: {url: "https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/default.php"}},
                    pageSize: 10,
                    saveState: {cookie: !1, webstorage: !0},
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0
                },
                layout: {scroll: !0, height: 500, footer: !1},
                sortable: !0,
                filterable: !1,
                pagination: !0,
                columns: [{
                    field: "RecordID",
                    title: "#",
                    sortable: !1,
                    width: 40,
                    selector: {class: "kt-checkbox--solid"},
                    textAlign: "center"
                }, {
                    field: "ShipName", title: "Company", width: "auto", autoHide: !1, template: function (t, e) {
                        for (var a = e + 1; a > 5;) a -= 3;
                        return '                        <div class="kt-user-card-v2">                            <div class="kt-user-card-v2__pic">                                <img src="https://keenthemes.com/metronic/preview/assets/media/client-logos/logo' + a + '.png" alt="photo">                            </div>                            <div class="kt-user-card-v2__details">                                <a href="#" class="kt-user-card-v2__name">' + t.CompanyName + '</a>                                <span class="kt-user-card-v2__email">' + ["Angular, React", "Vue, Kendo", ".NET, Oracle, MySQL", "Node, SASS, Webpack", "MangoDB, Java", "HTML5, jQuery, CSS3"][a - 1] + "</span>                            </div>                        </div>"
                    }
                }, {
                    field: "ShipDate", title: "Date", width: 100, template: function (t) {
                        return '<span class="kt-font-bold">' + t.ShipDate + "</span>"
                    }
                }, {
                    field: "Status", title: "Status", width: 100, template: function (t) {
                        var e = {
                            1: {title: "Pending", class: " btn-label-brand"},
                            2: {title: "Processing", class: " btn-label-danger"},
                            3: {title: "Success", class: " btn-label-success"},
                            4: {title: "Delivered", class: " btn-label-success"},
                            5: {title: "Canceled", class: " btn-label-warning"},
                            6: {title: "Done", class: " btn-label-danger"},
                            7: {title: "On Hold", class: " btn-label-warning"}
                        };
                        return '<span class="btn btn-bold btn-sm btn-font-sm ' + e[t.Status].class + '">' + e[t.Status].title + "</span>"
                    }
                }, {
                    field: "Type", title: "Managed By", width: 200, template: function (t, e) {
                        for (var a = 4 + e; a > 12;) a -= 3;
                        var r = "100_" + a + ".jpg", o = KTUtil.getRandomInt(0, 5),
                            l = ["Developer", "Designer", "CEO", "Manager", "Architect", "Sales"];
                        return a > 5 ? '<div class="kt-user-card-v2">\t\t\t\t\t\t\t<div class="kt-user-card-v2__pic">\t\t\t\t\t\t\t\t<img src="https://keenthemes.com/metronic/preview/assets/media/users/' + r + '" alt="photo">\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t<div class="kt-user-card-v2__details">\t\t\t\t\t\t\t\t<a href="#" class="kt-user-card-v2__name">' + t.CompanyAgent + '</a>\t\t\t\t\t\t\t\t<span class="kt-user-card-v2__desc">' + l[o] + "</span>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t</div>" : '<div class="kt-user-card-v2">\t\t\t\t\t\t\t<div class="kt-user-card-v2__pic">\t\t\t\t\t\t\t\t<div class="kt-badge kt-badge--xl kt-badge--' + ["success", "brand", "danger", "success", "warning", "primary", "info"][KTUtil.getRandomInt(0, 6)] + '">' + t.CompanyAgent.substring(0, 1) + '</div>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t<div class="kt-user-card-v2__details">\t\t\t\t\t\t\t\t<a href="#" class="kt-user-card-v2__name">' + t.CompanyAgent + '</a>\t\t\t\t\t\t\t\t<span class="kt-user-card-v2__desc">' + l[o] + "</span>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t</div>"
                    }
                }, {
                    field: "Actions",
                    width: 80,
                    title: "Actions",
                    sortable: !1,
                    autoHide: !1,
                    overflow: "visible",
                    template: function () {
                        return '                        <div class="dropdown">                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">                                <i class="flaticon-more-1"></i>                            </a>                            <div class="dropdown-menu dropdown-menu-right">                                <ul class="kt-nav">                                    <li class="kt-nav__item">                                        <a href="#" class="kt-nav__link">                                            <i class="kt-nav__link-icon flaticon2-expand"></i>                                            <span class="kt-nav__link-text">View</span>                                        </a>                                    </li>                                    <li class="kt-nav__item">                                        <a href="#" class="kt-nav__link">                                            <i class="kt-nav__link-icon flaticon2-contract"></i>                                            <span class="kt-nav__link-text">Edit</span>                                        </a>                                    </li>                                    <li class="kt-nav__item">                                        <a href="#" class="kt-nav__link">                                            <i class="kt-nav__link-icon flaticon2-trash"></i>                                            <span class="kt-nav__link-text">Delete</span>                                        </a>                                    </li>                                    <li class="kt-nav__item">                                        <a href="#" class="kt-nav__link">                                            <i class="kt-nav__link-icon flaticon2-mail-1"></i>                                            <span class="kt-nav__link-text">Export</span>                                        </a>                                    </li>                                </ul>                            </div>                        </div>                    '
                    }
                }]
            }), function () {
                if (0 !== $("#kt_calendar").length) {
                    var t = moment().startOf("day");
                    t.format("YYYY-MM"), t.clone().subtract(1, "day").format("YYYY-MM-DD"), t.format("YYYY-MM-DD"), t.clone().add(1, "day").format("YYYY-MM-DD"), $("#kt_calendar").fullCalendar({
                        isRTL: KTUtil.isRTL(),
                        header: {
                            left: "prev,next today",
                            center: "title",
                            right: "month,agendaWeek,agendaDay,listWeek"
                        },
                        editable: !0,
                        eventLimit: !0,
                        navLinks: !0,
                        defaultDate: moment("2017-09-15"),
                        events: [{
                            title: "Meeting",
                            start: moment("2017-08-28"),
                            description: "Lorem ipsum dolor sit incid idunt ut",
                            className: "fc-event-light fc-event-solid-warning"
                        }, {
                            title: "Conference",
                            description: "Lorem ipsum dolor incid idunt ut labore",
                            start: moment("2017-08-29T13:30:00"),
                            end: moment("2017-08-29T17:30:00"),
                            className: "fc-event-success"
                        }, {
                            title: "Dinner",
                            start: moment("2017-08-30"),
                            description: "Lorem ipsum dolor sit tempor incid",
                            className: "fc-event-light  fc-event-solid-danger"
                        }, {
                            title: "All Day Event",
                            start: moment("2017-09-01"),
                            description: "Lorem ipsum dolor sit incid idunt ut",
                            className: "fc-event-danger fc-event-solid-focus"
                        }, {
                            title: "Reporting",
                            description: "Lorem ipsum dolor incid idunt ut labore",
                            start: moment("2017-09-03T13:30:00"),
                            end: moment("2017-09-04T17:30:00"),
                            className: "fc-event-success"
                        }, {
                            title: "Company Trip",
                            start: moment("2017-09-05"),
                            end: moment("2017-09-07"),
                            description: "Lorem ipsum dolor sit tempor incid",
                            className: "fc-event-primary"
                        }, {
                            title: "ICT Expo 2017 - Product Release",
                            start: moment("2017-09-09"),
                            description: "Lorem ipsum dolor sit tempor inci",
                            className: "fc-event-light fc-event-solid-primary"
                        }, {
                            title: "Dinner",
                            start: moment("2017-09-12"),
                            description: "Lorem ipsum dolor sit amet, conse ctetur"
                        }, {
                            id: 999,
                            title: "Repeating Event",
                            start: moment("2017-09-15T16:00:00"),
                            description: "Lorem ipsum dolor sit ncididunt ut labore",
                            className: "fc-event-danger"
                        }, {
                            id: 1e3,
                            title: "Repeating Event",
                            description: "Lorem ipsum dolor sit amet, labore",
                            start: moment("2017-09-18T19:00:00")
                        }, {
                            title: "Conference",
                            start: moment("2017-09-20T13:00:00"),
                            end: moment("2017-09-21T19:00:00"),
                            description: "Lorem ipsum dolor eius mod tempor labore",
                            className: "fc-event-success"
                        }, {
                            title: "Meeting",
                            start: moment("2017-09-11"),
                            description: "Lorem ipsum dolor eiu idunt ut labore"
                        }, {
                            title: "Lunch",
                            start: moment("2017-09-18"),
                            className: "fc-event-info fc-event-solid-success",
                            description: "Lorem ipsum dolor sit amet, ut labore"
                        }, {
                            title: "Meeting",
                            start: moment("2017-09-24"),
                            className: "fc-event-warning",
                            description: "Lorem ipsum conse ctetur adipi scing"
                        }, {
                            title: "Happy Hour",
                            start: moment("2017-09-24"),
                            className: "fc-event-light fc-event-solid-focus",
                            description: "Lorem ipsum dolor sit amet, conse ctetur"
                        }, {
                            title: "Dinner",
                            start: moment("2017-09-24"),
                            className: "fc-event-solid-focus fc-event-light",
                            description: "Lorem ipsum dolor sit ctetur adipi scing"
                        }, {
                            title: "Birthday Party",
                            start: moment("2017-09-24"),
                            className: "fc-event-primary",
                            description: "Lorem ipsum dolor sit amet, scing"
                        }, {
                            title: "Company Event",
                            start: moment("2017-09-24"),
                            className: "fc-event-danger",
                            description: "Lorem ipsum dolor sit amet, scing"
                        }, {
                            title: "Click for Google",
                            url: "http://google.com/",
                            start: moment("2017-09-26"),
                            className: "fc-event-solid-info fc-event-light",
                            description: "Lorem ipsum dolor sit amet, labore"
                        }],
                        eventRender: function (t, e) {
                            e.hasClass("fc-day-grid-event") ? (e.data("content", t.description), e.data("placement", "top"), KTApp.initPopover(e)) : e.hasClass("fc-time-grid-event") ? e.find(".fc-title").append('<div class="fc-description">' + t.description + "</div>") : 0 !== e.find(".fc-list-item-title").lenght && e.find(".fc-list-item-title").append('<div class="fc-description">' + t.description + "</div>")
                        }
                    })
                }
            }(), e = $("#kt_earnings_widget .kt-widget30__head .owl-carousel"), a = $("#kt_earnings_widget .kt-widget30__body .owl-carousel"), e.find(".carousel").each(function (t) {
                $(this).attr("data-position", t)
            }), e.owlCarousel({
                rtl: KTUtil.isRTL(),
                center: !0,
                loop: !0,
                items: 2
            }), a.owlCarousel({
                rtl: KTUtil.isRTL(),
                items: 1,
                animateIn: "fadeIn(100)",
                loop: !0
            }), $(document).on("click", ".carousel", function () {
                var t = $(this).attr("data-position");
                t && (e.trigger("to.owl.carousel", t), a.trigger("to.owl.carousel", t))
            }), e.on("changed.owl.carousel", function () {
                var t = $(this).find(".owl-item.active.center").find(".carousel").attr("data-position");
                t && a.trigger("to.owl.carousel", t)
            }), a.on("changed.owl.carousel", function () {
                var t = $(this).find(".owl-item.active.center").find(".carousel").attr("data-position");
                t && e.trigger("to.owl.carousel", t)
            });
            var r = new KTDialog({type: "loader", placement: "top center", message: "Loading ..."});
            r.show(), setTimeout(function () {
                r.hide()
            }, 3e3)
        }
    }
}();
jQuery(document).ready(function () {
    KTDashboard.init()
});