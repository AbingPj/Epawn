<template >
   <div
      class="modal fade"
      id="editPackageModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
   >
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                  <i class="fa fa-archive" aria-hidden="true"></i> Edit Package
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col">
                     <b>Package Name</b>
                     <input v-model="package_name" type="text" class="form form-control" />
                  </div>
                  <div class="col">
                     <b>Package Desc</b>
                     <input v-model="package_desc" type="text" class="form form-control" />
                  </div>
               </div>
               <br />
               <div class="row">
                  <div class="col-4">
                     <label for>No. of Months to confiscated</label>
                     <div class="input-group">
                        <input
                           type="number"
                           class="form-control text-center"
                           disabled
                           v-model="number_of_month"
                        />
                        <div class="input-group-append">
                           <span class="input-group-text" id="basic-addon2">month(s)</span>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col">
                     <label for>Interest Per Month</label>
                     <input v-model="interest_per_month" type="number" class="form form-control" />
                  </div>
                  <div class="col">
                     <label for>Penalty Per Month</label>
                     <input v-model="pinalty_per_month" type="number" class="form form-control" />
                  </div> -->
									 <div class="col-4">
                     <label for>Interest Per Month</label>
                     <div class="input-group">
                        <input
                           type="number"
                           class="form-control text-center"
                           v-model="interest_per_month"
                        />
                        <div class="input-group-append">
                           <span class="input-group-text">%</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <label for>Penalty Per Month</label>
                     <div class="input-group">
                        <input
                           type="number"
                           class="form-control text-center"
                           v-model="pinalty_per_month"
                        />
                        <div class="input-group-append">
                           <span class="input-group-text">%</span>
                        </div>
                     </div>
                  </div>
               </div>
               <br />
               <div class="row">
                  <div class="col">
                     <label for>Interest Payment Term</label>
                     <select class="form-control" v-model="if_advance_interest">
                        <option value="1">With Advance Interest</option>
                        <option value="0">No Advance Interest</option>
                     </select>
                  </div>
               </div>
               <br />
               <br />
               <div class="row">
                  <div class="col">
                     <button class="btn btn-dark" @click="addDuration">Add Duration</button>
                  </div>
                  <div class="col"></div>
                  <div class="col"></div>
               </div>
               <br />
               <div v-for="(dur, index) in durations" :key="index">
                  <div class="row">
                     <div class="col-4">
                        <small>From Day :</small>
                        <input
                           class="form-control"
                           disabled
                           type="number"
                           v-model="dur.duration_from"
                        />
                     </div>
                     <div class="col-4">
                        <small>To Day :</small>
                        <input
                           :disabled="index < durations.length - 1"
                           @change="updateTo(index)"
                           class="form-control"
                           type="number"
                           v-model="dur.duration_to"
                        />
                     </div>
                     <div class="col-3">
                        <small>Interest Rate</small>
                        <input class="form-control" type="number" v-model="dur.interestRate" />
                     </div>
                     <div class="col-1">
                        <div :class="index != durations.length - 1 ? 'd-none' : ''">
                           <small>remove &nbsp;</small>
                           <button @click="removeDuration()" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" @click="editPackage()">Save Changes</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
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
         package_id: "",
         pawnshop_id: AuthService.methods.getUid(),
         package_name: "",
         package_desc: "",
         number_of_month: "",
         interest_per_month: "",
         pinalty_per_month: "",
         if_advance_interest: 1,
         durations: []
      };
   },
   methods: {
      async setPackage(id) {
         await axios
            .get("api/package/" + id)
            .then(res => {
               console.log(res);
               this.package_id = res.data.id;
               this.package_name = res.data.package_name;
               this.package_desc = res.data.package_description;
               this.number_of_month = res.data.number_of_month;
               this.interest_per_month = res.data.interest_per_month;
               this.pinalty_per_month = res.data.pinalty_per_month;
               this.if_advance_interest = res.data.if_advance_interest;
               this.durations = res.data.durations;
               $("#editPackageModal").modal("show");
            })
            .catch(err => {
               console.error(err);
            });
      },
      addPackage() {
         let data = {
            pawnshop_id: this.pawnshop_id,
            package_name: this.package_name,
            package_desc: this.package_desc,
            number_of_month: this.number_of_month,
            interest_per_month: this.interest_per_month,
            pinalty_per_month: this.pinalty_per_month,
            if_advance_interest: this.if_advance_interest,
            durations: this.durations
         };

         axios
            .post("/api/zSavePackage", data)
            .then(res => {
               Swal.fire({
                  title: "Package Added Succesfully",
                  toast: true,
                  timer: 3000,
                  position: "top-right"
               });
               $("#modalAddPackage2").modal("hide");
               this.$parent.viewPackages();
               this.clear();
            })
            .catch(err => {
               console.error(err);
            });
      },

      async editPackage() {
         // this.packageNameErrorMessage = null;
         // this.packageDescriptionErrorMessage = null;

         let data = {
            // pawnshop_id: this.pawnshop_id,
            package_id: this.package_id,
            package_name: this.package_name,
            package_desc: this.package_desc,
            number_of_month: this.number_of_month,
            interest_per_month: this.interest_per_month,
            pinalty_per_month: this.pinalty_per_month,
            if_advance_interest: this.if_advance_interest,
            durations: this.durations
         };

         await axios
            .post("api/updatePackage", data)
            .then(res => {
               console.log(res);
               Swal.fire(
                  "Package Updated!",
                  "Package Updated Succesfully.",
                  "success"
               );
               this.$parent.viewPackages();
               $("#editPackageModal").modal("hide");
            })
            .catch(err => {
               // if (err.response.data.errors.package_name) {
               // 	this.packageNameErrorMessage =
               // 		err.response.data.errors.package_name[0];
               // }
               // if (err.response.data.errors.package_description) {
               // 	this.packageDescriptionErrorMessage =
               // 		err.response.data.errors.package_description[0];
               // }
            });
      },

      updateTo(index) {
         if (Number(this.durations[index].to) > 35) {
            this.durations[index].to = 0;
         } else {
            if (
               Number(this.durations[index].duration_to) <=
               Number(this.durations[index].duration_from)
            ) {
               this.durations[index].duration_to =
                  Number(this.durations[index].duration_from) + 1;
            }
         }
      },
      removeDuration() {
         this.durations.pop();
      },
      addDuration() {
         if (this.durations.length <= 0) {
            this.durations.push({
               duration_from: 1,
               duration_to: 2,
               interestRate: 1
            });
         } else {
            let length = Number(this.durations.length - 1);
            this.durations.push({
               duration_from: Number(this.durations[length].duration_to) + 1,
               duration_to: Number(this.durations[length].duration_to) + 2,
               interestRate: Number(this.durations[length].interestRate) + 1
            });
         }
      }
   }
};
</script>