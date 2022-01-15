
<template>
  <main>
    <div class="container">
      <!-- ToDo Adding Modal Starts-->
      <div class="text-center text-primary font-weight-bold">
        <h1>Profile Details</h1>
      </div>

      <form @submit.prevent="updateDetails">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-8">
            <input
              v-model="form.name"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': form.errors.has('name') }"
              id="name"
              placeholder="Name"
            />
            <has-error :form="form" field="name"></has-error>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-8">
            <input
              type="email"
              :class="{ 'is-invalid': form.errors.has('email') }"
              v-model="form.email"
              class="form-control"
              id="inputEmail3"
              placeholder="Email"
            />
            <has-error :form="form" field="email"></has-error>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Password</label
          >
          <div class="col-8">
            <input
              type="password"
              :class="{ 'is-invalid': form.errors.has('email') }"
              v-model="form.password"
              class="form-control"
              id="inputPassword3"
              placeholder="Password"
            />
            <has-error :form="form" field="password"></has-error>

            <div class="col-sm-11">
              <div class="container">
                <div class="row">
                  <div class="widget-user-image">
                    <img
                      class="img-circle mt-2"
                      alt="User Avatar"
                      :src="getProfilePhoto()"
                      style="width: 50px; height: 50px"
                    />
                  </div>

                  <div class="col-6">
                    <input
                      type="file"
                      id="fileinput"
                      @change="updateProfile"
                      name="profile_image"
                      class="form-input mt-3"
                    />
                  </div>
                </div>
              </div>

              <div class="col-12">
                <button
                  type="submit"
                  class="btn btn-primary ml-5 mt-4 btn-block"
                >
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        profile_image: "",
      }),
    };
  },
  methods: {
    getProfilePhoto() {
      let photo =
        this.form.profile_image.length > 200
          ? this.form.profile_image
          : 'img/'+this.form.profile_image;
        
      return photo;
    },
    updateProfile(e) {
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();

      if (file["size"] < 2111775) {
        reader.onloadend = (file) => {
          this.form.profile_image = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Your are uploading a large file!",
        });
      }
    },

    updateDetails() {
       this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form.put("userDetails/" + this.form.id).then((data) => {
        Swal.fire({
          icon: "success",
          title: "Success!",
          text: data.data.message,
          showConfirmButton: false,
          timer: 1500,
        });
        this.profileDetails();
        document.getElementById("fileinput").value = "";
        Fire.$emit("ProfileUpdate");
         this.$Progress.finish();
      }).catch(() => {
        this.$Progress.fail();
      });
    },
    profileDetails() {
      axios.get("userDetails").then(({ data }) => this.form.fill(data[0]));
    },
  },
  created() {
    this.profileDetails();
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
