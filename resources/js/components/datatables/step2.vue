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
              <th>name</th>
              <th>phone</th>
              <th>address</th>
            </tr>
          </thead>
          <tbody></tbody>
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
    this.getInvoice();
  },
  data() {
    return {};
  },

  methods: {
    // table() {
    //   this.$nextTick(() => {
    //     $("#sampleTable").DataTable();
    //   });
    // },

    getInvoice() {
      axios
        .get("api/customer")
        .then((response) => {
          $("#sampleTable").DataTable({
            data: response.data,
            columns: [
              { data: "id" },
              { data: "name" },
              { data: "phone" },
              { data: "address" },
            ],
          });
          console.log(response.data);
        })
        .catch((error) => {
          alert("unable to fetch invoiceList");
        });
    },
  },
};
</script>