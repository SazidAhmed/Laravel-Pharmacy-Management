<template>
  <div class="content">
    <div class="bg-primary-dark">
        <div class="content content-full overflow-hidden">
            <div class="mt-7 mb-5 text-center">
                <h1 class="h2 text-white mb-2 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">{{profile.username}}</h1>
                <h2 class="h4 font-w400 text-white-75 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">{{profile.email}}</h2>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
      <div class="block-content block-content-full">
       <form
              @submit.prevent="updateProfile(profile.id)"
              enctype="multipart/form-data"
            >
              <div class="block-content font-size-sm">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="username"
                    name="username"
                    v-model="profile.username"
                    placeholder="Enter Username Here..."
                    maxlength="30"
                    required=""
                  />
                    <span v-if="allerrors.username" :class="['danger']">
                      {{ allerrors.username[0] }}
                    </span>
                </div>
                <div  class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control is-valid"
                    id="email"
                    name="email"
                    v-model="profile.email"
                    placeholder="Enter Email Here..."
                    maxlength="30"
                    required=""
                  />
                   <span v-if="allerrors.email" :class="['danger']">
                      {{ allerrors.email[0] }}
                    </span>
                </div>
                <div  class="form-group">
                  <label for="password">Password</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    id="password"
                    name="password"
                    v-model="password"
                    placeholder="Enter Your Password Here..."
                    maxlength="50"
                    required=""
                  />
                    <span v-if="allerrors.password" :class="['danger']">
                      {{ allerrors.password[0] }}
                    </span>
                </div>
                <div class="form-group">
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
                <button type="submit" class="btn btn-success btn-sm btn-block btn-square mb-1">
                  <i class="fa fa-fw fa-check-circle mr-1"></i> Update Profile
                </button>
              </div>
            </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      id: "",
      username: "",
      email: "",
      password: "",
      password2: "",
      profile: [],
      allerrors: [],
    };
  },
  created() {
    this.getProfile();

    Fire.$on("recordUpdate", () => {
      this.getProfile();
    });
  },
  methods: {
    //User list
    getProfile() {
      axios
        .get("/userprofile")
        .then((response) => {
          this.profile = response.data;
        })
        .catch((error) => {
          alert("unable to fetch Users");
        });
    },
      updateProfile(id){
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      console.log(id);

      if(this.password == this.password2){

        let formData = new FormData();
        formData.append("username", this.profile.username);
        formData.append("email", this.profile.email);
        formData.append("password", this.password);
        formData.append("_method", "put");
        axios
            .post("/api/users/"+ id, formData, config)
            .then((response) => {
            Fire.$emit("recordUpdate");
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

  },
};
</script>
<style type="text/css">
.danger {
  color: red;
}
</style>