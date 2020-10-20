var symbols, liveprice;

function ChartStoreAjax() {
    if (xmlHttp = GetXmlHttpObject(), null != xmlHttp) {
        xmlHttp.open("GET", "charts/chart_data.php", !0), xmlHttp.send(null)
    } else alert("Your browser does not support AJAX!")
}

function GetXmlHttpObject() {
    var t = null;
    try {
        t = new XMLHttpRequest
    } catch (a) {
        try {
            t = new ActiveXObject("Msxml2.XMLHTTP")
        } catch (a) {
            t = new ActiveXObject("Microsoft.XMLHTTP")
        }
    }
    return t
}

function InitializeSymbols() {
    $.ajax({
        type: "GET",
        cache: !1,
        url: "charts/symbols.php",
        data: {
            fmt: "json"
        },
        dataType: "json",
        success: function(t) {
            symbols = t, LoadSymbols(), ChartLiveData()
        }
    })
}

function LoadSymbols() {
    var t = $("#symbol");
    if (null != t) {
        $.each(symbols, function(a, e) {
            $("<option>", {
                text: e.display,
                value: e.code
            }).appendTo(t)
        }), ChangeChart($("#symbol option:first").attr("value"))
    }
}

function ChartLiveData() {
    if (!(null == symbols || symbols.length <= 0)) try {
        $.ajax({
            type: "GET",
            cache: !1,
            url: "charts/live_data.php",
            data: {
                fmt: "json"
            },
            dataType: "json",
            success: function(t, a, e) {
                liveprice = t, UpdateLiveData(!1)
            },
            complete: function(t, a) {}
        })
    } finally {
        setTimeout("ChartLiveData()", 5e3)
    }
}

function InitializeCharts() {
    $('[data-chart="highchart"]').each(function() {
        var t = $(this),
            a = $(this).find(".chartarea"),
            e = t.data("symbol"),
            i = t.data("plotlinewidth"),
            n = t.data("spacing"),
            l = t.data("showlabels");
        null == i && (i = 0), null == n && (n = 0), null == l && (l = !1), a.highcharts({
            credits: {
                enabled: !1
            },
            exporting: {
                enabled: !1
            },
            chart: {
                zoomType: "x",
                resetZoomButton: {
                    position: {
                        align: "left",
                        verticalAlign: "top",
                        x: 10,
                        y: 10
                    },
                    relativeTo: "chart"
                },
                backgroundColor: "#ffffff",
                spacing: [n, n, n, n],
                borderWidth: 0,
                plotBorderWidth: 0,
                style: {
                    fontFamily: '"Roboto", sans-serif, Verdana, Arial, Helvetica',
                    fontSize: "12px"
                }
            },
            title: {
                text: ""
            },
            loading: {
                style: {
                    backgroundColor: "transparent"
                }
            },
            lang: {
                loading: "Loading...",
                noData: "No data to display"
            },
            noData: {
                style: {
                    fontWeight: "bold",
                    fontSize: "15px",
                    color: "#303030"
                }
            },
            legend: {
                enabled: !1
            },
            xAxis: {
                type: "datetime",
                gridLineWidth: 0,
                lineColor: "#000",
                lineWidth: 0,
                tickColor: "#000",
                tickWidth: 0,
                crosshair: !0,
                labels: {
                    enabled: l,
                    style: {
                        color: "#000"
                    },
                    y: -10,
                    format: "{value:%H:%M:%S}"
                }
            },
            yAxis: {
                title: {
                    text: ""
                },
                gridLineWidth: 1,
                lineColor: "#000",
                lineWidth: 0,
                tickWidth: 0,
                tickColor: "#000",
                labels: {
                    enabled: !1,
                    style: {
                        color: "#000"
                    }
                }
            },
            tooltip: {
                crosshairs: !0,
                pointFormat: "<b>{point.y}</b>"
            },
            plotOptions: {
                series: {
                    lineColor: "#41AE43",
                    lineWidth: i,
                    marker: {
                        enabled: !1
                    }
                },
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.Color("#BAE3B9").setOpacity(.9).get("rgba")],
                            [1, Highcharts.Color("#BAE3B9").setOpacity(.9).get("rgba")]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 0,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            series: [{
                type: "area"
            }]
        }), null != e && setTimeout(Highcharts.DownloadChart(a, e, null), 500)
    })
}

function ChangeChart(t) {
    var a = $("#chartmain")[0];
    $(a).parent().attr("data-symbol", t), Highcharts.DownloadChart(a, t, $("#latesttime")[0]), $(a).parent().find(".price").html(""), $(a).parent().find(".change").html(""), UpdateLiveData(!0)
}

