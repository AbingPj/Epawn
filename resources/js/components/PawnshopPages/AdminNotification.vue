<template>
	<div class="parent-div">
		<div class="row navbar">
			<div
				class="col navbar-item"
				v-bind:class="{
					active: activeTab == 'category',
					normal: activeTab != 'category'
				}"
				v-on:click="
					activeTab = 'category';
					getCategoryRequestNotifications();
				"
			>
				<i class="fa fa-files-o" aria-hidden="true"></i> Category Requests
			</div>
			<div
				v-bind:class="{
					active: activeTab == 'superAdmin',
					normal: activeTab != 'superAdmin'
				}"
				v-on:click="
					activeTab = 'superAdmin';
					getSuperAdminNotifications();
				"
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
						<small class="text-colored"> {{ superadminNotif.joined }}</small>
						and your status is
						<small class="text-colored">Pending</small>
					</div>

					<div class="alert alert-success" v-if="superadminNotif.isValid == 1">
						Congratulations ! Your registration credentials has been
						<small class="text-colored"> Accepted </small> on
						<small class="text-colored"> {{ superadminNotif.noticed }} </small>
					</div>
				</div>
			</div>
		</div>
		<div class="with-border tab-body mt-2" v-if="activeTab == 'category'">
			<div v-if="categoryRequests.length == 0" class="col-12 text-center">
				<div class="alert alert-danger" role="alert">No notifications yet</div>
			</div>
			<div v-else>
				<div
					class="card mt-2"
					v-for="category in categoryRequests"
					:key="category.category_id"
				>
					<div
						class="card-header"
						:class="gettCategoryAlertStatus(category.valid)"
					>
						<div class="row" style="padding: initial !important;">
							<div class="col">
								<small class="text-colored">category name</small>
								<br />
								{{ category.category_name }}
							</div>
							<div class="col">
								<small class="text-colored">category status</small>
								<br />
								{{ gettCategoryStatus(category.valid) }}
							</div>
							<div class="col">
								<small class="text-colored">description</small>
								<br />
								{{ getDesc(category) }}
							</div>
							<div class="col text-center">
								<div v-if="category.valid == 0">
									<button
										type="button"
										class="btn btn-sm btn-danger mt-2"
										@click="deleteNotif(category.category_id, 'category')"
									>
										Cancel Request
									</button>
								</div>
								<div v-else-if="category.valid == 3">
									<button
										type="button"
										class="btn btn-sm  btn-info mt-2"
										@click="viewRejectedCategory(category.category_reason)"
									>
										Show Reason
									</button>
                  <button
										type="button"
										class="btn btn-sm  btn-danger mt-2"
										@click="deleteNotif(category.category_id, 'category')"
									>
									  <i class="fa fa-trash" aria-hidden="true"></i>
									</button>

                
								</div>
								<div v-else>
									<button
										disabled
										type="button"
										class="btn btn-sm  btn-light mt-2"
									>
										Accepted
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import NotifService from "../../services/notification.controller";
import AuthService from "../../services/auth";
import Swal from "sweetalert2";

export default {
	// computed: {
	// },
	mounted() {
		this.$parent.selectedLi = "notif";
	},
	data: () => {
		return {
			activeTab: "category",
			categoryRequests: [],
			superAdminNotifs: []
		};
	},
	created() {
		this.getCategoryRequestNotifications();
		this.getSuperAdminNotifications();
		// setInterval(()=>{
		//   this.getCategoryRequestNotifications();
		//   this.getSuperAdminNotifications();
		// },10000)
	},
	events: {
		getCatNotif(data) {
			console.log("from Notif: " + data);
			this.getCategoryRequestNotifications();
    },
    getAdminNotif(data) {
			console.log("from Notif: " + data);
			this.getSuperAdminNotifications();
		},
	},
	methods: {
		getDesc(cat) {
			let desc = this.stripTags(cat.category_description);
			return desc.length > 15 ? desc.substring(0, 15) + "..." : desc;
		},

		stripTags(text) {
			return text.replace(/(<([^>]+)>)/gi, "");
		},

		viewRejectedCategory(reason) {
			Swal.fire({
				title: "Reason",
				text: reason,
				icon: "info"
			});
		},
		gettCategoryStatus(status) {
			if (status == 0) {
				return "Pending";
			} else if (status == 3) {
				return "Rejected";
			} else {
				return "Accepted";
			}
		},

		gettCategoryAlertStatus(status) {
			if (status == 0) {
				return "alert-success";
			} else if (status == 3) {
				return "alert-danger";
			} else {
				return "alert-info";
			}
		},

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