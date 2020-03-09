<template>
  <div class="parent-div">
    <div class="bidding-container">
      <div class="item-card">
        <div class="item-header">
          <img class="item-image" v-bind:src="`../../../images/${itemDetails[0].item_photo}`" />

          <div class="item-name">{{itemDetails[0].item_name}}</div>
        </div>

        <div v-if=" itemDetails.length ==0 || itemDetails[itemDetails.length-1].initial_amount == 0">
          <div class="item-body">
            <div v-if="placements.length != 0">
              <div
                class="placement-bid"
                v-for="(placement, index) in placements"
                v-bind:key="placement.item_id"
                @click="closeDeal(placement)"
                v-bind:class="[placement.isFromPawnshop && placement.isFromPawnshop==1 ? 'from-pawnshop' : 'from-bidder']"
              >
                <span
                  style="font-size: 10px; align-self: flex-end;margin-left: 4px; font-weight:normal;"
                >{{placement.bid_date}}</span>
                {{  (placement.bid_price != 0.00 || placement.bid_price != null) &&
                 (placement.bid_to == null || placement.bid_to == 0.00)? 
                `₱${placement.bid_price}` : 
                `₱${placement.bid_to} - ₱${placement.bid_from} ` }}
              </div>
            </div>
            <!-- <button class="deal-btn" data-toggle="modal" data-target="#dealModal">Open Deal</button> -->
          </div>

          <div class="item-footer row">
            <div class="col">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="exampleRadios"
                  id="exampleRadios1"
                  v-model="picked"
                  value="exact"
                  checked
                />
                <label class="form-check-label" for="exampleRadios1">Exact Amount</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  v-model="picked"
                  type="radio"
                  @change="changeSelection()"
                  name="exampleRadios"
                  id="exampleRadios2"
                  value="range"
                />
                <label class="form-check-label" for="exampleRadios2">Range</label>
              </div>
            </div>
            <div class="col col-8">
              <input
                placeholder="Send Appraisal Amount"
                type="number"
                v-if="picked == 'exact'"
                v-model="bidamount"
                class="form-control"
              />
              <div v-if="picked == 'range'" class="row">
                <input
                  placeholder="From amount"
                  type="number"
                  v-model="bid_range.from"
                  class="form-control col"
                />
                <input
                  placeholder="To amount"
                  type="number"
                  v-model="bid_range.to"
                  class="form-control col ml-2"
                />
              </div>
            </div>

            <div class="col">
              <button
                class="btn btn-success btn-full"
                style="font-size: 15px;"
                v-if="picked == 'exact'"
                :disabled="(bidamount.trim().length == 0) "
                @click="sendBid()"
              >
                <i class="fa fa-paper-plane" aria-hidden="true"></i> Appraise
              </button>

              <button
                class="btn btn-success btn-full"
                style="font-size: 15px;"
                v-if="picked == 'range'"
                :disabled="(bid_range.from.trim().length == 0 || bid_range.to.trim().length == 0) ||
                (Number(bid_range.from) >= Number(bid_range.to))
              "
                @click="sendBid()"
              >
                <i class="fa fa-paper-plane" aria-hidden="true"></i> Appraise
              </button>
            </div>
          </div>
        </div>

        <div v-else>
          <div class="alert alert-warning" role="alert">
           <strong> Pending : </strong> Deal was closed with the price of <b> ₱{{itemDetails[itemDetails.length-1].initial_amount}} </b>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Open deal -->
    <div class="modal" tabindex="-1" role="dialog" id="dealModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Open Deal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <small>Bid Amount</small>
            <input class="form-control" />

            <small>Package</small>
            <select class="form-control"></select>

            <small>Interest Rate</small>
            <input class="form-control" placeholder="Bid Amount" disabled />

            <small>Months to apply interest</small>
            <input class="form-control" placeholder="Bid Amount" disabled />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.form-check-label {
  font-size: 13px;
}
.deal-btn {
  width: max-content;
  padding: 0px 20px;
  border: none;
  background-color: #f57224;
  color: white;
  padding-bottom: 2px;
}
.item-body {
  height: auto;
  /* overflow: auto; */
  padding-bottom: 10px;
  border-bottom: 2px solid #eff0f5;
  direction: rtl;
}
.from-bidder {
  color: #f57224;
  background-color: white;
  align-self: start;
  border: 1px #f57224 solid;
}
.from-pawnshop {
  color: white;
  align-self: end;
  background-color: #f57224;
}
.placement-bid {
  padding: 3px 20px;
  border-radius: 7px;
  width: max-content;
  margin-top: 3px;
  font-weight: bold;
  display: flex;
  cursor: pointer;

  /* float: right; */
}

