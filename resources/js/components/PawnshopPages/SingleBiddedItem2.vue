<style lang="scss" scoped>
.parent-div {
   padding: 30px 50px 0px 50px;
   display: flex;
   justify-content: center;
   align-items: center;
   .container {
      margin: 10px 10px 10px 10px;
      padding: 30px 10px 10px 30px;

      .details {
         padding-bottom: 30px;
         border-bottom: 2px solid #eff0f5;

         margin-bottom: 30px;

         .item-image {
            text-align: right;
            img {
               height: 180px;
               width: 180px;
               object-fit: cover;
               margin-left: 20px;
               border: #f57224 3px solid;
            }
         }
         .item-desc {
            text-align: left;
            .item-name {
               display: inline;
               white-space: nowrap;
               overflow: hidden;
               text-overflow: ellipsis;
            }
            .item-description {
               font-size: 15px;
               height: 100px;
               width: 100%;
               overflow-y: scroll;
            }
         }
      }

      .chat {
         .messages {
            padding: 0px 50px 30px 50px;
            border-bottom: 3px solid #eff0f5;
            margin-bottom: 30px;

            // .bid-align-right {
            // 	direction: rtl;
            // }
            // .bid-align-left {
            // 	direction: ltr;
            // }
            .placement-bid {
               padding: 3px 20px;
               border-radius: 7px;
               width: max-content;
               margin-top: 3px;
               font-weight: bold;
               display: flex;
               cursor: pointer;
               /* float: right; */

               .btn {
                  margin-left: 30px;
               }
            }

            .from-bidder {
               color: #f57224;
               background-color: white;
               border: 1px #f57224 solid;
            }
            .from-pawnshop {
               color: white;
               background-color: #f57224;
            }
         }
         .form {
            padding: 0px 50px 30px 50px;
            border-bottom: 3px solid #eff0f5;
         }
      }
   }
}
</style>


<template>
   <div class="parent-div">
      <div class="container">
         <div class="row details">
            <div class="col-md-3 item-image">
               <img v-bind:src="'../../../images/'+itemProfilePicture" />
            </div>
            <div class="col-md-9 item-desc">
               <div class="item-name">
                  <h2>{{ itemName }}</h2>
               </div>
							 <h4>Pawner: {{ user.username }}</h4>
               <h6>Category: {{ itemCategoryName }}</h6>
               <div class="item-description">Item Description: {{ itemDescription }}</div>
            </div>
         </div>

         <div
            class="chat"
            v-if="
					itemDetails.length == 0 ||
						itemDetails[itemDetails.length - 1].initial_amount == 0
				"
         >
            <div class="row">
               <div class="col-12 messages">
                  <div class="item-body">
                     <div v-if="placements.length != 0">
                        <div v-for="(placement, index) in placements" :key="index">
                           <div
                              :style="
											placement.isFromPawnshop == 1
												? 'direction: rtl;'
												: 'direction: ltr;'
										"
                           >
                              <div
                                 class="placement-bid"
                                 :class="
												placement.isFromPawnshop == 1
													? 'from-pawnshop'
													: 'from-bidder'
											"
                              >
                                 {{
                                 (placement.bid_price != 0.0 ||
                                 placement.bid_price != null) &&
                                 (placement.bid_to == null || placement.bid_to == 0.0)
                                 ? `₱${placement.bid_price}`
                                 : `₱${placement.bid_to} - ₱${placement.bid_from} `
                                 }}
                                 <span
                                    style="font-size: 10px; align-self: flex-end;margin: 0px 4px 0px 4px; padding-bottom:5px; font-weight:normal;"
                                 >{{ placement.bid_date }}</span>
                                 <button
                                    v-if="
													placement.isFromPawnshop == 0 && placement.id == getLatestCustomerChat
												"
                                    class="btn btn-sm btn-success"
                                    @click="closeDeal(placement)"
                                 >
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Deal
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-12 form">
                  <div class="item-footer row">
                     <div class="col">
                        <!-- <div class="form-check">
									<input
										class="form-check-input"
										type="radio"
										name="exampleRadios"
										id="exampleRadios1"
										v-model="picked"
										value="exact"
										checked
									/>
									<label class="form-check-label" for="exampleRadios1"
										>Exact Amount</label
									>
                        </div>-->
                        <!-- <div class="form-check">
									<input
										class="form-check-input"
										v-model="picked"
										type="radio"
										@change="changeSelection()"
										name="exampleRadios"
										id="exampleRadios2"
										value="range"
									/>
									<label class="form-check-label" for="exampleRadios2"
										>Range</label
									>
                        </div>-->
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
                           :disabled="bidamount.trim().length == 0"
                           @click="sendBid()"
                        >
                           <i class="fa fa-paper-plane" aria-hidden="true"></i> Appraise
                        </button>

                        <button
                           class="btn btn-success btn-full"
                           style="font-size: 15px;"
                           v-if="picked == 'range'"
                           :disabled="
										bid_range.from.trim().length == 0 ||
											bid_range.to.trim().length == 0 ||
											Number(bid_range.from) >= Number(bid_range.to)
									"
                           @click="sendBid()"
                        >
                           <i class="fa fa-paper-plane" aria-hidden="true"></i> Appraise
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div v-else>
            <div class="alert alert-warning" role="alert">
               <strong>Pending :</strong> Deal was closed with the price of
               <b>₱{{ itemDetails[itemDetails.length - 1].initial_amount }}</b>
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
<script>
import AuthService from "../../services/auth";
import PostItemService from "../../services/PostItem.controller";
import UserService from "../../services/User.controller";
import BidService from "../../services/Bid.controller";
import SMS from "../../services/SMS.controller";
import Swal from "sweetalert2";

