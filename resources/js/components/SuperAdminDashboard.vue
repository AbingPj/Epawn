<template>
  <div class="parent-div">
    <i class="fa fa-sign-out logout-icon" title="Logout" @click="logout()" aria-hidden="true"></i>
    <div id="accordion">
      <div class="card  mb-5">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button
              class="btn btn-link"
              data-toggle="collapse"
              data-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne"
            >Item Category</button>
          </h5>
        </div>

        <div
          id="collapseOne"
          class="collapse show"
          aria-labelledby="headingOne"
          data-parent="#accordion"
        >

          <!--  custom tab -->
        <div class="row p-3"> 
          <div class="col"> <button class="btn btn-block" :class="categoryTab == 'pending'? 'btn-warning' : 'btn-light'" @click="categoryChangeTab('pending'); categoryTab = 'pending'; "> Pending  </button> </div>
          <div class="col"> <button class="btn btn-block" :class="categoryTab == 'accepted'? 'btn-success' : 'btn-light'" @click="categoryChangeTab('accepted'); categoryTab = 'accepted'; "> Accepted </button> </div>
          <div class="col"> <button class="btn btn-block" :class="categoryTab == 'rejected'? 'btn-danger' : 'btn-light'" @click="categoryChangeTab('rejected'); categoryTab = 'rejected'; "> Rejected </button> </div>
        </div>
        <!-- pending categories -->
          <div class="card-body" v-if="categoryTab == 'pending'">
            <div class="alert alert-danger text-center" role="alert" v-if="category_requests.length == 0"> No Pending Requests yet</div>
            <div v-if="category_requests.length != 0">
              <div class="alert alert-warning"  role="alert" v-for="category in category_requests" :key="category.category_id">
                <b>{{category.fname}}</b>
                <br />
                {{category.category_name}}
                <br />
                <small>{{category.category_description}}</small>

                <button
                  type="button"
                  style="float: right; margin-top: -20px;"
                  @click="launchModal(category.category_id)"
                  class="btn btn-danger ml-2 mb-3"
                >Decline</button>
                <button
                  type="button"
                  style="float: right; margin-top: -20px;"
                  @click="acceptCategory(category.category_id)"
                  class="btn btn-success mb-3"
                >Accept</button>
              </div>
            </div>
          </div>
          <!-- accepted categories -->
          <div class="card-body" v-if="categoryTab == 'accepted'">
            <div class="alert alert-danger text-center" role="alert" v-if="category_requests.length == 0"> No Accepted Request is yet</div>
            <div v-if="category_requests.length != 0">
              <div class="alert alert-success"  role="alert" v-for="category in category_requests" :key="category.category_id">
                <b>{{ (category.fname) ? category.fname : 'Super Admin'}}</b>
                <br />
                {{category.category_name}}
                <br />
                <small>{{category.category_description}}</small>

                <!-- <button
                  type="button"
                  style="float: right; margin-top: -20px;"
                  @click="launchModal(category.category_id)"
                  class="btn btn-danger ml-2 mb-3"
                >Decline</button>
                <button
                  type="button"
                  style="float: right; margin-top: -20px;"
                  @click="acceptCategory(category.category_id)"
                  class="btn btn-success mb-3"
                >Accept</button> -->
              </div>
            </div>
          </div>
            <!-- rejected categories -->
          <div class="card-body" v-if="categoryTab == 'rejected'">
            <div class="alert alert-danger text-center" role="alert" v-if="category_requests.length == 0"> No Rejected Request is yet</div>
            <div v-if="category_requests.length != 0">
              <div class="alert alert-danger"  role="alert" v-for="category in category_requests" :key="category.category_id">
                <b>{{category.fname}}</b>
                <br />
                {{category.category_name}}
                <br />
                <small>{{category.category_description}}</small>

                <button
                  type="button"
                  style="float: right; margin-top: -20px;"
                  @click="viewRejectedCategory(category.category_reason)"
                  class="btn btn-danger mb-3"
                >Details</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-5">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button
              class="btn btn-link collapsed"
              data-toggle="collapse"
              data-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo"
            >Pawnshops Panel</button>
          </h5>
        </div>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordion"
        >
        

          <div class="card-body">
            <div class="row mb-3"> 
              <div class="col"> <button class="btn btn-block" :class="pawnshopTab == 'pending'? 'btn-warning' : 'btn-light'" @click="pawnshopChangeTab('pending'); pawnshopTab = 'pending'; "> Pending  </button> </div>
              <div class="col"> <button class="btn btn-block" :class="pawnshopTab == 'accepted'? 'btn-success' : 'btn-light'" @click="pawnshopChangeTab('accepted'); pawnshopTab = 'accepted'; "> Accepted  </button> </div>
              <div class="col"> <button class="btn btn-block" :class="pawnshopTab == 'rejected'? 'btn-danger' : 'btn-light'" @click="pawnshopChangeTab('rejected'); pawnshopTab = 'rejected'; "> Rejected  </button> </div>
              <div class="col"> <button class="btn btn-block" :class="pawnshopTab == 'expired'? 'btn-danger' : 'btn-light'" @click="pawnshopChangeTab('expired'); pawnshopTab = 'expired'; "> Expired  </button> </div>

            </div>

            <div class="alert alert-danger text-center" v-if="pendingUsers.length == 0"> 
               There are no {{pawnshopTab}} pawnshops yet
            </div>
            <div v-else>
              

             <div
              class="row alert alert-primary"
              :class="pawnshopTab == 'pending' ? 'alert-warning' : pawnshopTab == 'accepted' ? 'alert-success' : pawnshopTab == 'rejected' ? 'alert-danger' : ''" 
              role="alert"
              v-for="user in pendingUsers"
              :key="user.user_id"
            >
        
              <div class="col">
                {{user.fname}} <br>
                <small> <b> Report Count: </b>{{user.flag}}</small>
              </div>
              <div class="col">

                <img
                  style="height: 45px;"
                  title="click to zoom"
                  :src="(user.business_permit) ?  `../../images/${user.business_permit}` : `../../images/no-image.png`"
                  @click="maximize(user.business_permit)"
                />


                Control #: {{ (user.control_num) ? user.control_num : 'None' }}
                <button class="btn  float-right" 
                :class="pawnshopTab == 'pending' ? 'btn-warning' : pawnshopTab == 'accepted' ? 'btn-success' : pawnshopTab == 'rejected' ? 'btn-danger' : ''" 

                @click="manageUser(user)">  

                  {{ (pawnshopTab == 'rejected') ? 'Unblock' : 'Manage' }}
                </button>
              </div>




            </div>


            </div>
          </div>


          
        </div>
      </div>

      <reported-users></reported-users>

      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button
              class="btn btn-link collapsed"
              data-toggle="collapse"
              data-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree"
            >Collapsible Group Item #3</button>
          </h5>
        </div>
        <div
          id="collapseThree"
          class="collapse"
          aria-labelledby="headingThree"
          data-parent="#accordion"
        >
          <div
            class="card-body"
          >Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="reasonModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Declining an item category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input
              class="form-control"
              v-model="declineCategoryData.reason"
              placeholder="Type your reason here..."
            />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              :disabled="declineCategoryData.reason.trim().length == 0"
              @click="declineCategory()"
            >Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal for fucking the user -->

    <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      id="userModal"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ (pawnshopTab == 'rejected') ? 'Unblock a Pawnshop' : 'Manage a Pawnshop'}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input
              class="form-control"
              placeholder="Reason for rejecting the user"
              v-if="!isAccept"
              v-model="reason"
            />
            <div class="row mt-2" v-if="pawnshopTab == 'pending'">
              <div class="col">
                <button
                  type="button"
                  v-if="isAccept"
                  @click="changeStatus(1)"
                  class="btn btn-success btn-lg btn-block"
                >Accept</button>
                <button
                  type="button"
                  v-if="!isAccept"
                  @click="changeStatus(2)"
                  class="btn btn-danger btn-lg btn-block"
                >Reject</button>
              </div>
              <div class="col">
                <button
                  type="button"
                  v-if="isAccept"
                  @click="isAccept = !isAccept"
                  class="btn btn-danger btn-lg btn-block"
                >Reject</button>
                <button
                  type="button"
                  v-if="!isAccept"
                  @click="isAccept = !isAccept"
                  class="btn btn-danger btn-lg btn-block"
                >Cancel</button>
              </div>
            </div>
            <div class="row mt-2" v-if="pawnshopTab == 'rejected'">
              <div class="col-12"> 
                 <button
                  type="button"
                  @click="changeStatus(1)"
                  class="btn btn-danger btn-lg btn-block"
                >Unblock The Pawnshop</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- clciking an image to be fullscreen -->
    <div class="overlay" v-if="isZoomed" @click="isZoomed = !isZoomed">
      <img
        :src="`../../images/${imageSelected}`"
        
        class="overlayed-image"
      />
    </div>
  </div>
