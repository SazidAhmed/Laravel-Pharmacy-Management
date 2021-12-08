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
            id="reportTable"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Sale By</th>
                <th>Customer</th>
                <th>Payment</th>
                <th>Medicines</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list, index) in invoiceList" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>#INV{{ list.id }}</td>
                <td>
                  {{ list.created_at | myDate }}
                </td>
                <td>
                  {{ list.user.username | upText }}
                </td>
                <td>
                  {{ list.customer.name | upText }}
                </td>
                <td>৳ {{ list.payment }}</td>
                <td>
                  <a href="#" @click.prevent="showInvoice(list.id)"
                    ><i class="fa fa-fw fa-eye text-success"></i
                  ></a>
                </td>
                <td class="">
                  <a href="#" @click.prevent="deleteRecord(list.id)"
                    ><i class="fa fa-fw fa-trash-alt text-danger"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Modal -- -->
    <div
      class="modal"
      id="InvoiceItemsModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-block-normal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 class="block-title">Medicines</h3>
              <div class="block-options">
                <button
                  type="button"
                  class="btn-block-option"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            <div class="block-content font-size-sm">
              <div class="table-responsive push">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 60px">Index</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Name</th>
                      <th class="text-center" style="width: 90px">Qty</th>
                      <th class="text-right" style="width: 120px">Unit</th>
                      <th class="text-right" style="width: 120px">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in invoiceItems" :key="index">
                      <td class="text-center">{{ index + 1 }}</td>
                      <td class="text-center">
                        <img
                          :src="'/medicine/' + item.medicine.image"
                          height="60"
                          alt="No Image"
                        />
                      </td>
                      <td class="text-center">
                        <p class="font-w600 mb-1 text-muted">
                          {{ item.medicine.name }}
                        </p>
                      </td>
                      <td class="text-center">{{ item.qty }}</td>
                      <td class="text-right">৳ {{ item.medicine.price }}</td>
                      <td class="text-right">৳ {{ item.amount }}</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="font-w600 text-right">Subtotal</td>
                      <td class="text-right">৳ {{ invoiceItemTotal }}</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="font-w600 text-right">Discount</td>
                      <td class="text-right">৳ 0.00</td>
                    </tr>
                    <tr>
                      <td
                        colspan="5"
                        class="font-w700 text-uppercase text-right bg-body-light"
                      >
                        Total Payment
                      </td>
                      <td class="font-w700 text-right bg-body-light">
                        ৳ {{ invoiceItemTotal - 0 }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as $ from "jquery";
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
  data() {
    return {
      invoiceList: [],
      invoiceItems: [],
      invoiceItemTotal: [],
    };
  },
  created() {
    this.getInvoice();
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#reportTable").DataTable({
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

    //invoice List
    getInvoice() {
      axios
        .get("/api/yearlySales")
        .then((response) => {
          this.invoiceList = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch invoiceList");
        });
    },
    //single invoice Items
    showInvoice(id) {
      axios
        .get("/invoice/" + id)
        .then((response) => {
          this.invoiceItems = response.data;
          this.total();
          $("#InvoiceItemsModal").modal("show");
        })
        .catch((error) => {
          alert("unable to to fetch invoiceItems");
        });
    },
    total() {
      let subtotal = 0;
      for (var i = 0; i < this.invoiceItems.length; i++) {
        let item = this.invoiceItems[i];
        let totalPrice =
          parseInt(this.invoiceItems[i].qty) *
          parseFloat(this.invoiceItems[i].medicine.price);
        // console.log(totalPrice);
        subtotal = subtotal + totalPrice;
        this.invoiceItemTotal = subtotal;
      }
    },
    deleteRecord(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success ",
          cancelButton: "btn btn-danger float-right",
        },
      });
      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "All Invoice Details Will Be Deleted.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios.delete("/invoice/" + id).then((response) => {
              swalWithBootstrapButtons.fire(
                "Deleted!",
                "Invoice has been deleted.",
                "success"
              );
              this.getInvoice();
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelled",
              "Invoice is safe :)",
              "error"
            );
          }
        });
    },
  },
};
</script>