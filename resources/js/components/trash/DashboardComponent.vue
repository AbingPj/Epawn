<template>
  <div class="parent-div">
    <div class="header row">
      <div class="banner-container">
        <div class="banner" title="Online Bidding App">
          <img :src="`../icon.png`" style="height: 150px;">
        </div>
      </div>
      <div class="col-6 search-container">
        <input placeholder="Search an item" class="search-input" />
        <button class="search-button">
          <i class="fa fa-search"></i>
        </button>
      </div>
      <div class="col others">
        <button class="others-button" title="My Biddings" v-on:click="gotoBiddings()">
          <i class="fa fa-handshake-o"></i>
        </button>
        <button class="others-button" title="My Profile" v-on:click="gotoProfile()">
          <i class="fa fa-user-circle"></i>
        </button>
        <button class="others-button" title="notification" @click="gotoNotifications()">
          <i class="fa fa-bell" aria-hidden="true"></i>
        </button>
        <button class="others-button" title="Logout" v-on:click="logOut()">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <div class="row alert alert-warning" role="alert"> 
      <small> <b> Note : </b> Items that are displayed below is only the item's category that you have offered. Want to offer more ? <a href="/MyProfile">   Click Here </a> to offer more category </small>
      
    </div>
    <div class="body">
      <div class="alert alert-danger text-center" v-if="items.length == 0" role="alert">
        No items are posted as of the moment
      </div>
      <div v-else>  
        <div
        class="item"
        v-for="item in items"
        v-bind:key="item.item_id"
        v-bind:title="item.item_name"
        v-on:click="viewSingleItem(item.item_id)"
      >
        <img class="item-image" v-bind:src="`../../images/${item.item_photo}`" />
        <div class="item-body">
          <div class="item-name">{{item.item_name}} {{item.item_id}}</div>
          <div class="item-description">{{item.item_description}}</div>
          <div class="item-date">{{item.date}}</div>
        </div>
      </div>

      </div>
    </div>
  </div>
</template>

<script>
import AuthService from "../services/auth";
import PostItemService from "../services/PostItem.controller";
import Swal from "sweetalert2";
export default {
  data: () => {
    return {
      items: [],
      info: {
        msg: "",
        type: ""
      },
      timer : Object
    };
  },
  mounted() {
    this.loadItems();
  },
  created() {
    AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({ path: "/Login" });
      });
      if(AuthService.methods.getUid() == 1){
        this.$router.push({ path: "/SuperAdmin/Board" });
      }

    if (window.localStorage.getItem("isUserValid") == 2) {
      Swal.fire({
        title: "Registration Rejected",
        html: `Your registration was rejected due to
             <small style='color: #f57224; font-weight: bold;'>
            ${window.localStorage.getItem("reason")} </small>
            `,
        icon: "error"
      }).then(() => {
        this.$router.push({ path: "/Login" });
      });
      AuthService.methods.Logout();
      this.$router.push({ path: "/Login" });
    } else if (window.localStorage.getItem("isUserValid") == 0) {
      ("Super admin is still reviewing your registration, your actions are limited");
    }
    this.timer = setInterval(()=>{
      this.loadItems();
    },30000);
    
  },
  methods: {
    gotoBiddings() {
      clearInterval(this.timer);
      this.$router.push({ path: "/MyBids" });
    },
    gotoProfile() {
      clearInterval(this.timer);
      this.$router.push({ path: "/MyProfile" });
    },
    loadItems() {
      PostItemService.methods.getAllItems({
          pawnshopId: AuthService.methods.getUid()
        })
        .then(res => {
          this.items = [...res];
        });
    },
    gotoNotifications() {
      clearInterval(this.timer);
      this.$router.push({ name: "admin-notification" });
    },
    viewSingleItem(itemId) {
      clearInterval(this.timer);
      this.$router.push({
        path: `/Singleitem/${itemId}`,
        query: { itemId: itemId }
      });
    },
    logOut() {
      clearInterval(this.timer);
      AuthService.methods.Logout();

      setTimeout(() => {
        this.$router.push({ path: "/Login" });
        Swal.fire({
          toast: true,
          text: "Succesfully logged Out",
          position: "top-right",
          timer: 3000,
          timerProgressBar: true,
          showConfirmButton: false
        });
      }, 1000);
    }
  }
};
</script>
<style scoped>
.item-date {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-weight: bold;
  margin-top: 13px;
  font-size: 10px;
}
.item-name {
  white-space: nowrap;
  font-size: 15px;
  font-weight: bold;
  overflow: hidden;
  text-overflow: ellipsis;
}
.item-description {
  font-size: 13px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.item-body {
  padding: 4px;
}
.item-image {
  width: 100%;
  height: 200px;
}
.item {
  display: inline-block;
  background-color: #f5f5f5;
  margin: 4px;
  width: 15%;
  cursor: pointer;
  border: 2px white solid;
}
.item:hover {
  -webkit-box-shadow: 3px 4px 23px -3px rgba(0, 0, 0, 0.75);
  -moz-box-shadow: 3px 4px 23px -3px rgba(0, 0, 0, 0.75);
  box-shadow: 3px 4px 23px -3px rgba(0, 0, 0, 0.75);
}
.body {
  width: 100%;
  padding: 10px;
  margin-top: 2%;
  background-color: white;
}
.parent-div {
  font-family: "Roboto";
  margin: 3% 10%;
}
.header {
  margin-top: 3%;
  background-color: white;
  /* background-color: red; */
}
.search-container {
  width: 100%;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}
.search-input {
  width: 100%;
  height: 40px;
  padding: 2px 10% 2px 15px;
  background-color: #eff0f5;
  border: none;
  border-radius: 2px;
}
.search-button {
  position: absolute;
  right: 0;
  background: #f57224;
  border: none;
  color: white;
  height: 40px;
  width: 10%;
}
.banner-container {
  text-align: center;
  font-size: 40px;
  float: right;
  width: 20%;
}
.banner {
  width: max-content;
  color: #f57224;
  padding: 0px 10px;
  float: right;
}
.others {
  text-align: center;
}
.others-button {
  font-size: 30px;
  height: 40px;
  border: none;
  background-color: white;
  height: 100%;
  color: #f57224;
}
</style>