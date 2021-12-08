<template>
  <canvas id="line"></canvas>
</template>
<script>
import Chart from "chart.js";

export default {
  data: () => ({}),
  mounted() {
    this.getChartData();
  },
  methods: {
    renderChart(data, labels) {
      const ctx = document.getElementById("line").getContext("2d");
      Chart.defaults.global.defaultFontFamily = "Lato";
      const myChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Sales",
              data: data,
              backgroundColor: ["rgba(153, 102, 255, 0.2)"],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          title: {
            display: true,
            text: "Sales Of The Month",
            position: "top",
          },
          legend: {
            display: false,
            position: "bottom",
            labels: {
              fontColor: "black",
            },
          },
          layouts: {
            padding: {
              left: 50,
              right: 0,
              bottom: 0,
              top: 0,
            },
          },
          tooltips: {
            enabled: true,
          },
        },
      });
    },

    getChartData() {
      axios
        .get("/api/monthlyEarningGraph")
        .then((response) => {
          let labels = response.data.label;
          let earning = response.data.earning;
          this.renderChart(earning, labels);
        })
        .catch((error) => {
          alert("unable to fetch ChartData");
        });
    },
  },
};
</script>