<template>
   <div class="card mb-5">
      <div class="card-header" id="headingThree">
         <h5 class="mb-3">
            <button
               class="btn btn-link collapsed"
               data-toggle="collapse"
               data-target="#collapseReport"
               aria-expanded="false"
               aria-controls="collapseReport"
            >Reported Users</button>
         </h5>
      </div>
      <div
         id="collapseReport"
         class="collapse"
         aria-labelledby="headingThree"
         data-parent="#accordion"
      >
         <div class="card-body">
            <div class="row mb-3">
               <div class="col">
                  <button class="btn btn-block btn-danger">Reported Users</button>
               </div>
               <div class="col">
                  <button class="btn btn-block btn-light">Blocked Users</button>
               </div>
            </div>

            <div
               v-for="(user, index) in reportedUsers"
               :key="index"
               class="row alert alert-primary alert-warning"
               role="alert"
               report
            >
               <div class="col">
                  <b>Users Name:</b>
                  <br />
                  {{ user.username }}
               </div>
               <div class="col text-center">
                  <b>Total Reports:</b>
                  <br />
                  <h6>{{ user.number_of_reports }}</h6>
               </div>
               <div class="col">
                  <b>Reported By:</b>
                  <div v-for="report in user.reports_by" :key="report.id">
                     <br />
                     - {{ report.pawnshop_name }}
                  </div>
               </div>
               <div class="col">
                  <b>Situation:</b>
                  <div v-for="report in user.reports_by" :key="report.id">
                     <br />
                     - {{ report.situation }}
                  </div>
               </div>
               <div class="col">
                  <b>Date Reported</b>
                  <div v-for="report in user.reports_by" :key="report.id">
                     <br />
                     - {{ report.dateReported }}
                  </div>
               </div>
               <div class="col">
                  <b></b>
                  <button class="btn btn-dark float-right">BLOCK</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   data() {
      return {
         reportedUsers: []
      };
   },
   created() {
      this.getReports();
   },
   methods: {
      async getReports() {
         await axios
            .get("/api/getReports2")
            .then(res => {
               this.reportedUsers = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      }
   }
};
</script>