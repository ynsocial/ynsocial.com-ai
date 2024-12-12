(function () {
  "use strict";

  /* Bitcoin Chart */
  var spark1 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(227, 84, 212, 0.4)"],
  };
  document.getElementById("btc-chart").innerHTML = "";
  var spark1 = new ApexCharts(document.querySelector("#btc-chart"), spark1);
  spark1.render();

  /* Etherium Chart */
  var spark2 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("eth-chart").innerHTML = "";
  var spark2 = new ApexCharts(document.querySelector("#eth-chart"), spark2);
  spark2.render();

  /* Golem Chart */
  var spark3 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("glm-chart").innerHTML = "";
  var spark3 = new ApexCharts(document.querySelector("#glm-chart"), spark3);
  spark3.render();

  /* Dash Chart */
  var spark4 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("dash-chart").innerHTML = "";
  var spark4 = new ApexCharts(document.querySelector("#dash-chart"), spark4);
  spark4.render();

  /* Litecoin Chart */
  var spark5 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(227, 84, 212, 0.4)"],
  };
  document.getElementById("lite-chart").innerHTML = "";
  var spark5 = new ApexCharts(document.querySelector("#lite-chart"), spark5);
  spark5.render();
  
  /* Ripple Chart */
  var spark6 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("ripple-chart").innerHTML = "";
  var spark6 = new ApexCharts(document.querySelector("#ripple-chart"), spark6);
  spark6.render();

  /* Eos Chart */
  var spark7 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("eos-chart").innerHTML = "";
  var spark7 = new ApexCharts(document.querySelector("#eos-chart"), spark7);
  spark7.render();

  /* Bytecoin Chart */
  var spark8 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(227, 84, 212, 0.4)"],
  };
  document.getElementById("bytecoin-chart").innerHTML = "";
  var spark8 = new ApexCharts(document.querySelector("#bytecoin-chart"), spark8);
  spark8.render();

  /* IOTA Chart */
  var spark9 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(227, 84, 212, 0.4)"],
  };
  document.getElementById("iota-chart").innerHTML = "";
  var spark9 = new ApexCharts(document.querySelector("#iota-chart"), spark9);
  spark9.render();

  /* Monero Chart */
  var spark10 = {
    chart: {
      type: "bar",
      height: 30,
      width: 120,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: undefined,
        top: 0,
        left: 0,
        blur: 3,
        color: "#000",
        opacity: 0.1,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      colors: undefined,
      width: 0,
      dashArray: 0,
    },
    fill: {
      gradient: {
        enabled: false,
      },
    },
    series: [
      {
        name: "Value",
        data: [
          0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
          61, 27, 54, 43, 19, 46, 25, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62
        ],
      },
    ],
    yaxis: {
      min: 0,
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      enabled: false,
    },
    colors: ["rgba(33, 206, 158, 0.4)"],
  };
  document.getElementById("monero-chart").innerHTML = "";
  var spark10 = new ApexCharts(document.querySelector("#monero-chart"), spark10);
  spark10.render();

  /* Start:: Main cards charts */
var spark11 = {
  chart: {
    type: 'area',
    height: 40,
    width: 163,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      enabledOnSeries: undefined,
      top: 0,
      left: 0,
      blur: 3,
      color: '#000',
      opacity: 0.1
    }
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'butt',
    colors: undefined,
    width: 1,
    dashArray: 3,
  },
  fill: {
    gradient: {
      enabled: true
    }
  },
  series: [{
    name: 'Value',
    data: [0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46]
  }],
  yaxis: {
    min: 0,
    show: false
  },
  xaxis: {
    axisBorder: {
      show: false
    },
  },
  yaxis: {
    axisBorder: {
      show: false
    },
  },
  colors: ['rgb(33, 206, 158)'],

}
document.getElementById('bitcoin-chart').innerHTML = '';
var spark11 = new ApexCharts(document.querySelector("#bitcoin-chart"), spark11);
spark11.render();

var spark12 = {
  chart: {
    type: 'area',
    height: 40,
    width: 163,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      enabledOnSeries: undefined,
      top: 0,
      left: 0,
      blur: 3,
      color: '#000',
      opacity: 0.1
    }
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'butt',
    colors: undefined,
    width: 1,
    dashArray: 3,
  },
  fill: {
    gradient: {
      enabled: true
    }
  },
  series: [{
    name: 'Value',
    data: [0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46]
  }],
  yaxis: {
    min: 0,
    show: false
  },
  xaxis: {
    axisBorder: {
      show: false
    },
  },
  yaxis: {
    axisBorder: {
      show: false
    },
  },
  colors: ['rgb(33, 206, 158)'],

}
document.getElementById('etherium-chart').innerHTML = '';
var spark12 = new ApexCharts(document.querySelector("#etherium-chart"), spark12);
spark12.render();

var spark13 = {
  chart: {
    type: 'area',
    height: 40,
    width: 163,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      enabledOnSeries: undefined,
      top: 0,
      left: 0,
      blur: 3,
      color: '#000',
      opacity: 0.1
    }
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'butt',
    colors: undefined,
    width: 1,
    dashArray: 3,
  },
  fill: {
    gradient: {
      enabled: true
    }
  },
  series: [{
    name: 'Value',
    data: [0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46]
  }],
  yaxis: {
    min: 0,
    show: false
  },
  xaxis: {
    axisBorder: {
      show: false
    },
  },
  yaxis: {
    axisBorder: {
      show: false
    },
  },
  colors: ['rgb(227, 84, 212)'],

}
document.getElementById('dashcoin-chart').innerHTML = '';
var spark13 = new ApexCharts(document.querySelector("#dashcoin-chart"), spark13);
spark13.render();
/* End:: Main cards charts */

})();
