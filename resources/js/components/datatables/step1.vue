<template>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">Sales <small>Report</small></h3>
      </div>
      <div class="block-content block-content-full">
        <table class="table" id="sampleTable">
          <thead>
            <tr>
              <th>name</th>
              <th>age</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>sohan</td>
              <td>20</td>
            </tr>
            <tr>
              <td>sazid</td>
              <td>28</td>
            </tr>
            <tr>
              <td>rabbi</td>
              <td>30</td>
            </tr>
            <tr>
              <td>urmi</td>
              <td>22</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import datatable from "datatables.net-bs4";
// import $ from "jquery";
export default {
  mounted() {
    this.table();
  },
  data() {
    return {};
  },

  methods: {
    table() {
      this.$nextTick(() => {
        $.noConflict();
        $("#sampleTable").DataTable();
      });
    },
  },
};
</script>