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
            id="categoryTable"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>Image</th>
                <th>Name</th>
                <th>Create Date</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, index) in categories" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>
                  <img
                    :src="'/category/' + category.image"
                    height="60"
                    alt="No Image"
                  />
                </td>
                <td>
                  {{ category.name | upText }}
                </td>
                <td>
                  {{ category.created_at | myDate }}
                </td>
                <td>
                  <a href="" @click.prevent="editModal(category.id)"
                    ><i class="fa fa-fw fa-pencil-alt text-primary"></i
                  ></a>
                  <a href="#" @click.prevent="deleteRecord(category.id)"
                    ><i class="fa fa-fw fa-trash-alt text-danger"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
          <div
            v-if="loading"
            class="progress-bar progress-bar-striped progress-bar-animated bg-info"
            role="progressbar"
          >
            <span class="font-size-sm font-w300">90%</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -- -->
    <div
      class="modal"
      id="CreateCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-block-normal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 v-show="!editmode" class="block-title">Add New Category</h3>
              <h3 v-show="editmode" class="block-title">Update Category</h3>
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
              @submit.prevent="editmode ? updateCategory() : createCategory()"
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
                    placeholder="Category name here..."
                    maxlength="15"
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
                    placeholder="Category name here..."
                    maxlength="15"
                    required=""
                  />
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input
                    type="file"
                    class="image"
                    id="image"
                    name="image"
                    v-if="uploadReady"
                    ref="fileupload"
                    v-on:change="onImageChange"
                    placeholder="Image here..."
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
export default {
  data() {
    return {
      id: "",
      name: "",
      image: "",
      loading: false,
      uploadReady: true,
      editmode: false,
      success: false,
      categories: [],
      allerrors: [],
      records: [],
    };
  },
  created() {
    this.loading = true;
    this.getCategories();

    Fire.$on("recordUpdate", () => {
      this.getCategories();
      this.reset();
    });
    // setInterval(() => this.getCategories(), 3000);
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#categoryTable").DataTable();
      });
    },
    //Category List
    getCategories() {
      axios
        .get("/api/category")
        .then((response) => {
          this.categories = response.data;
          this.table();
          this.loading = false;
          // setTimeout(() => {
          //   this.loading = !true;
          // }, 1000);
        })
        .catch((error) => {
          alert("unable to fetch categories");
        });
    },
    reset() {
      this.name = "";
      this.uploadReady = false;
      this.$nextTick(() => {
        this.uploadReady = true;
      });
    },
    onImageChange(e) {
      // console.log(e);
      this.image = e.target.files[0];
    },
    createCategory() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("image", this.image);
      axios
        .post("api/category", formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CreateCategoryModal").modal("hide");
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

    updateCategory() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.records.name);
      formData.append("image", this.image);
      formData.append("_method", "put");
      axios
        .post("/api/category/" + this.records.id, formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#CreateCategoryModal").modal("hide");
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
      $("#CreateCategoryModal").modal("show");
    },

    editModal(id) {
      axios
        .get("/api/category/" + id)
        .then((response) => {
          this.records = response.data;
          this.editmode = true;
          $("#CreateCategoryModal").modal("show");
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
            axios.delete("/api/category/" + id).then((response) => {
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