</template>
<style scoped>
.overlay {
  /* Height & width depends on how you want to reveal the overlay (see JS below) */
  position: fixed;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  z-index: 20;
  top: 0;
  left: 0;
}
.overlayed-image {
  height: 100%;
  display: block;
  margin: auto;
}

.logout-icon {
  font-size: 40px;
  position: absolute;
  z-index: 2;
  cursor: pointer;
  top: 0;
  right: -50px;
}
.logout-icon:hover {
  color: #f57224;
}
.body {
  width: 100%;
  padding: 10px;
  margin-top: 2%;
}
.parent-div {
  font-family: "Roboto";
  position: relative;
  background-color: white;
  margin: 3% 10%;
}
</style>
<script>
import PackageService from "../services/Package.controller";
import AuthService from "../services/auth";
import UserService from "../services/User.controller";
import Swal from "sweetalert2";

export default {
  data: () => {
    return {
      category_requests: [
        {
          category_id: null
        }
      ],
      categoryTab : 'pending',
      usersTab : 'pending',
      reason: "",
      imageSelected: "",
      isZoomed: false,
      pendingUsers: [],
      user: {},
      declineCategoryData: {
        reason: "",
        category_id: null
      },
      isAccept: true,
      pawnshopTab : 'pending'
    };
  },
  created() {
    AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({ path: "/Login" });
      });
    this.getItemCategories();
    this.getPendingUsers();
  },
  methods: {
    pawnshopChangeTab(tab){
      if(tab == 'pending'){
        UserService.methods.getPendingUsers({
          status : '0'
        }).then(res => {
          this.pendingUsers = [...res];
        });
      }else if(tab == 'accepted'){
        UserService.methods.getPendingUsers({
          status : '1'
        }).then(res => {
          this.pendingUsers = [...res];
        });
      }else if(tab == 'rejected'){
        UserService.methods.getPendingUsers({
          status : '2'
        }).then(res => {
          this.pendingUsers = [...res];
        });
      }else if(tab == 'expired'){
         UserService.methods.getPendingUsers({
          status : '3'
        }).then(res => {
          this.pendingUsers = [...res];
        });
      }
    },
    viewRejectedCategory(reason){
      Swal.fire({
        title : "Reason",
        text : reason,
        icon: 'info'
      });
    },
    getItemCategories() {
      PackageService.methods.getPendingCategories({
        status : '0'
      }).then(res => {
        this.category_requests = [...res];
      });
    },
    categoryChangeTab(tab){
      if(tab == 'pending'){
         PackageService.methods.getPendingCategories({
           status : '0'
         }).then(res => {
        this.category_requests = [...res];
      });
      }else if(tab == 'accepted'){
        PackageService.methods.getPendingCategories({
           status : '1'
          }).then(res => {
          this.category_requests = [...res];
        });
      }else if(tab == 'rejected'){
        PackageService.methods.getPendingCategories({
           status : '3'
          }).then(res => {
          this.category_requests = [...res];
        });
      }
    },
    declineCategory() {
      PackageService.methods
        .declineCategry(this.declineCategoryData)
        .then(res => {
          Swal.fire({
            title: "Epawn Application",
            text: "category succesfully rejected",
            icon: "success"
          });
        }).then(e=>{
          $("#reasonModal").modal("close");
        });
    },
    launchModal(category_id) {
      this.declineCategoryData.category_id = category_id;
      $("#reasonModal").modal("show");
    },
    acceptCategory(category_id) {
      let obj = { category_id: category_id };
      PackageService.methods.acceptCategory(obj).then(res => {
        Swal.fire({
          title: "Epawn Application",
          text: "category succesfully accepted and ready for use",
          icon: "success"
        });
        this.getItemCategories();
      });
    },
    maximize(image) {
      this.imageSelected = image;
      this.isZoomed = !this.isZoomed;
      console.info("asdasd", this.isZoomed);
    },
    logout() {
      AuthService.methods.Logout();
      this.$router.push({ path: "/Login" });
      Swal.fire({
        toast: true,
        text: "Succesfully logged Out",
        position: "top-right",
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
      });
    },
    getPendingUsers() {
      UserService.methods.getPendingUsers({
        status : '0'
      }).then(res => {
        this.pendingUsers = [...res];
      });
    },
    updateSatus(status, userId, reason) {
      let data = {
        userId: userId,
        status: status,
        reason: reason
      };
      UserService.methods.updateSatus(data).then(r => {
        this.getPendingUsers();

        Swal.fire({
          title: "Epawn Application",
          text : "Changes updated succesfully ",
          icon: "success",
        }).then( e=>{
          $('#userModal').modal('hide');
        });
      });
    },
    changeStatus(status) {
      this.reason == '' ? null : this.reason;
      this.updateSatus(status, this.user.user_id, this.reason);
    },
    manageUser(user) {
      this.isAccept = true;
      this.user = { ...user };
      $("#userModal").modal("show");
      // Swal.fire({
      //   title: "What do you want to do with this user? ",
      //   text: "You won't be able to revert this!",
      //   icon: "warning",
      //   showCancelButton: true,
      //   confirmButtonColor: "#3085d6",
      //   cancelButtonColor: "#d33",
      //   confirmButtonText: "Accept",
      //   cancelButtonText: "Reject"
      // })
    }
  }
};
</script>