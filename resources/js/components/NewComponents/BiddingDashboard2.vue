<template>
   <div class="parent-div">
      <!-- <api-api-api></api-api-api> -->
      <div class="row">
         <div class="col-6">
            <button type="button" class="btn btn-outline-success" @click="goBack()">
               <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back
            </button>
         </div>
      </div>

      <br />

      <nav class="nav nav-pills nav-justified">
         <button
            class="nav-item nav-link"
            :class="tab == 'pawned' ? 'active2' : ''"
            @click="tabSelected('pawned')"
         >
            <i class="fa fa-files-o" aria-hidden="true"></i> Pawned Item Records
         </button>
         <button
            class="nav-item nav-link"
            :class="tab == 'pending' ? 'active2' : ''"
            @click="tabSelected('pending')"
         >
            <i class="fa fa-balance-scale mr-2"></i>Pending Items
         </button>
      </nav>
      <div class="container" style="  border: #f57224 solid 2px;">
         <div class="row mt-5 mb-5" :class="tab == 'pawned' ? '' : 'd-none'">
            <div class="col">
               <list-of-pawned-items></list-of-pawned-items>
            </div>
         </div>
         <div class="row mt-5 mb-5" :class="tab == 'pending' ? '' : 'd-none'">
            <div class="col">
               <list-of-pending-items></list-of-pending-items>
            </div>
         </div>
      </div>

      <!-- ReportModal -->

      <!-- <modal-pawning ref="modalPawning"></modal-pawning> -->
   </div>
</template>

<script>
export default {
   data() {
      return {
         tab: "pending"
      };
   },
   methods: {
      tabSelected(tab) {
         this.tab = tab;
      },
      goBack() {
         this.$router.push({ path: "/" });
      }
   }
};
</script>


<style scoped>
.parent-div {
   margin: 3% 10%;
}

.active2 {
   color: white;
   background-color: #f57224;
}

/* .row {
	margin: initial !important;
	padding: 10px 0px;
}
.tab-body {
	width: 100%;
	padding: 10px;
	background-color: white;
	border: #f57224 solid 2px;
}


.navbar-item {
	text-align: center;
	padding: 10px 0px;
	border: #f57224 solid 2px;
	color: #f57224;
	cursor: pointer;
	font-size: 20px;
	height: 100%;
	font-weight: 600;
}

.normal {
	color: #f57224;
	background-color: white;
} */
</style>