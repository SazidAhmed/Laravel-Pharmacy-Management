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
              <th>created</th>
              <th>Updated</th>
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
// import $ from "jquery";
export default {
  mounted() {
    this.table();
    this.getCustomer();
  },
  data() {
    return {
      loaded: false,
      customers: [],
    };
  },

  methods: {
    table(data) {
      let tableData = data;
      console.log(tableData);
      this.$nextTick(() => {
        let data = [
          {
            id: 9,
            name: "Rony",
            phone: "019911223355",
            address: "Germany",
            created_at: "2020-12-12",
            updated_at: "2020-12-12",
          },
          {
            id: 8,
            name: "Samiha Mahmud",
            phone: "01919900444",
            address: "Dhaka",
            created_at: "2020-12-12",
            updated_at: "2020-12-12",
          },
        ];
        $("#sampleTable").DataTable({
          retrieve: true,
          paging: true,
          style: false,
          data: data,
          columns: [
            { data: "id" },
            { data: "name" },
            { data: "phone" },
            { data: "address" },
            { data: "created_at" },
            { data: "updated_at" },
          ],
        });
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