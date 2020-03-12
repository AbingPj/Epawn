<style lang="scss" scoped>
.container {
   // margin: 50px 0px 50px 50px;
   padding: 50px;
}
</style>

<template>
   <div>
      <div class="container">
         <div class="card">
            <div class="card-header">
               <h5>Reported Pawnshops</h5>
            </div>
            <div class="card-body">

               <div class="row mb-3">
                  <div class="col">
                     <button class="btn btn-block btn-danger">Reported Pawnshops</button>
                  </div>
                  <div class="col">
                     <!-- <button class="btn btn-block btn-light">Blocked Users</button> -->
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
                     <button
                        class="btn btn-dark float-right"
                        @click="sendBlockUser(user.user_id)"
                     >BLOCK</button>
                  </div>
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
            .get("/api/getReportOfPawnshops")
            .then(res => {
               this.reportedUsers = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      },
      async sendBlockUser(id) {
         let data = {
            id: id
         };
         await axios
            .post("/api/sendBlockUser", data)
            .then(res => {
               console.log(res);
               this.getReports();
            })
            .catch(err => {
               console.error(err);
            });
      }
   }
};
</script>