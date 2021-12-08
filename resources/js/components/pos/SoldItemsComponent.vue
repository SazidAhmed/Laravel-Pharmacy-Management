<template>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"></h3>
        <div class="block-options"></div>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
          <table
            id="soldItemTable"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Sales Date</th>
                <th>Invoice ID</th>
                <th>Item ID</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in soldItems" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>
                  {{ item.medicine.name }}
                </td>

                <td>
                  {{ item.medicine.price }}
                </td>
                <td>
                  {{ item.qty }}
                </td>
                <td>
                  {{ item.amount }}
                </td>
                <td>
                  {{ item.created_at | myDate }}
                </td>
                <td>
                  {{ item.invoice_id }}
                </td>
                <td>
                  {{ item.medicine_id }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import * as $ from "jquery";
import datatable from "datatables.net-bs4";
export default {
  data() {
    return {
      soldItems: [],
    };
  },
  created() {
    this.getSoldItems();
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#soldItemTable").DataTable();
      });
    },
    //Sold Item List
    getSoldItems() {
      axios
        .get("/api/soldItems")
        .then((response) => {
          this.soldItems = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch categories");
        });
    },
  },
};
</script>
<style type="text/css">
.danger {
  color: red;
}
</style>