function UpdateLiveData(t) {
    null == liveprice || liveprice.length <= 0 || $.each(liveprice, function(a, e) {
        var i = parseFloat(e.change),
            n = i < 0,
            l = Highcharts.DecimalPlaces(e.bid);
        l++;
        try {
            null != (s = $('[data-marketsymbol="' + e.code + '"]')) && s.length > 0 && e.bid && e.ask && s.each(function() {
                var t = $(this).find('[data-field="bid"]');
                t && UpdatePriceNode(t, e.bid);
                var a = $(this).find('[data-field="ask"]');
                a && UpdatePriceNode(a, e.ask);
                var i = $(this).find('[data-field="high"]');
                i && UpdatePriceNode(i, e.high);
                var n = $(this).find('[data-field="low"]');
                n && UpdatePriceNode(n, e.low), $(this).hasClass("hide") && $(this).removeClass("hide")
            })
        } catch (t) {}
        null != (s = $('[data-chart="highchart"][data-symbol="' + e.code + '"] .price')) && s.length > 0 && s.each(function() {
            $(this).html("<div class='col-6 col-md-6 text-center text-md-left pl-4'><p>Bid&nbsp;&nbsp;&nbsp;"+ e.bid +"</p><p>Ask&nbsp;&nbsp;&nbsp;" + e.ask + "</p></div>")
        }), null != (s = $('[data-chart="highchart"][data-symbol="' + e.code + '"] .change')) && s.length > 0 && s.each(function() {
            $(this).html('<span class="' + (n ? "down" : "up") + '"><strong>' + i.toFixed(l) + '<i class="fa fa-arrow-circle-' + (n ? "down" : "up") + '" aria-hidden="true"></i></strong></span>')
        });
        try {
            var s;
            null != (s = $('[data-chart="highchart"][data-symbol="' + e.code + '"]')) && s.length > 0 && s.each(function() {
                $(this);
                var a = $(this).find(".chartarea"),
                    e = $(a).highcharts(),
                    i = $(this).data("change");
                null == i && (i = !0), $(this).attr("data-change", i), (n == i || t) && e.series[0].update({
                    lineColor: n ? "#E94B2A" : "#41AE43",
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.Color(n ? "#FFCCCA" : "#BAE3B9").setOpacity(.9).get("rgba")],
                            [1, Highcharts.Color(n ? "#FFCCCA" : "#BAE3B9").setOpacity(.9).get("rgba")]
                        ]
                    }
                }, !0)
            })
        } catch (t) {}
    })
}

function UpdatePriceNode(t, a) {
    var e = parseFloat("0" + $(t).text());
    0 == e || e == a ? $(t).html("<span>" + a + "</span>") : e > a ? $(t).html('<span class="down">' + a + "</span>") : e < a && $(t).html('<span class="up">' + a + "</span>")
}
jQuery(document).ready(function(t) {
    setTimeout("ChartStoreAjax()", 3e5), InitializeCharts(), InitializeSymbols(), t("#symbol").change(function() {
        ChangeChart(this.value)
    })
}), Date.parseDateTime = function(t, a) {
    if ("" == a || "" == t) return null;
    var e = new Date(t);
    return e.setHours(parseInt(a.substring(0, 2))), e.setMinutes(parseInt(a.substring(3, 5))), e.setSeconds(parseInt(a.substring(6, 8))), e
}, Date.prototype.getUTCTime = function() {
    return Date.UTC(this.getFullYear(), this.getMonth(), this.getDate(), this.getHours(), this.getMinutes(), this.getSeconds(), this.getMilliseconds())
}, Date.prototype.getMonthName = function() {
    return month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], month_names[this.getMonth()]
}, Highcharts.DecimalPlaces = function(t) {
    var a = ("" + t).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return a ? Math.max(0, (a[1] ? a[1].length : 0) - (a[2] ? +a[2] : 0)) : 0
}, Highcharts.DownloadChart = function(t, a, e) {
    var n = $(t).highcharts(),
        l = null,
        s = null,
        r = null,
        o = [];
    n.showLoading(), $.ajax({
        type: "GET",
        cache: !1,
        url: "charts/data/" + a + ".xml",
        dataType: "xml",
        success: function(t) {
            $(t).find("value").each(function() {
                (s = $(this).find("date").text()) && (r = $(this).find("time").text(), priceval = parseFloat($(this).find("price").text()), i = Highcharts.DecimalPlaces(priceval), (null == l || i > l) && (l = i), o.push([Date.parseDateTime(s, r).getUTCTime(), priceval]))
            })
        },
        complete: function(t, i) {
            if (n.hideLoading(), n.yAxis[0].update({
                    labels: {
                        format: null == l ? "{value}" : "{value:." + l + "f}"
                    },
                    series: [{
                        name: a
                    }]
                }, !1), n.series[0].name = a, n.series[0].setData(o, !1), n.redraw(), e && s) {
                var h = Date.parseDateTime(s, r);
                h.getHours(), h.getMinutes();
                $(e).html('<span class="time">' + r.slice(0, 5) + ' (GMT)</span> | <span class="date">' + s.slice(3, 5) + " " + h.getMonthName() + " " + h.getFullYear() + "</span>")
            }
        }
    })
};