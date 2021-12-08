<template>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">Sales <small>Report</small></h3>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
          <table
            id="sampleTable"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>id</th>
                <th>name</th>
                <th>phone</th>
                <th>address</th>
                <th>Registered On</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list, index) in customers" :key="index">
                <td>{{ list.id }}</td>
                <td>{{ list.name }}</td>
                <td>{{ list.phone }}</td>
                <td>{{ list.address }}</td>
                <td>{{ list.created_at | myDate }}</td>
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
import "datatables.net";
import datatable from "datatables.net-bs4";

require("datatables.net-buttons/js/dataTables.buttons");
require("datatables.net-buttons/js/buttons.html5");
import print from "datatables.net-buttons/js/buttons.print";
import jszip from "jszip/dist/jszip";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";

pdfMake.vfs = pdfFonts.pdfMake.vfs;
window.JSZip = jszip;
export default {
  mounted() {
    this.getCustomer();
  },
  data() {
    return {
      customers: [],
    };
  },

  methods: {
    table() {
      this.$nextTick(() => {
        $("#sampleTable").DataTable({
          dom:
            "<'row'<'col-sm-12 mb-3 text-center'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

          buttons: [
            {
              extend: "copyHtml5",
              text: "<i class='fas fa-copy'><i> Copy",
              titleAttr: "Copy",
              className: "btn btn-sm btn-rounded btn-outline-primary",
            },
            {
              extend: "excelHtml5",
              text: "<i class='fas fa-file-excel'><i> Excel",
              titleAttr: "Export as Excel",
              className: "btn btn-sm btn-rounded btn-outline-success",
            },
            {
              extend: "pdfHtml5",
              text: "<i class='fas fa-file-pdf'><i> PDF",
              titleAttr: "Export as PDF",
              className: "btn btn-sm btn-rounded btn-outline-info",
            },
            {
              extend: "csvHtml5",
              text: "<i class='fas fa-file-csv'><i> CSV",
              titleAttr: "Export as CSV",
              className: "btn btn-sm btn-rounded btn-outline-warning",
            },
            {
              extend: "print",
              text: "<i class='fas fa-print'><i> Print",
              titleAttr: "Print File",
              className: "btn btn-sm btn-rounded btn-outline-danger",
            },
          ],
        });
      });
    },

    getCustomer() {
      axios
        .get("api/customer")
        .then((response) => {
          this.customers = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch Data");
        });
    },
  },
};
</script>