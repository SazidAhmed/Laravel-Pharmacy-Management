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
            id="medicineTable"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>Image</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Category</th>
                <th>Manufacturer</th>
                <th>Stock</th>
                <th>Stocked On</th>
                <th>Expire Date</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(medicine, index) in medicines" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>
                  <img
                    :src="'/medicine/' + medicine.image"
                    height="60"
                    alt="No Image"
                  />
                </td>
                <td>
                  {{ medicine.name | upText }}
                </td>
                 <td>
                  {{ medicine.unit.name | upText }}
                </td>
                <td
                  class="d-none d-sm-table-cell font-size-sm font-w600 text-muted"
                >
                  {{ medicine.price }}
                </td>
                <td>
                  {{ medicine.category.name | upText }}
                </td>
                <td>
                  {{ medicine.manufacturer.name | upText }}
                </td>
                <td>
                  {{ medicine.stock }}
                </td>
                <td>
                  {{ medicine.created_at | myDate }}
                </td>
                <td>
                  {{ medicine.expire | myDate }}
                </td>
                <td>
                  <a href="" @click.prevent="editModal(medicine.id)"
                    ><i class="fa fa-fw fa-pencil-alt text-primary"></i
                  ></a>
                  <a href="#" @click.prevent="deleteRecord(medicine.id)"
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
      id="CreatemedicineModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-block-normal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 v-show="!editmode" class="block-title">Add New medicine</h3>
              <h3 v-show="editmode" class="block-title">Update medicine</h3>
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
              @submit.prevent="editmode ? updatemedicine() : createmedicine()"
              enctype="multipart/form-data"
            >
              <div class="block-content font-size-sm">
                <div class="row">
                   <div v-if="!editmode" class="form-group col-sm-12 col-md-12">
                    <label for="name">Name</label>
                    <input
                      type="text"
                      class="form-control is-valid"
                      id="name"
                      name="name"
                      v-model="name"
                      placeholder="medicine name here..."
                      maxlength="15"
                    />
                    <span v-if="allerrors.name" :class="['danger']">
                      {{ allerrors.name[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-12 col-md-12">
                    <label for="name">Name</label>
                    <input
                      type="text"
                      class="form-control is-valid"
                      id="name"
                      name="name"
                      v-model="records.name"
                      placeholder="medicine name here..."
                      maxlength="15"
                    />
                    <span v-if="allerrors.name" :class="['danger']">
                      {{ allerrors.name[0] }}
                    </span>
                  </div>
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label>Category</label>
                    <select
                      class="form-control is-valid"
                      name="category"
                      v-model="category"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(category, index) in categories"
                        :key="index"
                        :value="category.id"
                      >
                        {{ category.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.category_id" :class="['danger']">
                      {{ allerrors.category_id[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label>Category</label>
                    <select
                      class="form-control is-valid"
                      name="category"
                      v-model="records.category_id"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(category, index) in categories"
                        :key="index"
                        :value="category.id"
                      >
                        {{ category.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.category_id" :class="['danger']">
                      {{ allerrors.category_id[0] }}
                    </span>
                  </div>
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label>Manufacturer</label>
                    <select
                      class="form-control is-valid"
                      name="manufacturer"
                      v-model="manufacturer"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(manu, index) in manufacts"
                        :key="index"
                        :value="manu.id"
                      >
                        {{ manu.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.manufacturer_id" :class="['danger']">
                      {{ allerrors.manufacturer_id[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label>Manufacturer</label>
                    <select
                      class="form-control is-valid"
                      name="manufacturer"
                      v-model="records.manufacturer_id"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(manu, index) in manufacts"
                        :key="index"
                        :value="manu.id"
                      >
                        {{ manu.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.manufacturer_id" :class="['danger']">
                      {{ allerrors.manufacturer_id[0] }}
                    </span>
                  </div>
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label>Unit</label>
                    <select
                      class="form-control is-valid"
                      name="unit"
                      v-model="unit"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(unit, index) in units"
                        :key="index"
                        :value="unit.id"
                      >
                        {{ unit.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.unit_id" :class="['danger']">
                      {{ allerrors.unit_id[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label>Unit</label>
                    <select
                      class="form-control is-valid"
                      name="unit"
                      v-model="records.unit_id"
                    >
                      <option value="">Please select here</option>
                      <option
                        v-for="(unit, index) in units"
                        :key="index"
                        :value="unit.id"
                      >
                        {{ unit.name }}
                      </option>
                    </select>
                    <span v-if="allerrors.unit_id" :class="['danger']">
                      {{ allerrors.unit_id[0] }}
                    </span>
                  </div>
                 
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label for="price">Price</label>
                    <input
                      type="number"
                      class="form-control is-valid"
                      id="price"
                      name="price"
                      v-model="price"
                      placeholder="price here..."
                    />
                    <span v-if="allerrors.price" :class="['danger']">
                      {{ allerrors.price[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label for="price">Price</label>
                    <input
                      type="number"
                      class="form-control is-valid"
                      id="price"
                      name="price"
                      v-model="records.price"
                      placeholder="price here..."
                    />
                    <span v-if="allerrors.price" :class="['danger']">
                      {{ allerrors.price[0] }}
                    </span>
                  </div>
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label for="stock">Stock</label>
                    <input
                      type="number"
                      class="form-control is-valid"
                      id="stock"
                      name="number"
                      v-model="stock"
                      placeholder="stock here..."
                    />
                    <span v-if="allerrors.stock" :class="['danger']">
                      {{ allerrors.stock[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label for="stock">Stock</label>
                    <input
                      type="number"
                      class="form-control is-valid"
                      id="stock"
                      name="stock"
                      v-model="records.stock"
                      placeholder="stock here..."
                    />
                    <span v-if="allerrors.stock" :class="['danger']">
                      {{ allerrors.stock[0] }}
                    </span>
                  </div>
                  <div v-if="!editmode" class="form-group col-sm-6 col-md-6">
                    <label for="expire">Expire Date</label>
                    <input
                      type="date"
                      class="form-control is-valid"
                      id="expire"
                      name="expire"
                      v-model="expire"
                    />
                    <span v-if="allerrors.expire" :class="['danger']">
                      {{ allerrors.expire[0] }}
                    </span>
                  </div>
                  <div v-if="editmode" class="form-group col-sm-6 col-md-6">
                    <label for="expire">Expire Date</label>
                    <input
                      type="date"
                      class="form-control is-valid"
                      id="expire"
                      name="expire"
                      v-model="records.expire"
                    />
                    <span v-if="allerrors.expire" :class="['danger']">
                      {{ allerrors.expire[0] }}
                    </span>
                  </div>
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="description">Description</label>
                  <textarea
                    class="form-control is-valid"
                    id="description"
                    name="description"
                    v-model="description"
                    placeholder="description here..."
                  ></textarea>
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="description">Description</label>
                  <textarea
                    class="form-control is-valid"
                    id="description"
                    name="description"
                    v-model="records.description"
                    placeholder="description here..."
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="image">Upload Image</label>
                  <input
                    type="file"
                    class="form-control is-valid"
                    id="image"
                    name="image"
                    v-if="uploadReady"
                    ref="fileupload"
                    v-on:change="onImageChange"
                  />
                  <span v-if="allerrors.image" :class="['danger']">
                    {{ allerrors.image[0] }}
                  </span>
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
      category: "",
      manufacturer: "",
      unit: "",
      name: "",
      price: "",
      stock: "",
      expire: "",
      description: "",
      image: "",
      uploadReady: true,
      editmode: false,
      success: false,
      manufacts: [],
      categories: [],
      medicines: [],
      units: [],
      allerrors: [],
      records: [],
    };
  },
  created() {
    this.getmedicines();
    this.getCategories();
    this.getManufacturer();
    this.getUnits();

    Fire.$on("recordUpdate", () => {
      this.getmedicines();
      this.reset();
    });
    // setInterval(() => this.getmedicines(), 3000);
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#medicineTable").DataTable({
          
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
    //Category list
    getCategories() {
      axios
        .get("/api/category")
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => {
          alert("unable to fetch categories");
        });
    },
    getUnits() {
      axios
        .get("/api/units")
        .then((response) => {
          this.units = response.data;
        })
        .catch((error) => {
          alert("unable to fetch units");
        });
    },
    getManufacturer() {
      axios
        .get("/api/manufacture")
        .then((response) => {
          this.manufacts = response.data;
        })
        .catch((error) => {
          alert("unable to fetch manufacturers");
        });
    },
    //medicine list
    getmedicines() {
      axios
        .get("/api/medicines")
        .then((response) => {
          this.medicines = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch medicines");
        });
    },
    reset() {
      this.category = "";
      this.manufacturer = "";
      this.unit = "";
      this.name = "";
      this.price = "";
      this.stock = "";
      this.expire = "";
      this.description = "";
      this.uploadReady = false;
      this.$nextTick(() => {
        this.uploadReady = true;
      });
    },
    onImageChange(e) {
      // console.log(e);
      this.image = e.target.files[0];
    },
    createmedicine() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("category_id", this.category);
      formData.append("manufacturer_id", this.manufacturer);
      formData.append("unit_id", this.unit);
      formData.append("name", this.name);
      formData.append("price", this.price);
      formData.append("stock", this.stock);
      formData.append("expire", this.expire);
      formData.append("description", this.description);
      formData.append("image", this.image);
      axios
        .post("api/medicines", formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CreatemedicineModal").modal("hide");
          // console.log(response.data);
          this.success = true;
          this.allerrors=[],
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Data has been Created",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) => {
          this.allerrors = error.response.data.errors;
        });
    },

    updatemedicine() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.records.name);
      formData.append("category_id", this.records.category_id);
      formData.append("manufacturer_id", this.records.manufacturer_id);
      formData.append("unit_id", this.records.unit_id);
      formData.append("price", this.records.price);
      formData.append("stock", this.records.stock);
      formData.append("expire", this.records.expire);
      formData.append("description", this.records.description);
      formData.append("image", this.image);
      formData.append("_method", "put");
      axios
        .post("/api/medicines/" + this.records.id, formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CreatemedicineModal").modal("hide");
          this.allerrors=[],
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
    createModal() {
      this.editmode = false;
      $("#CreatemedicineModal").modal("show");
    },

    editModal(id) {
      axios
        .get("/api/medicines/" + id)
        .then((response) => {
          this.records = response.data;
          this.editmode = true;
          $("#CreatemedicineModal").modal("show");
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
            axios.delete("/api/medicines/" + id).then((response) => {
              swalWithBootstrapButtons.fire(
                "Deleted!",
                "Your file has been deleted.",
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
              "Your imaginary file is safe :)",
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