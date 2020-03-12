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
               <h5>Blocked Pawnshops</h5>
            </div>
            <div class="card-body">

               <div class="row mb-3">
                  <div class="col">
                     <button class="btn btn-block btn-dark">Blocked Pawnshops</button>
                  </div>
                  <div class="col">
                     <!-- <button class="btn btn-block btn-light">Blocked Users</button> -->
                  </div>
               </div>

               <div
                  v-for="(user, index) in reportedUsers"
                  :key="index"
                  class="row alert alert-primary alert-dark"
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
                     <b></b>
                     <button
                        class="btn btn-info float-right"
                        @click="unBlockUser(user.user_id)"
                     >UNBLOCK</button>
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
            .get("/api/getBlockPawnshops")
            .then(res => {
               this.reportedUsers = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      },
      async unBlockUser(id) {
         let data = {
            id: id
         };
         await axios
            .post("/api/unBlockPawnshop", data)
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