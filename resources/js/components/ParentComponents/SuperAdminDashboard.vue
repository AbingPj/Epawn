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
				<!-- <li class="nav-item d-none d-sm-inline-block">
					<a href="index3.html" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Contact</a>
				</li> -->
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
			<a href="index3.html" class="brand-link">
				<img src="/icon.png" style="height: 150px;" />
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img
							src="/images/adminlte/user2-160x160.jpg"
							class="img-circle elevation-2"
							alt="User Image"
							width="160px"
							height="160px"
						/>
					</div>
					<div class="info">
						<a href="#" class="d-block">Super Admin</a>
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
							<router-link to="/SuperAdmin/Categories" class="nav-link">
								<i class="nav-icon far fa-object-ungroup"></i>
								<p>
									Item Categories
								</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/SuperAdmin/PawnShops" class="nav-link">
								<i class="nav-icon fas fa-store"></i>
								<p>
									PawnShops
								</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/SuperAdmin/ReportedUsers" class="nav-link">
								<i class="nav-icon fa fa-flag"></i>
								<p>
									Reported Users
								</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/SuperAdmin/ReportedPawnshops" class="nav-link">
								<i class="nav-icon fa fa-flag-checkered"></i>
								<p>
									Reported Pawnshops
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
				<router-view name="helper"/>
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
				>Copyright &copy; 2014-2019
				<a href="https://adminlte.io">AdminLTE.io</a>.</strong
			>
			All rights reserved.
		</footer>
	</div>
</template>

<script>
import AuthService from "../../services/auth";
import Swal from "sweetalert2";
export default {
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