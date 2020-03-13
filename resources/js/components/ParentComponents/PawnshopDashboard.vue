<template>
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#">
                  <i class="fas fa-bars"></i>
               </a>
            </li>
         </ul>

         <div v-if="profile.isValid == 0" style="width:100%;">
            <marquee
               scrollamount="5"
               direction="left"
               behavior="scroll"
            >Your subcribtion status is UNSUBCRIBE! please contact E-pawn admin.</marquee>
         </div>
         <div v-else-if="profile.isValid == 3" style="width:100%;">
            <marquee
               scrollamount="5"
               direction="left"
               behavior="scroll"
            >Your subcribtion status has been EXPIRED! please contact E-pawn admin.</marquee>
         </div>
         <div v-else></div>

         <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fa fa-bell-o bell-icon"></i>
                  <span
                     class="badge badge-warning navbar-badge"
                     style="margin-right:12px; padding:5px;"
                  >{{ badge == 0? '':badge}}</span>
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-header">Notifications</span>
                  <div class="ex3">
                     <div v-for="notif in notifications" :key="notif.id">
                        <!-- <router-link :to="notif.link" replace="true"> -->
                        <div
                           @click="redirect(notif.link, notif.id)"
                           class="dropdown-item"
                           :class="notif.seen == 0? 'unseen':''"
                        >
                           <div class="media">
                              <img
                                 style="width: 40px;  height: 40px;  object-fit: cover;"
                                 :src="'/images/' + notif.user.image"
                                 alt="User Avatar"
                                 class="mr-3 img-circle"
                              />
                              <div class="media-body">
                                 <h3 class="dropdown-item-title">
                                    {{ notif.user.username }}
                                    <span
                                       class="float-right text-sm epawn-color"
                                    >
                                       <i class="fa fa-handshake-o mr-3"></i>
                                    </span>
                                 </h3>
                                 <p class="text-sm">
                                    Has response bid!
                                    <br />
                                    <span class="text-sm epawn-color">
                                       <i class="far fa-clock mr-1"></i>
                                       {{ getMoment(notif.date) }}
                                    </span>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <!-- </router-link> -->
                        <div class="dropdown-divider"></div>
                     </div>
                  </div>
                  <!-- <div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer"
							>See All Notifications</a
                  >-->
               </div>
            </li>
            <li class="nav-item">
               <i
                  class="fa fa-sign-out logout-icon nav-link"
                  title="Logout"
                  @click="logout()"
                  aria-hidden="true"
               ></i>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
         <!-- Brand Logo -->
         <a class="brand-link">
            <img src="/icon.png" style="height: 150px;" />
         </a>

         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <img
                     style="width: 50px;  height: 50px;  object-fit: cover;"
                     class="img-circle elevation-2"
                     alt="User Image"
                     v-bind:src="
								profile.image == '' || profile.image == undefined
									? '/images/adminlte/avatar04.jpg'
									: `../../images/${profile.image}`
							"
                  />
                  <!-- src="/images/adminlte/user2-160x160.jpg" -->
               </div>
               <div class="info">
                  <a class="d-block mt-2">{{ profile.username }}</a>
               </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul
                  class="nav nav-pills nav-sidebar flex-column"
                  data-widget="treeview"
                  role="menu"
                  data-accordion="false"
               >
                  <li class="nav-item">
                     <router-link
                        to="/"
                        class="nav-link"
                        :class="selectedLi == 'items' ? 'active' : ''"
                     >
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Users Post Items
                           <span
                              class="right badge badge-danger"
                              :class="bidHasNotif == false? 'd-none':''"
                           >&nbsp;&nbsp;!&nbsp;&nbsp;</span>
                        </p>
                     </router-link>
                  </li>
                  <li class="nav-item has-treeview menu-open">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-handshake-o"></i>
                        <p>
                           My Biddings
                           <i class="right fa fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <router-link
                              to="/PendingItems"
                              class="nav-link"
                              :class="selectedLi == 'pending' ? 'active' : ''"
                           >
                              <i class="fa fa-balance-scale nav-icon"></i>
                              <p>Pending Items</p>
                           </router-link>
                        </li>

                        <li class="nav-item">
                           <router-link
                              to="/PawnedItems"
                              class="nav-link"
                              :class="selectedLi == 'pawned' ? 'active' : ''"
                           >
                              <i class="fa fa-files-o nav-icon"></i>
                              <p>Pawned Item Records</p>
                           </router-link>
                        </li>
                     </ul>
                  </li>

                  <li class="nav-item">
                     <router-link
                        to="/MyProfile"
                        class="nav-link"
                        :class="selectedLi == 'profile' ? 'active' : ''"
                     >
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>My Profile</p>
                     </router-link>
                  </li>
                  <li class="nav-item">
                     <router-link
                        to="/AdminNotification"
                        class="nav-link"
                        :class="selectedLi == 'notif' ? 'active' : ''"
                     >
                        <i class="nav-icon fa fa-bell"></i>
                        <p>
                           Categories/Admin Notif.
                           <span
                              class="right badge badge-danger"
                              :class="catAdminHasNotif == false? 'd-none' : ''"
                           >&nbsp;&nbsp;!&nbsp;&nbsp;</span>
                        </p>
                     </router-link>
                  </li>
               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Main content -->
         <div class="content">
            <router-view />
            <router-view name="helper" />
         </div>
      </div>

      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
         <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
         </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
         <!-- To the right -->
         <div class="float-right d-none d-sm-inline">Anything you want</div>
         <!-- Default to the left -->
         <strong>
            Copyright &copy; 2020
            <a href="https://adminlte.io">Epawn.online</a>.
         </strong>
         All rights reserved.
      </footer>
   </div>
