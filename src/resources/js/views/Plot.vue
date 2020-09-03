<template>
  <div class="container d-flex items-center justify-center text-center">
    <div class="row h-100 w-100">
      <div class="col-sm-12 align-self-center">
        <div id="graph"></div>
      </div>
    </div>
    <!-- Loading Animation -->
    <div v-if="loaded==false" class="custom-animation">
      <div class="center">
        <div class="custom-roller">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Plotly from "plotly.js-dist";

export default {
  data() {
    return {
      loaded: false,
    };
  },
  mounted() {
    axios
      .get(`/api/plotData/${this.$route.params.url_hash}`)
      .then((response) => {
        this.loaded = true;
        let data = Object.keys(response.data[0]).map((key) =>
          response.data.map((val) => val[key])
        );
        let traces = data.slice(1).map((val, idx) => {
          if (idx > 0) {
            return {
              x: data[0],
              y: val,
              xaxis: `x${idx + 1}`,
              yaxis: `y${idx + 1}`,
              type: "scatter",
            };
          } else {
            return { x: data[0], y: val, type: "scatter" };
          }
        });
        let length = Object.keys(response.data[0]).length;
        let layout = {
          grid: { rows: length / 2, columns: 2, pattern: "independent" },
        };
        Plotly.newPlot("graph", traces, layout);
      });
  },
  methods: {},
};
</script>