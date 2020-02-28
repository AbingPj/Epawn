<template>
   <div>
      <div class="modal" tabindex="-1" role="dialog" id="modalPawningPayment">
         <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Pawning Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title">Pawn Agreement Information</h4>
                        <h5
                           class="form-label"
                           style="color: #f57224;"
                        >Bid Amount: ₱ {{this.pawned_item.pawn_amount}}</h5>
                        <div class="row text-center">
                           <div class="col">
                              <small>Date</small>
                           </div>
                           <div class="col">
                              <small>total interest</small>
                           </div>
                           <div class="col">
                              <small>Renewal Amount</small>
                           </div>
                           <div class="col">
                              <small>redemtion</small>
                           </div>
                        </div>

                        <div
                           class="row text-center"
                           style="font-size: 14px;"
                           v-for="duration in specials"
                           :key="duration.index"
                        >
                           <div class="col">
                              <b style="color: #f57224;">{{duration.from}} - {{duration.to}}</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">{{duration.interest}}%</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">₱ {{toFormat(duration.renewal)}}</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">₱ {{toFormat(duration.redemption)}}</b>
                           </div>
                        </div>
                        <div
                           class="row text-center"
                           style="font-size: 14px;"
                           v-for="month in monthly"
                           :key="month.renewal"
                        >
                           <div class="col">
                              <b style="color: #f57224;">{{month.month}}</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">{{month.total_interest}}%</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">₱ {{toFormat(month.renewal)}}</b>
                           </div>
                           <div class="col">
                              <b style="color: #f57224;">₱ {{toFormat(month.redemption)}}</b>
                           </div>
                        </div>
                     </div>
                  </div>
                  <h4>Date now:{{date_now}}</h4>
                  <div class="row">
                     <div class="col">
                        <Label>Current Renewal Payment:</Label>
                        ₱
                        <input type="text" class="form form-control" v-model="current_renewal" />
                        <button class="btn btn-primary btn-block">Renew</button>
                     </div>
                     <div class="col">
                          <Label>Current Claim Payment:</Label>
                        ₱
                        <input type="text" class="form form-control" v-model="current_payment" />
                        <button class="btn btn-primary btn-block">Claim</button>
                     </div>
                  </div>
               </div>
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
         pawnshop_id: AuthService.methods.getUid(),
         pawned_item: [],
         calculations: [],
         specials: [],
         monthly: [],
         date_now: "",
         current_payment: 0,
         current_renewal: 0
      };
   },
   // mounted() {
   //    this.getPaymentCalculations();
   // },
   methods: {
      toFormat(num) {
         return Number(parseFloat(num).toFixed(2)).toLocaleString("en", {
            minimumFractionDigits: 2
         });
      },
      async getPaymentCalculations() {
         await axios
            .get(
               "api/getPawnedItemPaymentDetails/" +
                  this.pawned_item.package_id +
                  "/" +
                  this.pawned_item.pawn_amount +
                  "/" +
                  this.pawned_item.date_renew
            )
            .then(res => {
               this.calculations = res.data;
               this.monthly = this.calculations[0].monthly;
               this.specials = this.calculations[0].specials;
               this.current_payment = this.calculations[0].current_payment;
               this.current_renewal = this.calculations[0].current_renewal;
               this.date_now = this.calculations[0].date_now;
            })
            .catch(err => {
               console.error(err);
            });
      }
   }
};
</script>