.item-footer {
  position: relative;
}
.footer-input {
  width: 100%;
  padding: 2px 20% 2px 10px !important;
}
.footer-button {
  width: 17%;
  border: none;
  background-color: #f57224;
  color: white;
  right: 1px;
  position: absolute;
  padding-bottom: 2px;
}
.item-header {
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 2px solid #eff0f5;
}
.item-name {
  display: inline;
  font-size: 30px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.item-image {
  height: 80px;

  width: 80px;
  border: #f57224 3px solid;
  margin-left: 20px;
}
.bidding-container {
  width: 80%;
  margin-top: 20px;
  display: inline-block;
}
.bidding-options {
  padding: 20px;
  background: white;
  display: inline-block;
  margin-left: 30px;
  width: 30%;
  /* height: 100px; */
  position: relative;
}
.option-buttons {
  background-color: #f57224;
  color: white;
  border: none;
  right: 2px;
  font-size: 15px;
  position: absolute;
  width: 20%;
  height: 70%;
}
.bid-input {
  width: 100%;
  position: absolute;
  padding-right: 30%;
}
.item-card {
  padding: 8px;
  display: inline-block;
  width: 100%;
  background: white;
}
.parent-div {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
<script>
import AuthService from "../services/auth";
import PostItemService from "../services/PostItem.controller";
import UserService from "../services/User.controller";
import BidService from "../services/Bid.controller";
import SMS from "../services/SMS.controller";
import Swal from "sweetalert2";

export default {
  data: () => {
    return {
      itemDetails: [],
      placements: [],
      bidamount: "",
      bid_range: {
        from: "",
        to: ""
      },
      picked: "exact"
    };
  },
  created() {
    AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({ path: "/Login" });
      });
    this.getItemInfo().then(res => {
      this.displayBidPlacement();
    });

    console.info(this.$route.query.itemId);
  },
  methods: {
    // getTitle(placement) {
    //   let data;
    //   UserService.methods.getUserDetails(placement.user_id).then(res => {
    //     data = [...res];
    //     console.info("get title ", res[0].username);
    //     localStorage.setItem("username_title", res[0].username);
    //   });

    //   return placement.isFromPawnshop == 1
    //     ? `You are placing a bid of ₱${placement.bid_price}`
    //     : `${localStorage.getItem("username_title")} is fighting a bid of ₱${
    //         placement.bid_price
    //       }`;
    // },
    getItemInfo() {
      return new Promise((resolve, reject) => {
        PostItemService.methods
          .getSingleItem(this.$route.query.itemId)
          .then(res => {
            this.itemDetails = [...res];
            resolve(this.itemDetails);
          });
      });
    },
    closeDeal(placement) {
        if(placement.bid_price == 0 || placement.bid_price == null){
           if (placement.bidprice !== null) {
        Swal.fire({
          title: "Epawn Application",
          html: 'Ranged amount cannot be use to close the deal',
          icon: "error",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          cancelButtonText: "No"
        }).then(r => {
        });
          return true;
           }
        }
      let message = (placement.isFromPawnshop == 0) 
        ? `The owner of the item wants to have an amount of <b>₱${placement.bid_price}</b>` :
       `Close the deal with the amount of <b>₱${placement.bid_price} </b> ?`;

      if (placement.bidprice !== null) {
        Swal.fire({
          title: "Epawn Application",
          html: message,
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          cancelButtonText: "No"
        }).then(r => {
          if (r.value) {
            this.agreeDeal(placement);
          }
        });
      } else {
        Swal.fire({
          title: "Amount range cannot be closed to deal",
          text: "Note : It Must be a specific amount",
          icon: "error"
        });
      }
      
    },
    sendBid() {
      let data = {
        itemId: this.$route.query.itemId,
        bidamount: this.bidamount,
        bid_from: this.bid_range.from,
        bid_to: this.bid_range.to,
        userId: this.itemDetails[0].user_id,
        pawnshopId: AuthService.methods.getUid(),
         isFromPawnshop : 1
      };
      BidService.methods.placeBid(data).then(res => {
        console.info(res);
        this.bidamount = "";
        UserService.methods
          .getUserDetails(AuthService.methods.getUid())
          .then(res => {
            let smsData = {
              pawnshop_name: res[0].fname,
              bidamount: data.bidamount,
              isRange: this.bid_range.to.trim().length == 0 ? true : false,
              bid_from: this.bid_range.from,
              bid_to: this.bid_range.to,
              itemName: this.itemDetails[0].item_name,
             
            };
            console.info("sns sms", smsData);
            SMS.methods.sendSMS(smsData);
            Swal.fire({
              title: "Epawn Application",
              text: "Bid sent succesfully with SMS ",
              icon: "success"
            });
          });
        this.displayBidPlacement();
      });
    },
    displayBidPlacement() {
      console.info("bid details", this.itemDetails);
      let data = {
        itemId: this.$route.query.itemId,
        bidderId: this.itemDetails[0].user_id,
        pawnshopId: AuthService.methods.getUid()
      };
      BidService.methods.displayBidDetails(data).then(res => {
        this.placements = [...res];
      });
    },
    changeSelection() {
      this.bid_range.from = "";
      this.bid_range.to = "";
      this.bidamount = "";
    },
    agreeDeal(placement) {
      BidService.methods.closeDeal(placement).then(res => {
        Swal.fire({
          html: `Deal succesfully closed with the amount of <b>₱${placement.bid_price}</b>`,
          icon: "success"
        }).then( e=>{
  window.location.reload();
        });
      });
    
    }
  }
};
</script>