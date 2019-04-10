// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


// Grafico de barra, medicamentos más vendidos
function top_meds(_ctx, _labels, _datos, _max) {
  // Bar Chart Example
  var ctx = _ctx;
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: _labels,
      datasets: [{
        label: "Total:",
        backgroundColor: ["#2f89fc", "yellow", "#658525", "#7d0000", "#04dead", "#ff7100"],
        hoverBackgroundColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000"],
        borderColor: ["#2f89fc", "yellow", "#658525", "#7d0000", "#04dead", "#ff7100"],
        data: _datos,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          // time: {
          //   unit: 'month'
          // },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: _max,
            maxTicksLimit: 5,
            padding: 10
            // // Include a dollar sign in the ticks
            // callback: function (value, index, values) {
            //   return '$' + number_format(value);
            // }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        // callbacks: {
        //   label: function (tooltipItem, chart) {
        //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
        //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        //   }
        // }
      },
    }
  });

}

// Gráfico de barra, categorías más usadas
function top_cats(_ctx, _labels, _datos) {
  // Bar Chart Example
  var ctx = _ctx;
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: _labels,
      datasets: [{
        data: _datos,
        backgroundColor: ["#355C7D", "#6C5B7B", "#74C476", "#C06C84", "#F67280", "#F8b195"],
        hoverBackgroundColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000"],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: true
      },
      cutoutPercentage: 80,
    },
  });

}