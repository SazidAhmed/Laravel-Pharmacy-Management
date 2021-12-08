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
            id="User"
            class="table table-borderless table-striped table-vcenter"
          >
            <thead>
              <tr>
                <th>Index</th>
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Registerd On</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in users" :key="index">
                <td>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>UID{{ user.id }}</td>
                <td>
                  {{ user.username | upText }}
                </td>
                <td>
                  {{ user.email | upText }}
                </td>
                <td>
                  {{ user.created_at | myDate }}
                </td>
                <td>
                  <a href="" @click.prevent="editModal(user.id)"
                    ><i class="fa fa-fw fa-pencil-alt text-primary"></i
                  ></a>
                  <a href="#" @click.prevent="deleteRecord(user.id)"
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
      id="UserModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-block-normal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 v-show="!editmode" class="block-title">Add New User</h3>
              <h3 v-show="editmode" class="block-title">Update User</h3>
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
              @submit.prevent="editmode ? updateUser() : createUser()"
              enctype="multipart/form-data"
            >
              <div class="block-content font-size-sm">
                <div v-if="!editmode" class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="username"
                    name="username"
                    v-model="username"
                    placeholder="Enter Username here..."
                    maxlength="30"
                    required=""
                  />
                    <span v-if="allerrors.username" :class="['danger']">
                      {{ allerrors.username[0] }}
                    </span>
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="username"
                    name="username"
                    v-model="records.username"
                    placeholder="Enter Userame here..."
                    maxlength="30"
                    required=""
                  />
                    <span v-if="allerrors.username" :class="['danger']">
                      {{ allerrors.username[0] }}
                    </span>
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control is-valid"
                    id="email"
                    name="email"
                    v-model="email"
                    placeholder="Enter Email here..."
                    maxlength="30"
                    required=""
                  />
                   <span v-if="allerrors.email" :class="['danger']">
                      {{ allerrors.email[0] }}
                    </span>
                </div>
                <div v-if="editmode" class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control is-valid"
                    id="email"
                    name="email"
                    v-model="records.email"
                    placeholder="Enter Email here..."
                    maxlength="30"
                    required=""
                  />
                   <span v-if="allerrors.email" :class="['danger']">
                      {{ allerrors.email[0] }}
                    </span>
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="password">Password</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="password"
                    name="password"
                    v-model="password"
                    placeholder="Enter Password here..."
                    maxlength="50"
                    required=""
                  />
                    <span v-if="allerrors.password" :class="['danger']">
                      {{ allerrors.password[0] }}
                    </span>
                </div>
                <div v-if="!editmode" class="form-group">
                  <label for="password2">Confirm Password</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="password2"
                    name="password2"
                    v-model="password2"
                    placeholder="Enter Confirm Password..."
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
      username: "",
      email: "",
      password: "",
      password2: "",
      editmode: false,
      success: false,
      users: [],
      allerrors: [],
      records: [],
    };
  },
  created() {
    this.getUsers();

    Fire.$on("recordUpdate", () => {
      this.getUsers();
      this.reset();
    });
    // setInterval(() => this.getCategories(), 3000);
  },
  methods: {
    table() {
      this.$nextTick(() => {
        $("#User").DataTable({
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
    //User list
    getUsers() {
      axios
        .get("/api/users")
        .then((response) => {
          this.users = response.data;
          this.table();
        })
        .catch((error) => {
          alert("unable to fetch Users");
        });
    },
    reset() {
      this.username = "";
      this.email = "";
      this.password = "";
      this.password2 = "";
    },
    createUser() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };

      if(this.password == this.password2){

        let formData = new FormData();
        formData.append("username", this.username);
        formData.append("email", this.email);
        formData.append("password", this.password);
        axios
            .post("/api/users", formData, config)
            .then((response) => {
            Fire.$emit("recordUpdate");
            $("#UserModal").modal("hide");
            this.success = true;
            this.allerrors=[],
            Swal.fire({
                position: "center",
                icon: "success",
                title: "User has been Created",
                showConfirmButton: false,
                timer: 1500,
            });
            })
            .catch((error) => {
            this.allerrors = error.response.data.errors;
            });
      }
      else{
        Swal.fire({
        position: "center",
        icon: "error",
        title: "Password wasn't matched with Confirm Password",
        showConfirmButton: false,
        timer: 2500,
        });
      }
    },

    updateUser() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("username", this.records.username);
      formData.append("email", this.records.email);
      formData.append("_method", "put");
      axios
        .post("/api/users/" + this.records.id, formData, config)
        .then((response) => {
          Fire.$emit("recordUpdate");
          $("#UserModal").modal("hide");
          this.allerrors=[],
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Data has been Updated",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) => {
          this.allerrors = error.response.data.errors;
        });
    },
    createModal() {
      this.editmode = false;
      $("#UserModal").modal("show");
    },

    editModal(id) {
      axios
        .get("/api/users/" + id)
        .then((response) => {
          this.records = response.data;
          this.editmode = true;
          $("#UserModal").modal("show");
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
            axios.delete("/api/users/" + id).then((response) => {
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