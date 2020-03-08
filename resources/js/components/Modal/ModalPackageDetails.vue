<template >
   <div
      class="modal fade"
      id="modalPackageDetails"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
   >
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                 <i class="fa fa-info-circle" aria-hidden="true"></i> Package Details
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               
               <h3 style="color: #f57224; text-align:center;" >{{packageDetails.package_name}}</h3>

               <div class="container">
                  	<div class="row mb-3 mt-4">
								<div class="col-6  text-center">
									<small style="margin-left: 10px; color:  #f57224;"
										>Package Description</small
									>
									<br />
									<span style="margin-left: 10px;">{{
										packageDetails.package_description
									}}</span>
								</div>
								<div class="col-6  text-center">
									<small style="margin-left: 10px; color:  #f57224;"
										>Interest Payment Term</small
									>
									<br />
									<span style="margin-left: 10px;">{{
										packageDetails.if_advance_interest == 1
											? "With Advance Interest"
											: "Without Advance Interest"
									}}</span>
								</div>
							</div> 
							 <div class="row mb-1">
								<div class="col-4 text-center">
									<small style="margin-left: 10px; color:  #f57224;">
										No. of months to confiscated</small
									>
									<br />
									<span style="margin-left: 10px;"
										>{{ packageDetails.number_of_month }} months</span
									>
								</div>
								<div class="col-4 text-center">
									<small style="margin-left: 10px; color:  #f57224;">
										Interest per month</small
									>
									<br />
									<span style="margin-left: 10px;"
										>{{ packageDetails.interest_per_month }} %</span
									>
								</div>
								<div class="col-4 text-center">
									<small style="margin-left: 10px; color:  #f57224;">
										Penalty per month</small
									>
									<br />
									<span style="margin-left: 10px;"
										>{{ packageDetails.pinalty_per_month }} %</span
									>
								</div>
							</div>

							<h6
								v-if="durations.length != 0"
								class="text-center mt-5"
							>
								1st Month Durations:
							</h6>
							<div v-if="durations.length != 0" class="row mb-1">
								<div class="col-4 text-center">
									<small style="margin-left: 10px;  color:  #f57224;"
										>From</small
									>
								</div>
								<div class="col-4  text-center">
									<small style="margin-left: 10px;  color:  #f57224;">To</small>
								</div>
								<div class="col-4  text-center">
									<small style="margin-left: 10px;  color:  #f57224;"
										>Interest Rate</small
									>
								</div>
							</div>
							<div v-for="duration in durations" :key="duration.id">
								<div
									class="row mb-1"
									v-if="duration.package_id == packageDetails.id"
								>
									<div class="col-4 text-center">
										<span style="margin-left: 10px;">
											<small>Day</small>
											{{ duration.duration_from }}
										</span>
									</div>
									<div class="col-4  text-center">
										<span style="margin-left: 10px;">
											<small>Day</small>
											{{ duration.duration_to }}
										</span>
									</div>
									<div class="col-4  text-center">
										<span style="margin-left: 10px;">
											{{ duration.interestRate }}
											<small> %</small>
										</span>
									</div>
								</div>
							</div>
                     <br>
                     <br>
               </div>

            </div> 
            <!-- end of modal-body -->
            <!-- <div class="modal-footer">
               <button type="button" class="btn btn-primary" @click="editPackage()">Save Changes</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
         </div>
      </div>
   </div>
</template>

<script>
import AuthService from "../../services/auth";
import Swal from "sweetalert2";

export default {
   data() {
      return {
         packageDetails:[],
         durations:[]
      };
   },
   destroyed() {
      this.durations = [];
      this.packageDetails = [];
   },
};
</script>