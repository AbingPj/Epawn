<template>
  <div class="parent-div">
     <div class="row mb-2"> 
      <div class="col-6"> 
        <button type="button" class="btn btn-outline-success " @click="goBack()"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</button>
      </div>
    </div>

    <div class="row navbar">
      <div
        class="col navbar-item"
        v-bind:class="{ 'active': activeTab == 'category' , 'normal' : activeTab != 'category'}"
        v-on:click="activeTab = 'category'; getCategoryRequestNotifications();"
      >
        <i class="fa fa-files-o" aria-hidden="true"></i> Category Requests
      </div>
      <div
        v-bind:class="{ 'active': activeTab == 'superAdmin' , 'normal' : activeTab != 'superAdmin'}"
        v-on:click="activeTab = 'superAdmin'; getSuperAdminNotifications();"
        class="col navbar-item"
      >
        <i class="fa fa-balance-scale mr-2"></i> Super Admin
      </div>
    </div>

    <div class="with-border tab-body mt-2" v-if="activeTab == 'superAdmin'">
      <div v-if="superAdminNotifs.length == 0" class="col-12 text-center">
        <div class="alert alert-danger" role="alert">No notifications yet</div>
      </div>
      <div v-else>
        <div
          class="mt-2"
          style="margin-top: 5px !important;"
          role="alert"
          v-for="superadminNotif in superAdminNotifs"
          :key="superadminNotif.user_id"
        >
          <div class="alert alert-success" role="alert">
            You have joined epawn on
            <small class="text-colored"> {{superadminNotif.joined }}</small>
            and your status is
            <small
              class="text-colored"
            >Pending</small>
          </div>

            <div class="alert alert-success" v-if="superadminNotif.isValid == 1"> 
           Congratulations ! Your registration credentials has been <small class="text-colored"> Accepted </small> on <small class="text-colored"> {{superadminNotif.noticed}} </small>
          </div>
       
          
        </div>
      </div>
    </div>
    <div class="with-border tab-body mt-2" v-if="activeTab == 'category'">
      <div v-if="categoryRequests.length == 0" class="col-12 text-center">
        <div class="alert alert-danger" role="alert">No notifications yet</div>
      </div>
      <div v-else>
        <div class="card mt-2" v-for="category in categoryRequests" :key="category.category_id">
          <div class="card-header alert-success">
            <div class="row" style="padding: initial !important;">
              <div class="col">
                <small class="text-colored">category name</small>
                <br />
                {{category.category_name}}
              </div>
              <div class="col">
                <small class="text-colored">category status</small>
                <br />
                {{(category.valid == 0) ? 'Pending' : 'Rejected'}}
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">
              <small class="text-colored">category description</small>
              <br />
              {{category.category_description}}
            </p>

            <div class="row">
              <div class="col" v-if="category.reason">
                <button
                  type="button"
                  class="btn btn-success btn-block"
                  @click="viewReason(category.reason)"
                >View Reason</button>
              </div>
              <div class="col">
                <button
                  type="button"
                  class="btn btn-danger btn-block"
                  @click="deleteNotif(category.category_id, 'category')"
                >Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.row {
  margin: initial !important;
  padding: 10px 0px;
}
.text-colored {
  color: #f57224;
  font-weight: bold;
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
<script>
import NotifService from "../services/notification.controller";
import AuthService from "../services/auth";
import Swal from "sweetalert2";

export default {
  data: () => {
    return {
      activeTab: "category",
      categoryRequests: [],
      superAdminNotifs: []
    };
  },
  created() {
    setInterval(()=>{
      this.getCategoryRequestNotifications();
      this.getSuperAdminNotifications();
    },10000)
  },
  methods: {
    selectSideItem(item) {},
    getCategoryRequestNotifications() {
      NotifService.methods
        .getCategoryRequestNotifications({
          userId: AuthService.methods.getUid()
        })
        .then(res => {
          this.categoryRequests = [...res];
        });
    },
    viewReason(reason) {
      Swal.fire({
        title: "Reason of Rejection",
        text: reason,
        icon: "error"
      });
    },
    getSuperAdminNotifications() {
      NotifService.methods
        .getSuperAdminNotifications({
          userId: AuthService.methods.getUid()
        })
        .then(res => {
          this.superAdminNotifs = [...res];
        });
    },
    goBack(){
      this.$router.push({ path : '/'})
    },
    deleteNotif(categoryId, type) {
      Swal.fire({
        title: "Are you sure to remove this notif",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!"
      }).then(result => {
        if (result.value) {
          if (type == "category") {
            NotifService.methods
              .removeCategory({
                categoryId: categoryId
              })
              .then(() => {
                Swal.fire({
                  title: "Epawn Application",
                  text: "Deleted succesfully",
                  icon: "success"
                }).then(() => {
                  this.getCategoryRequestNotifications();
                });
              });
          } else {
          }
        }
      });
    }
  }
};
</script>