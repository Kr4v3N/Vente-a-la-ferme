Highcharts.chart('containerJs', {

    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, '#2a2a2b'],
                [1, '#3e3e40']
            ]
        },
        style: {
            fontFamily: '\'Unica One\', sans-serif'
        },
        plotBorderColor: '#606063'
    },

    title: {
        text: 'Nombre de visiteurs dans l\'année',
        style: {
                color: "#fff",
                fontSize: "30px",
                fontStyle: "normal"
            }
        },

    xAxis: {

        categories: ['Janvier', 'Février',
            'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre',
            'Octobre', 'Novembre', 'Décembre'],

    },

    yAxis: {
        title: {
            text: 'Visiteurs',
            style: {
                color: "#fff",
                fontSize: "30px",
                fontStyle: "normal"
            }
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },

    tooltip: {
        crosshairs: true,
        shared: true,
        backgroundColor: "rgba(247,247,247,0.85)"
    },

    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: 'greenyellow',
                lineWidth: 5
            }
        }
    },

    series: [{
        name: 'Producteurs',

        color: "#76ff03",
        colorByPoint: false,
        turboThreshold: 0,
        _colorIndex: 0,
        _symbolIndex: 0,
        marker: {
            enabled: true,
            symbol: 'square'
        },

        data: [7, 8, 9, 14, 18, 21, 25, {
            y: 26,
            marker: {
                symbol: 'square'
            }
        }, 28, 30, 33, 55]

    }, {
        name: 'Consomateurs',
        color: "#00b0ff",
        colorByPoint: false,
        dashStyle: "Solid",
        marker: {
            symbol: 'diamond'
        },

        data: [{
            y: 3,
            marker: {
                symbol: ''
            }
        }, 4, 5, 8, 11, 15, 17, 16, 18, 23, 32, 44]}]

});


