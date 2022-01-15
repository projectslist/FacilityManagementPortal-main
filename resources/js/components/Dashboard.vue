


<template>
  <div class="container">

      <!-- Show Job Details Modal Starts-->
      <div
          class="modal fade"
          id="showJobDetails"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
      >
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="jobDetails">
                          Job Details
                      </h5>


                      <button
                          type="button"
                          class="close"
                          data-dismiss="modal"
                          aria-label="Close"
                      >
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                          <div class="modal-body">

                              <label for="" style="color: green; font-weight: bold">Job Summary :</label> <label for="">{{this.jobDetailsShow.summary}}</label>
                              <hr>
                              <label for="" style="color: green; font-weight: bold">Job Description :</label> <p>{{this.jobDetailsShow.description}}</p>
                              <hr>
                              <label for="" style="color: green; font-weight: bold">Property Name : </label><label for="">{{this.jobDetailsShow.property_name}}</label>
                              <hr>
                              <label for="" style="color: green; font-weight: bold">Job Status :</label> <label for="">{{this.jobDetailsShow.status}}</label>





                          </div>

                          <div class="modal-footer">
                              <button
                                  type="button"
                                  class="btn btn-danger"
                                  data-dismiss="modal"
                              >
                                  Close
                              </button>

                          </div>

                  </div>
              </div>
          </div>
      </div>

      <!-- Show Job Details Modal Ends-->




    <!-- Job Adding Modal Starts-->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNew">
              Add New Job
            </h5>

            <h5 v-show="editmode" class="modal-title" id="Update">
              Update Job
            </h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateJob() : createJob()">
              <div class="modal-body">
                <div class="form-group">
                  <input
                    v-model="form.summary"
                    :class="{ 'is-invalid': form.errors.has('summary') }"
                    type="text"
                    name="summary"
                    id="summary"
                    placeholder="Job Summary"
                    class="form-control"
                  />

                  <has-error :form="form" field="summary"></has-error>
                </div>


                  <div class="form-group">
                      <textarea
                          v-model="form.description"
                          :class="{ 'is-invalid': form.errors.has('description') }"
                          type="text"
                          rows="5"
                          name="description"
                          id="description"
                          placeholder="Job Description"
                          class="form-control"
                      />

                      <has-error :form="form" field="description"></has-error>
                  </div>

                  <div>
                      <label for="">Please Select Property:</label>



                      <select class="form-control" v-model="form.property_id">

                          <option v-for="property in properties" :key="property.id"
                                  v-model="form.property_id"
                                  name="property_id"
                                  :class="{ 'is-invalid': form.errors.has('property_id') }"
                                  :value="property.id">

                              {{property.property_name}}
                          </option>

                      </select>

                      <has-error :form="form" field="property_id"></has-error>
                  </div>



                  <div v-show="editmode">
                      <label for="">Status</label>

                      <select class="form-control" v-model="form.status" >

                          <option value="open" v-model="form.status" selected>open</option>
                          <option value="in progress" v-model="form.status">in progress</option>
                          <option value="completed" v-model="form.status">completed</option>
                          <option value="cancelled" v-model="form.status">cancelled</option>

                      </select>

                      <has-error :form="form" field="status"></has-error>
                  </div>





              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Update Job
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Create Job
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Job Adding Modal Ends-->

    <div class="row mt-5">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Jobs List Table</h3>
            <div class="card-tools">
              <button class="btn btn-success" @click="openModal">
                Add New Job <i class="fas fa-building"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Summary</th>
                  <th>Description</th>
                  <th>Property</th>
                  <th>Status</th>
                  <th>Raised By</th>
                  <th>Edit / Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="job in jobs.data" :key="job.id">
                  <td>{{ job.id }}</td>
                  <td>{{ job.summary }}</td>
                    <td>


                        <a href="#" @click="jobDetails(job)" ><p v-trim v-html="job.description"></p> </a></td>


                  <td>{{ job.property_name }}</td>

                  <td>{{ job.status }}</td>
                  <td>{{ job.name }}</td>

                  <td>
                    <a href="#" @click="editModal(job)"
                      ><i class="fas fa-edit"></i>
                    </a>
                    -

                    <a href="#" @click="deleteJob(job.id)"
                      ><i class="fas fa-trash red"></i>
                    </a>
                    -

                  </td>
                </tr>
                <tr></tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="jobs" @pagination-change-page="getResults">
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>


export default {
  data() {
    return {

      editmode: false,
      jobs: {},
        jobDetailsShow:{},
        properties:{},

      form: new Form({
        id: "",
        summary: "",
        description:"",
        property_id:"",
        status: "",
      }),
    };
  },

  methods: {

      jobDetails(job){
          $("#showJobDetails").modal("show");

          this.jobDetailsShow= job;

      },

    trimfunction () {


       Vue.directive("trim",{
            inserted:function (el) {
                var str= el.innerHTML;
                var resultString = str.split(' ').slice(0,7).join(" ") + "...";
                el.innerHTML = resultString
            }
        });


    },


    updateJob() {

        this.form
          .put("jobs/" + this.form.id)
          .then(() => {
              this.jobs = {};


              Fire.$emit("AfterCreating");
            $("#addNew").modal("hide");

            Toast.fire({
              icon: "success",
              title: "The job has been updated successfully!",
            });



          })
          .catch(() => {

          });


    },

    editModal(job) {
      (this.editmode = true), this.form.reset();
      $("#addNew").modal("show");
      console.log(job)
      this.form.fill(job);
    },

    deleteJob(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert the job!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        //Send request to server
        if (result.value) {
          this.form
            .delete("jobs/" + id)
            .then(() => {
              Swal.fire("Deleted!", "The job has been deleted.", "success");
              Fire.$emit("AfterCreating");
            })
            .catch(() => {
              Swal("Failed!", "There was something wrong", "warning");
            });
        }
      });
    },

    getResults(page = 1) {
      axios.get("jobs?page=" + page).then((response) => {
        this.jobs = response.data;
      });
    },

    openModal() {
      (this.editmode = false), this.form.reset();
      $("#addNew").modal("show");
    },

    createJob() {
      this.form
        .post("jobs")
        .then(() => {
          Fire.$emit("AfterCreating");
          $("#addNew").modal("hide");
          this.form.reset();
          Toast.fire({
            icon: "success",
            title: "Job has been created successfully!",
          });
        })
        .catch(() => {

        });
    },

    loadJobs() {
      axios.get("jobs").then(({ data }) => (this.jobs = data));
    },

      loadProperties() {
          axios.get("properties").then(({ data }) => (this.properties = data));
      },


  },
  created() {
     this.loadJobs();
     this.loadProperties();
     this.trimfunction();

    Fire.$on("AfterCreating", () => {
      this.loadJobs();
        this.trimfunction();
    });
  },

};
</script>