</template>
<script>
import AuthService from "../../services/auth";
import UserService from "../../services/User.controller";
import Swal from "sweetalert2";
export default {
   mounted() {
      Echo.channel("EpawnChannel").listen("EpawnEvent", data => {
         console.log(data.updateType);
         if (data.updateType == "getItems") {
            this.$events.fire("getItemsEvent", data.updateType);
            this.bidHasNotif = true;
         } else if (data.updateType == "bid") {
            this.$events.fire("getChatEvent", data.updateType);
            this.getPawnshopBidNotifications();
         } else if (data.updateType == "catNotif") {
            this.$events.fire("getCatNotif", data.updateType);
            this.catAdminHasNotif = true;
         } else if (data.updateType == "adminNotif") {
            this.$events.fire("getAdminNotif", data.updateType);
              this.catAdminHasNotif = true;
         } else {
            console.log("nothing to update");
         }
      });
   },
   created() {
      this.getPawnshopBidNotifications();
      this.getPawnshopInfo();
   },
   data() {
      return {
         selectedLi: "items",
         // profile: {
         // 	username: "",
         // 	address: "",
         // 	control_num: "",
         // 	contact: "",
         // 	monthCofescation: "",
         // 	isValid: "",
         // 	expiration: ""
         // }
         profile: [],
         notifications: [],
         badge: "",
         bidHasNotif: false,
         catAdminHasNotif: false
      };
   },
   methods: {
      redirect(link, id) {
         console.log("shit1");
         // this.$events.fire("getNotificationsLink", link);
         // this.$router.push(link);
         axios.post("/api/updateSeen");

         let data = {
            notify_id: id
         };

         axios
            .post("/api/updateSeen", data)
            .then(res => {
               console.log(res);
               window.location.href = link;
            })
            .catch(err => {
               console.error(err);
            });

         // let obj = {
         // 	itemId: item_id,
         // 	biderId: user_id
         // };
         // const path = `/Bidding/${item_id}/bidderId/${user_id}`;
         // console.log(path);
         // console.log(this.$route.path);
         // if (this.$route.path !== path) this.$router.push({path:path,query: obj});
      },
      getMoment(time) {
         var a = moment(time);
         return moment(a).fromNow();
      },
      async getPawnshopBidNotifications() {
         let id = window.localStorage.getItem("userId");
         await axios
            .get("/api/getPawnshopBidNotifications/" + id)
            .then(res => {
               console.log(res.data);
               let data = res.data;
               this.notifications = data.notifications;
               this.badge = data.badge;
            })
            .catch(err => {
               console.error(err);
            });
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
      getUserData() {
         UserService.methods
            .getUserDetails(window.localStorage.getItem("userId"))
            .then(res => {
               this.profile = { ...res[0] };
               this.profile.expiration;

               // console.info("profile data", this.profile);
            });
      },
      async getPawnshopInfo() {
         let id = window.localStorage.getItem("userId");
         await axios
            .get("/api/getPawnshopInfo/" + id)
            .then(res => {
               this.profile = res.data;
               if (this.profile.showWarning == 1) {
                  let information =
                     "Your subcription will end on: " + this.profile.expiration;
                  Swal.fire({
                     title: "Warning",
                     text: information,
                     icon: "warning"
                  });
               } else if (this.profile.showWarning == 2) {
                  let information =
                     "Your subcription has been expired. Expiration date was: " +
                     this.profile.expiration;
                  Swal.fire({
                     title: "Warning",
                     text: information,
                     icon: "danger"
                  });
               }
            })
            .catch(err => {
               console.error(err);
            });
      }
   }
};
</script>
<style lang="scss" scoped>
.main-header {
   background-color: #f57224;
   color: white;
}
.main-sidebar {
   border-right-color: #f57224;
   border-right-style: solid;
}
.active {
   background-color: #f57224 !important ;
   p {
      color: #ffffff;
      font-weight: bold;
   }
   .nav-icon {
      color: #ffffff;
   }
}
.nav-icon {
   color: #f57224;
}
.brand-link {
   border-bottom: 2px solid #f57224;
}

.user-panel {
   border-bottom: 1px solid #f57224;
}
.logout-icon {
   font-size: 40px;
   // position: absolute;
   // z-index: 2;
   // cursor: pointer;
   // top: 0;
   // right: -50px;
}

.bell-icon {
   font-size: 40px;
   margin-right: 20px;
}
.dropdown-menu-lg {
   max-width: 320px;
   min-width: 280px !important;
   padding: 0;
}
.unseen {
   background-color: #fcf3dc;
}
.epawn-color {
   color: #f57224;
}

.ex3 {
   background-color: white;
   //   width: 110px;
   max-height: 350px;
   overflow: auto;
}
</style>