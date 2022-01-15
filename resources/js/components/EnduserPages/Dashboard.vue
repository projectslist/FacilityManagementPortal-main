


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





        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jobs List Table</h3>

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

                jobs: {},
                jobDetailsShow:{},

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


            getResults(page = 1) {
                axios.get("api/jobsforapi?page=" + page).then((response) => {
                    this.jobs = response.data;
                });
            },



            loadJobs() {
                axios.get("api/jobsforapi").then(({ data }) => (this.jobs = data));
            },




        },
        created() {
            this.loadJobs();

            this.trimfunction();

            Fire.$on("AfterCreating", () => {
                this.loadJobs();
                this.trimfunction();
            });
        },

    };
</script>
