var lineChartoptions = {
    series: [],
    chart: {
        height: 350,
        type: "line",
        background: !1,
        zoom: {
            enabled: !1
        },
        toolbar: {
            show: !1
        }
    },
    stroke: {
        show: !0,
        curve: "smooth",
        lineCap: "round",
        width: [3],
    },
    dataLabels: {
        enabled: !1
    },
    xaxis: {
        type: "datetime",
        categories: [],
        labels: {
            show: !0,
            style: {
                colors: '#000',
                cssClass: "text-muted",
                fontFamily: 'Arial'
            }
        },
        axisBorder: {
            show: !1
        }
    },
    yaxis: {
        labels: {
            show: !0,
            style: {
                colors: '#000',
                cssClass: "text-muted",
                fontFamily: 'Arial'
            }
        }
    },
    legend: {
        position: "top",
        fontFamily: 'Arial',
        fontWeight: 400,
        markers: {
            radius: 6
        },
        itemMargin: {
            horizontal: 10
        }
    },
    grid: {
        show: !0,
        borderColor: '#e0e0e0'
    }
};

lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartoptions);
lineChart.render();
