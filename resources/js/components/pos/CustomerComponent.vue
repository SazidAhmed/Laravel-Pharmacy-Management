<template>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"></h3>
        <div class="block-options">
          <a
            href=""
            class="btn btn-success btn-square mr-1 mb-3"
            data-toggle="modal"
            @click.prevent="createModal"
            ><i class="fa fa-fw fa-plus-circle mr-1"></i> New</a
          >
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
          <table
            id="customer"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>C-ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registerd On</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(customer, index) in customers" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>CID{{ customer.id }}</td>
                <td>
                  {{ customer.name | upText }}
                </td>
                <td>
                  {{ customer.phone | upText }}
                </td>
                <td>
                  {{ customer.address | upText }}
                </td>
                <td>
                  {{ customer.created_at | myDate }}
                </td>
                <td>
                  <a href="" @click.prevent="editModal(customer.id)"
                    ><i class="fa fa-fw fa-pencil-alt text-primary"></i
                  ></a>
                  <a href="#" @click.prevent="deleteRecord(customer.id)"
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
      id="CustomerModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-block-normal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 v-show="!editmode" class="block-title">Add New Customer</h3>
              <h3 v-show="editmode" class="block-title">Update Customer</h3>
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
            <form
              @submit.prevent="editmode ? updateCustomer() : createCustomer()"
              enctype="multipart/form-data"
            >
              <div class="block-content font-size-sm">
                <div v-if="!editmode" class="form-group">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="name"
                    name="name"
                    v-model="name"
                    placeholder="Name here..."
                    maxlength="30"
                    required=""
                  />
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="name"
                    name="name"
                    v-model="records.name"
                    placeholder="Name here..."
                    maxlength="30"
                    required=""
                  />
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="phone">Phone</label>
                  <input
                    type="number"
                    class="form-control is-valid"
                    id="phone"
                    name="phone"
                    v-model="phone"
                    placeholder="Contact Number here..."
                    maxlength="30"
                    required=""
                  />
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="phone">Phone</label>
                  <input
                    type="number"
                    class="form-control is-valid"
                    id="phone"
                    name="phone"
                    v-model="records.phone"
                    placeholder="Contact Number here..."
                    maxlength="30"
                    required=""
                  />
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="address">Address</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="address"
                    name="address"
                    v-model="address"
                    placeholder="Address here..."
                    maxlength="50"
                    required=""
                  />
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="address">Address</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="address"
                    name="address"
                    v-model="records.address"
                    placeholder="Address here..."
                    maxlength="50"
                    required=""
                  />
                </div>
              </div>
              <div
                class="block-content block-content-full text-right border-top"
              >
                <button
                  type="button"
                  class="btn btn-danger btn-square mb-1"
                  data-dismiss="modal"
                >
                  <i class="fa fa-fw fa-times mr-1"></i> Cancel
                </button>
                <button type="submit" class="btn btn-success btn-square mb-1">
                  <i class="fa fa-fw fa-check-circle mr-1"></i> submit
                </button>
              </div>
            </form>
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
      id: "",
      name: "",
      phone: "",
      address: "",
      editmode: false,
      success: false,
      customers: [],
      allerrors: [],
      records: [],
    };
  },
  created() {
    this.getCustomers();

    Fire.$on("recordUpdate", () => {
      this.getCustomers();
      this.reset();
    });
    // setInterval(() => this.getCategories(), 3000);
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#customer").DataTable({
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
          retrieve: true,
        });
      });
    },
    //customer list
    getCustomers() {
      axios
        .get("/api/customer")
        .then((response) => {
          this.customers = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch customers");
        });
    },
    reset() {
      this.name = "";
      this.phone = "";
      this.address = "";
    },
    createCustomer() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("phone", this.phone);
      formData.append("address", this.address);
      axios
        .post("api/customer", formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CustomerModal").modal("hide");
          // console.log(response.data);
          this.success = true;
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Data has been Created",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) => {
          console.log(error);
          this.allerrors = error.response.data.errors;
        });
    },

    updateCustomer() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.records.name);
      formData.append("phone", this.records.phone);
      formData.append("address", this.records.address);
      formData.append("_method", "put");
      axios
        .post("/api/customer/" + this.records.id, formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CustomerModal").modal("hide");
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Data has been Updated",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) => {
          console.log(error);
          this.allerrors = error.response.data.errors;
        });
    },
    createModal() {
      this.editmode = false;
      $("#CustomerModal").modal("show");
    },

    editModal(id) {
      axios
        .get("/api/customer/" + id)
        .then((response) => {
          this.records = response.data;
          this.editmode = true;
          $("#CustomerModal").modal("show");
        })
        .catch((error) => {
          alert("unable to to fetch data");
        });
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
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios.delete("/api/customer/" + id).then((response) => {
              swalWithBootstrapButtons.fire(
                "Deleted!",
                "Data has been deleted.",
                "success"
              );
              Fire.$emit("recordUpdate");
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelled",
              "Data is safe :)",
              "error"
            );
          }
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