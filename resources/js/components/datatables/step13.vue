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
              <th>id</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import * as $ from "jquery";
import "datatables.net";
import datatable from "datatables.net-bs4";
export default {
  mounted() {
    this.getCustomer();
  },
  data() {
    return {};
  },

  methods: {
    table(data) {
      let tableData = data;
      $("#sampleTable").DataTable({
        data: tableData,
        columns: [
          { data: "id" },
          { data: "name" },
          { data: "phone" },
          { data: "address" },
        ],
      });
    },

    getCustomer() {
      axios
        .get("api/customer")
        .then((response) => {
          let dt = response.data;
          this.table(dt);
        })
        .catch((error) => {
          alert("unable to fetch invoiceList");
        });
    },
  },
};
</script>