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
    table() {
      this.$nextTick(() => {
        $("#sampleTable").DataTable({
          data: [
            { id: 9, name: "Rony", phone: "019911223355", address: "Germany" },
            {
              id: 8,
              name: "Samiha Mahmud",
              phone: "01919900444",
              address: "Dhaka",
            },
          ],
          columns: [
            { data: "id" },
            { data: "name" },
            { data: "phone" },
            { data: "address" },
          ],
        });
      });
    },

    getCustomer() {
      axios
        .get("api/customer")
        .then((response) => {
          let data = response.data;
          this.customers = response.data;
          // this.table(data);
          // this.loaded = true;

          console.log(this.customers);
        })
        .catch((error) => {
          alert("unable to fetch invoiceList");
        });
    },
  },
};
</script>