export default {
   computed: {
      getLatestCustomerChat() {
         let last = false;
         this.placements.map(function(data, index) {
            if (data.isFromPawnshop == 0) {
               last = data.id;
            }
         });
         return last;
      }
   },
   data: () => {
      return {
         itemProfilePicture: "",
         itemDetails: [],
         placements: [],
         bidamount: "",
         bid_range: {
            from: "",
            to: ""
         },
         picked: "range",
         timer: Object,
         user: {},
         itemProfilePicture:"",
         itemName:"",
         itemCategoryName: "",
         itemDescription: "",

      };
   },

   mounted() {
      
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
         // this.timerStart();
         this.getUserInfo();
      });

      console.info(this.$route.query.itemId);
   },

   destroyed() {
      // this.timerClose();
   },

   events: {
		getChatEvent(data) {
			console.log("from SingleBidItem:" + data);
			this.displayBidPlacement();
      },
      
      // getNotificationsLink(link) {
      //    console.log("shit");
		// 	this.pushLink(link);
		// }
	},

   methods: {
      // pushLink(link){
      //    console.log("shit "+link);
	   //    this.$router.push(link);
      // },
      timerStart() {
         this.timer = setInterval(() => {
            // this.displayBidPlacement();
         }, 25000);
      },
      timerClose() {
         clearInterval(this.timer);
      },
      async getUserInfo() {
         let user_id = this.itemDetails[0].user_id;
         await axios
            .get("/api/getUserInfo/" + user_id)
            .then(res => {
               console.log(res);
               this.user = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      },

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
                  this.itemProfilePicture = this.itemDetails[0].item_photo
                  this.itemName = this.itemDetails[0].item_name
                  this.itemCategoryName = this.itemDetails[0].category_name
                  this.itemDescription = this.itemDetails[0].item_description
                  resolve(this.itemDetails);
               });
         });
      },
      closeDeal(placement) {
         if (placement.bid_price == 0 || placement.bid_price == null) {
            if (placement.bidprice !== null) {
               Swal.fire({
                  title: "Epawn Application",
                  html: "Ranged amount cannot be use to close the deal",
                  icon: "error",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Yes",
                  cancelButtonText: "No"
               }).then(r => {});
               return true;
            }
         }
         let message =
            placement.isFromPawnshop == 0
               ? `The owner of the item wants to have an amount of <b>₱${placement.bid_price}</b>`
               : `Close the deal with the amount of <b>₱${placement.bid_price} </b> ?`;

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
            isFromPawnshop: 1
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
                     isRange:
                        this.bid_range.to.trim().length == 0 ? true : false,
                     bid_from: this.bid_range.from,
                     bid_to: this.bid_range.to,
                     itemName: this.itemDetails[0].item_name
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
            }).then(e => {
               window.location.reload();
            });
         });
      }
   }
};
</script>


