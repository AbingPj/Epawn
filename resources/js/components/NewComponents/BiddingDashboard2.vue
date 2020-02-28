<template>
  <div class="parent-div">

    <div class="row"> 
      <div class="col-6"> 
        <button type="button" class="btn btn-outline-success " @click="goBack()"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</button>
      </div>
    </div>
    <div class="row navbar">
      <div
        class="col navbar-item"
        v-bind:class="{ 'active ': activeTab == 'history' , normal : activeTab != 'history'}"
        v-on:click="activeTab = 'history'; viewRecords();"
      >
        <i class="fa fa-files-o" aria-hidden="true"></i> Records
      </div>
      <div
        v-bind:class="{ 'active ': activeTab == 'active' , normal : activeTab != 'active'}"
        v-on:click="activeTab = 'active'; viewPendingItems();"
        class="col navbar-item"
      >
        <i class="fa fa-balance-scale mr-2"></i> Pending Items
      </div>
    </div>

    <div class="row tab-body">
      <div v-if="activeTab == 'active'" style="width: 100%;">
        <div v-if="items.length != 0"> 
         <div class="row" v-for="item in items" :key="item.id">
          <div class="col">
            <img
              :src="`../../images/${item.item_photo}`"
              style="height:50px; width: 50px; border: #f57224 solid 1.5px;"
            />
            {{item.item_name}}
          </div>
          <div class="col" style="line-height: 55px; font-size: 12px; color: #f57224;">
            <strong>{{item.fname}}</strong>
          </div>
          <div class="col" style="line-height: 55px;">
            <strong>{{item.category_name}}</strong>
          </div>

          <div class="col" style="line-height: 55px;">
            <strong>₱{{item.initial_amount}}</strong>
          </div>
          <div
            class="col alert text-center"
            :class="{'alert-warning' : item.status == 1, 'alert-success' :item.status == 2 }"
            role="alert"
            style="line-height: 36px;"
            title="It can only be pawned when the item is in your store and you handed over the agreed amount"
          >
            <span v-if="item.status == 1">Pending</span>
            <span v-if="item.status == 2">Pawned</span>

            <button
              class="btn btn-success"
              v-if="item.status == 1"
              @click="pawned(item)"
              style="float: right; color: white;"
            >Manage</button>
           
          </div>
          <div class="col"  style="line-height: 55px;">
              <button
                    class="btn btn-danger"
                    v-if="item.status == 1"
                    @click="report(item)"
            > <i class="fa fa-exclamation-circle" aria-hidden="true"></i> </button>
          </div>

           <div class="col"  style="line-height: 55px;">
              <button
                    class="btn btn-warning"
                    v-if="item.status == 1"
                    @click="modalPawningShow(item)"
            > <i class="fa fa-exclamation-circle" aria-hidden="true"></i> </button>
          </div>


         
         
        </div>
        </div>
        <div class="alert alert-danger text-center" v-if="items.length == 0"> No Pending Items as of the moment </div>
      </div>
      <!-- lists of records -->
      <div v-else style="width: 100%">
        <div v-if="records.legth != 0">
          <div v-for="record in records" :key="record.pawnshop_id" class="row">
            <div class="col">
              <img
                :src="`../../images/${record.item_photo}`"
                style="height:50px; width: 50px; border: #f57224 solid 1.5px;"
              />
              {{record.item_name}}
            </div>
            <div class="col" style="line-height: 55px; font-size: 12px; color: #f57224;">
              <strong>{{record.fname}}</strong>
            </div>
            <div class="col" style="line-height: 55px;">
              <strong>{{record.category_name}}</strong>
            </div>
            <div class="col" style="line-height: 55px;">
              <strong>₱{{record.initial_amount}}</strong>
            </div>
            <div
              class="col alert text-center"
              :class="{'alert-warning' : record.status == 1, 'alert-success' :record.status == 2 }"
              role="alert"
              style="line-height: 36px;"
              title="It can only be pawned when the item is in your store and you handed over the agreed amount"
            >
              <div class="row">
                <div class="col">
                  <button
                    class="btn btn-danger"
                    style="width: 100%; height: 100%;"
                    @click="viewRejectedReason(record)"
                    v-if="record.status == 4"
                  >Rejected</button>

                  <button
                    class="btn btn-primary mr-2 btn-block"
                    v-if="record.status == 2"
                    @click="launchPaymentModal(record)"
                    style=" color: white;"
                  >Pay</button>
                </div>
                <div class="col">
                  <button
                    class="btn btn-success btn-block"
                    v-if="record.status == 2"
                    @click="ManagePawnedItem(record)"
                    style=" color: white;"
                  >Manage</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="alert alert-danger text-center" v-if="records.length == 0">Records Empty as of the moment</div>
      </div>


    
     
    </div>

    <!-- Pawning the item modal  -->
    <div class="modal" tabindex="-1" role="dialog" id="pawnModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pawning Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- declineActive == false -->
            <div v-if="declineActive == false">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"># of days to notify before it hits the deadline</span>
                </div>
                <input type="text" class="form-control" v-model="pawning_info.notif_days" />
                <div class="input-group-append">
                  <span class="input-group-text">Days</span>
                </div>
              </div>

              <!-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Item's Extension for the User</span>
                </div>
                <input type="text" class="form-control" v-model="pawning_info.ext_months" />
                <div class="input-group-append">
                  <span class="input-group-text">Months</span>
                </div>
              </div>-->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Package</label>
                </div>
                <select
                  class="custom-select"
                  id="inputGroupSelect01"
                  @change="viewDuration(pawning_info.package)"
                  v-model="pawning_info.package"
                >
                  <option
                    v-for="my_package in packages"
                    :value="my_package.package_id"
                    :key="my_package.package_id"
                  >{{my_package.package_name}}</option>
                </select>
              </div>

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pawn Agreement Information</h5>
                  <small class="form-label" style="color: #f57224;">Bid Amount</small>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <button
                        class="btn"
                        :class="{'btn-warning' : bidAmountEditable, 'btn-danger' : !bidAmountEditable}"
                        @click="bidAmountEditable = !bidAmountEditable"
                        type="button"
                      >Change Amount</button>
                    </div>
                    <input
                      type="number"
                      class="form-control"
                      v-model="item.initial_amount"
                      :disabled="bidAmountEditable"
                      placeholder
                      aria-label
                      aria-describedby="basic-addon1"
                    />
                  </div>
                  <div class="row text-center">
                    <div class="col">
                      <small>Duration</small>
                    </div>
                    <div class="col">
                      <small># of Days</small>
                    </div>
                    <div class="col">
                      <small>interest rate</small>
                    </div>
                    <div class="col">
                      <small>duration's interest</small>
                    </div>
                  </div>
                  <div
                    class="row text-center"
                    style="font-size: 14px;"
                    v-for="duration in durations"
                    :key="duration.package_id"
                  >
                    <div class="col">
                      Day
                      <b style="color: #f57224;">{{ duration.duration_from}}</b> upto day
                      <b style="color: #f57224;">{{duration.duration_to}}</b>
                    </div>
                    <div class="col">
                      <b style="color: #f57224;">{{ ((parseInt(duration.duration_to) + 1) - parseInt(duration.duration_from)) }}</b> Days
                    </div>
                    <div class="col">
                      <!-- <b style="color: #f57224;">{{ duration.interestRate }}</b>% -->
                      <b style="color: #f57224;">{{ parseInt(duration.interestRate) }}</b>%
                    </div>
                    <div class="col">
                      <!-- <b
                        style="color: #f57224;"
                      >₱{{ ( parseFloat(item.initial_amount) * parseFloat((String("0."+duration.interestRate))) / ( parseFloat((duration.duration_to + 1)) - parseFloat(duration.duration_from))).toFixed(2) }}</b> -->
                         <b
                        style="color: #f57224;"
                      >₱{{getInterestRate(item.initial_amount,duration.interestRate)}}</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Reason of rejection</span>
                </div>
                <input
                  type="text"
                  v-model="pawning_info.reason"
                  class="form-control"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
            </div>

            <div class="row">
              <div class="col">
                <button
                  class="btn btn-success btn-block"
                  @click="pawnItem()"
                  :disabled="declineActive || (pawning_info.notif_days.trim().length == 0 || pawning_info.package == 0)"
                >Accept</button>
              </div>
              <div class="col">
                <button
                  class="btn btn-danger btn-block"
                  v-if="declineActive == false"
                  @click="declineActive = !declineActive"
                >Decline</button>
                <div class="row" v-if="declineActive == true" style="padding: 0px !important;">
                  <div class="col">
                    <button
                      class="btn btn-success btn-block"
                      @click="declineItem()"
                      :disabled="pawning_info.reason.trim().length == 0"
                    >Confirm</button>
                  </div>
                  <div class="col">
                    <button
                      class="btn btn-danger btn-block"
                      @click="declineActive = !declineActive"
                    >Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- managing item that is already pawned -->
    <div class="modal" tabindex="-1" role="dialog" id="itemModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Manage Pawned Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- declineActive == false -->
            <div class="card" style="width: 100%;">
              <div class="card-body">
                <h5
                  class="card-title"
                  style="color: white;padding: 10px; background: #f57224;"
                >Item Information</h5>
                <div class="row">
                  <div class="col col-3">
                    <img
                      :src="`../../images/${pawned_item.item_photo}`"
                      style="width: 150px; height: 150px;"
                    />
                  </div>
                  <div class="col">
                    <div style="width: 100%; font-size: 25px;">{{pawned_item.item_name}}</div>
                    <div style="color: #f57224;">{{pawned_item.category_name}}</div>
                    <div
                      style="height: 150px; overflow-y: scroll; margin-top: 12px;"
                    >{{pawned_item.item_description}}</div>
                  </div>
                </div>
                <div class='row'> 
                  <div class="col-12"> 
                    Interest Rate
                  </div>
                </div>
              </div>
            </div>

            <div class="card mt-3" style="width: 100%;">
              <div class="card-body">
                <h5
                  class="card-title"
                  style="color: white;padding: 10px; background: #f57224;"
                >Payment History</h5>
                <div
                  v-if="payments.length == 0"
                  class="alert alert-danger text-center"
                  role="alert"
                >No payments yet.</div>
                <div v-else>
                  <div class="row text-center">
                    <div class="col">
                      <small>payment amount</small>
                    </div>
                    <div class="col">
                      <small>date of payment</small>
                    </div>
                  </div>
                  <div class="row text-center" v-for="payment in payments" :key="payment.pawned_id">
                    <div class="col">₱{{payment.payment}}</div>
                    <div class="col">{{payment.payment_date}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- pay modal -->
    <div class="modal" tabindex="-1" role="dialog" id="payForm">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Payment Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input
                  class="form-control"
                  type="number"
                  placeholder="amount"
                  v-model="user_payment"
                />
              </div>
              <div class="col-12 mt-2">
                <button
                  type="button"
                  class="btn btn-success btn-block"
                  @click="pushPayment()"
                  :disabled="user_payment.trim().length == 0"
                >Push Payment</button>
              </div>
            </div>
            <div class="row">
              <div class="col"></div>
              <div class="col">
                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
              </div>
              <div class="col"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ReportModal -->
    <modal-report-user ref="reportModal"></modal-report-user>
    <modal-pawning ref="modalPawning"></modal-pawning>


   <list-of-pawned-items>  </list-of-pawned-items>

  </div>
</template>

<script>
import BidService from "../../services/Bid.controller";
import AuthService from "../../services/auth";
import UserService from "../../services/User.controller";
import PackageService from "../../services/Package.controller";
import PawnService from "../../services/Pawning.controller";
import Swal from "sweetalert2";


export default {
  data: () => {
    return {
      activeTab: "active",
      items: [],
      records: [],
      declineActive: false,
      packages: [],
      pawning_info: {
        notif_days: "",
        ext_months: "",
        reason: "",
        package: 0
      },
      pawning_amount: {
        interest_rate: 0
      },
      payments: [],
      user_payment: "",
      durations: [],
      item: {},
      pawned_item: {},
      bidAmountEditable: true
    };
  },
  created() {
    AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({ path: "/Login" });
      });

    this.viewPendingItems();
    this.viewRecords();
  },
  computed: {},
  methods: {

     modalPawningShow(item){
      this.$refs.modalPawning.item = item;
       $('#modalPawning').modal('show');
     },

    getInterestRate(amt,intrst){
      let amount = parseFloat(amt);
      let interest = parseInt(intrst)/100;

      return (amount * interest);
    },

    report(data){
      //let spreadedData = { ...data };
        // this.$refs.reportModal.data = data;",
        this.$refs.reportModal.username = data.username;
        this.$refs.reportModal.item_name = data.item_name;
        this.$refs.reportModal.report.userId = data.user_id;
        this.$refs.reportModal.report.pawnshopId = data.pawnshop_id;
      
        $('#reportModal').modal("show");
    },

    pushPayment() {
      PawnService.methods
        .payPawn({
          pawnedId: this.pawned_item.item_id,
          payment: this.user_payment
        })
        .then(() => {
          Swal.fire({
            title: "Epawn Application",
            text: "Transaction Saved"
          }).then(e => {
            $("#payForm").modal("close");
          });
        });
    },
    goBack(){
      this.$router.push({ path : '/'})
    },
    viewPendingItems() {
      BidService.methods
        .getMyBiddings({ pawnshop_id: AuthService.methods.getUid() })
        .then(res => {
          this.items = [...res];
        });
    },
    pawned(item) {
      $("#pawnModal").modal("show");
      this.item = { ...item };
      this.viewMyPackages();
    },
    declineItem() {
      let data = {
        pawnshop_id: AuthService.methods.getUid(),
        item_id: this.item.item_id,
        user_id: this.item.user_id,
        package_id: this.pawning_info.package,
        days_deadline: this.pawning_info.notif_days,
        months_ext: this.pawning_info.ext_months,
        reason: this.pawning_info.reason
      };
      BidService.methods.rejectDeal(data).then(e => {
        Swal.fire({
          title: "Epawn Application",
          text: "Item Rejected Succesfully",
          icon: "success"
        });
        this.viewPendingItems();
        $("#pawnModal").modal("hide");
      });
    },
    pawnItem() {

      for(let i = 0 ; i < this.durations.length ; i++){
        let data = {
          pawnshop_id: AuthService.methods.getUid(),
          item_id: this.item.item_id,
          user_id: this.item.user_id,
          package_id: this.pawning_info.package,
          days_deadline: this.pawning_info.notif_days,
          bid_from : this.durations[i].duration_from,
          bid_to : this.durations[i].duration_to,
          months_ext: this.pawning_info.ext_months,
          pawn_amount: this.item.initial_amount,
          interest_per_durationdays : 
          ( 
            parseFloat(this.item.initial_amount) * parseFloat((String("0."+ this.durations[i].interestRate))) / parseFloat(((this.durations[i].duration_to + 1)) -
         parseFloat(this.durations[i].duration_from ))).toFixed(2)
      };
      console.info(this.item);
      BidService.methods.AcceptDeal(data).then(e => {

        if( i == this.durations.length-1){
        Swal.fire({
          title: "Epawn Application",
          text: "Item Pawned Succesfully",
          icon: "success"
        });
        this.viewPendingItems();
        $("#pawnModal").modal("hide");
        }
       
      });



      }
      
    },
    viewMyPackages() {
      PackageService.methods
        .getPawnshopPackages({ pawnshopId: AuthService.methods.getUid() })
        .then(res => {
          this.packages = [...res];
        });
    },
    viewRecords() {
      BidService.methods
        .getMyBiddingRecords({ pawnshop_id: AuthService.methods.getUid() })
        .then(res => {
          this.records = [...res];
        });
    },
    viewRejectedReason(item) {
      console.info("reason ", item);
      Swal.fire({
        title: "Reason",
        text: item.pawn_reason,
        icon: "error"
      });
    },
    ManagePawnedItem(item) {
      $("#itemModal").modal("show");

      this.pawned_item = { ...item };
      this.viewPaymentHistory();
    },
    viewDuration(id) {
      PackageService.methods.getDuration({ packageId: id }).then(res => {
        this.durations = [...res];
      });
    },
    launchPaymentModal(item) {
      $("#payForm").modal("show");
      this.pawned_item = { ...item };
    },
    viewPaymentHistory() {
      PawnService.methods
        .getPaymentHistory({
          itemId: this.pawned_item.item_id
        })
        .then(res => {
          this.payments = [...res];
        });
    }
  }
};
</script>


<style scoped>
.row {
  margin: initial !important;
  padding: 10px 0px;
}
.tab-body {
  width: 100%;
  padding: 10px;
  background-color: white;
  border: #f57224 solid 2px;
}
.parent-div {
  margin: 3% 10%;
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
.active {
  color: white;
  background-color: #f57224;
}
.normal {
  color: #f57224;
  background-color: white;
}
</style>