<template>
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"
						><i class="fas fa-bars"></i
					></a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
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
				<img src="icon.png" style="height: 150px;" />
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img
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
						<a class="d-block">{{ profile.username }}</a>
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
								<p>
									My Profile
								</p>
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
									Notifications
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
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			<!-- Default to the left -->
			<strong
				>Copyright &copy; 2020
				<a href="https://adminlte.io">Epawn.online</a>.</strong
			>
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
			} else if (data.updateType == "bid") {
				this.$events.fire("getChatEvent", data.updateType);
			}else if (data.updateType == "catNotif") {
				this.$events.fire("getCatNotif", data.updateType);
			}else if (data.updateType == "adminNotif") {
				this.$events.fire("getAdminNotif", data.updateType);
			} else {
				console.log("nothing to update");
			}
		});
	},
	created() {
		this.getUserData();
	},
	data() {
		return {
			selectedLi: "items",
			profile: {
				username: "",
				address: "",
				control_num: "",
				contact: "",
				monthCofescation: ""
			}
		};
	},
	methods: {
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
					console.info("profile data", this.profile);
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
</style>