<template>
  <canvas id="doughnut"></canvas>
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
      const ctx = document.getElementById("doughnut").getContext("2d");
      Chart.defaults.global.defaultFontFamily = "Lato";
      const myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Yesterday", "Today"],
          datasets: [
            {
              label: "Sales",
              data: data,
              backgroundColor: [
                "rgba(255, 99, 132, 0.3)",
                "rgba(75, 192, 192, 0.3)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(75, 192, 192, 0.2)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          title: {
            display: true,
            text: "Sales Ratio",
            position: "top",
          },
          legend: {
            display: true,
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
        .get("/api/todayEarningGraph")
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