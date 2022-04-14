// Setup of the History Chart

function updateHistoryChart() {
  var categorySelection = document.getElementById("selectHistory");
  var historyChart = document.getElementById("historyChart");
  historyChart.style.width = 3 * categorySelection.style.width;
}

function buildHistoryGraph() {
  updateHistoryChart();

  new Morris.Line({
    // ID of the element in which to draw the chart.
    element: "historyChart",
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
      { year: "2008", value: 20 },
      { year: "2009", value: 10 },
      { year: "2010", value: 5 },
      { year: "2011", value: 5 },
      { year: "2012", value: 20 },
    ],
    // The name of the data record attribute that contains x-values.
    xkey: "year",
    // A list of names of data record attributes that contain y-values.
    ykeys: ["value"],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ["Value"],
  });
}

// Setup of the Live Stock Chart

function updateLiveChart() {
  var main = document.getElementsByTagName("main")[0];
  var liveChart = document.getElementById("liveChart");
  liveChart.clientWidth = 0.5 * main.clientWidth;
  console.log(liveChart.clientWidth);
}

function buildLiveGraph() {
  updateLiveChart();

  new Morris.Line({
    // ID of the element in which to draw the chart.
    element: "liveChart",
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
      { year: "2008", value: 20 },
      { year: "2009", value: 10 },
      { year: "2010", value: 5 },
      { year: "2011", value: 5 },
      { year: "2012", value: 20 },
    ],
    // The name of the data record attribute that contains x-values.
    xkey: "year",
    // A list of names of data record attributes that contain y-values.
    ykeys: ["value"],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ["Value"],
  });
}

function removeAllChildren(parent) {
  while (parent.firstChild) {
    parent.removeChild(parent.firstChild);
  }
}

function onResize() {
  removeAllChildren(document.getElementById("historyChart"));
  buildHistoryGraph();
  removeAllChildren(document.getElementById("liveChart"));
  buildLiveGraph();
}

function onStart() {
  buildHistoryGraph();
  buildLiveGraph();
}

$(document).ready(onStart);
window.addEventListener("resize", onResize);
