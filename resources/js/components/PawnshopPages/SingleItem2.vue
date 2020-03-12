<template>
	<div class="parent-div">
		<div class="custom-card">
			<div class="row">
				<div class=" col-md-5 col-lg-7 col-xl-4">
					<img
						style="border: 2px solid #f57224 !important;  width: 265px; height: 265px; object-fit: cover;"
						:src="'../../images/' + itemProfilePicture"
					/>
				</div>
				<!-- {{data[0].user_id}} -->
				<div class="custom-card-body col-md-7 col-lg-5 col-xl-8">
					<div class="custom-card-name">
						{{ data.item_name }}
					</div>

					<div class="custom-card-category">{{ data.category_name }}</div>
					<div class="custom-card-date">{{ data.date }}</div>
					<div class="custom-card-description">
						{{ data.item_description }}
					</div>
				</div>
			</div>

			<single-item-pictures :data="data"></single-item-pictures>

			<div class="row mt-3">
				<div class="col-12">
					<button :disabled="pawnshop.isValid == 0 || pawnshop.isValid == 3 || pawnshop.isValid == 2" class="bid-button" v-on:click="placeBid()">
						<i class="fa fa-money mr-2" aria-hidden="true"></i> Appraise
					</button>
					<div class="col" :class="pawnshop.isValid == 0 ? '' : 'd-none'">
						<div class="alert alert-warning text-center">
							*** NOTE: You can`t APPRAISE items if your validation status is UNSCUBCRIBE or EXPIRED ***
						</div>
					</div>
					<div class="col" :class="pawnshop.isValid == 3 ? '' : 'd-none'">
						<div class="alert alert-warning text-center">
							*** NOTE: You can`t APPRAISE items if your validation status is UNSCUBCRIBE or EXPIRED ***
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="bider-card">
			<div class="bider-card-header">Pawner Information</div>
			<br>
			<div class="bider-card-body">
				<div class="row">
					<div class="col-md-5 col-lg-7 col-xl-3">
						<img
							style=" width: 200px; height: 200px; object-fit: cover; border-radius: 50%;"
							:src="'../../images/' + userProfilePicture"
						/>
					</div>
					<div class="col-md-7 col-lg-5 col-xl-9">
						<div class="row ml-1" style="border-left: 2px solid #eff0f5;">
							<div class="bider-name col-12">
								<i class="fa fa-address-book mr-3" aria-hidden="true"></i>
								{{ userDetails.username }}
								<button class="btn btn-sm btn-danger float-right " @click="report()">
									<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
									report this user
								</button>
							</div>
							<div class="bider-address col-12 mt-3">
								<i class="fa fa-map-marker mr-3" aria-hidden="true"></i>
								{{ userDetails.address }}
							</div>
							<div class="col-12 mt-3">
								<i class="fa fa-envelope-o mr-3" aria-hidden="true"></i>
								{{ userDetails.email }}
							</div>
							<div class="col-12 mt-3">
								<i class="fa fa-phone-square mr-3" aria-hidden="true"></i>
								{{ userDetails.contact }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ReportModal -->
		<modal-report-user ref="reportModal"></modal-report-user>
	</div>
</template>

<script>
import AuthService from "../../services/auth";
import PostItemService from "../../services/PostItem.controller";
import UserService from "../../services/User.controller";

export default {
	created() {
		AuthService.methods
			.isLogedIn()
			.then(() => {})
			.catch(e => {
				this.$router.push({ path: "/Login" });
			});
		this.viewSingleItem();
		this.getPawnshopData();
		// setTimeout(() => {
		// 	this.getUserDetails();
		// }, 1500);
	},
	data: () => {
		return {
			data: [],
			userDetails: [],
			itemMainPicture: "",
			userProfilePicture: "",
			itemProfilePicture: "",
			userId: "",
			pawnshop:[]
		};
	},
	methods: {

		getPawnshopData() {
			this.pawnshop = this.$parent.profile;
			// UserService.methods
			// 	.getUserDetails(window.localStorage.getItem("userId"))
			// 	.then(res => {
			// 		this.pawnshop = { ...res[0] };
			// 		// console.info("profile data", this.profile);
			// 	});
		},


		report() {
			this.$refs.reportModal.username = this.userDetails.username;
			this.$refs.reportModal.item_name = this.data.item_name;
			this.$refs.reportModal.report.userId = this.userDetails.user_id;
			this.$refs.reportModal.report.pawnshopId = AuthService.methods.getUid();
			$("#reportModal").modal("show");
		},

		viewSingleItem() {
			PostItemService.methods
				.getSingleItem(this.$route.query.itemId)
				.then(res => {
					console.info("value of res is", res);
					let data = [...res];
					this.data = data[0];
					this.userId = data[0].user_id;
					this.itemProfilePicture = data[0].item_photo;
					this.getUserDetails();
				});
		},

		getUserDetails() {
			UserService.methods.getUserDetails(this.userId).then(res => {
				let data = [...res];
				this.userDetails = data[0];
				this.userProfilePicture = data[0].image;
			});
		},

		placeBid() {
			let obj = {
				itemId: this.$route.query.itemId,
				biderId: this.userDetails.user_id
			};
			this.$router.push({
				path: `/Bidding/${obj.itemId}/bidderId/${obj.biderId}`,
				query: obj
			});
		}
	}
};
</script>



<style scoped>
.bider-photo img {
	border-radius: 50%;
	height: 200px;
}
.custom-card {
	border: 2px solid #f57224 !important;
}
.bider-card {
	background-color: white;
	margin-top: 45px;
	padding: 15px;
	border: 2px solid #f57224;
}
.bider-card-header {
	color: #f57224;
	font-size: 20px;
}
.bid-button {
	margin-left: 10px;
	font-size: 20px;
	border: none;
	height: 3 0px;
	width: 97%;
	background: #f57224;
	color: white;
}
.picutre-frame {
	width: 100%;
	display: block;
}
.custom-card-date {
	font-size: 17px;
	font-weight: bold;
	color: #f57224;
}
.picture-frame {
	border-top: 2px solid #eff0f5;
	padding-top: 10px;
	margin-top: 10px;
}
.picture {
	width: 10%;
	border: 2px #f57224 solid;
	margin-left: 2px;

	cursor: pointer;
	display: inline-block;
}
.picture img {
	height: 80px;
	width: 100%;
}
.parent-div {
	font-family: "Roboto";
	margin: 3% 10%;
}
.custom-card-name {
	font-size: 33px;
	border-bottom: 2px #f57224 solid;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: left;
	margin-bottom: 2%;
	font-weight: bold;
}
.custom-card-category {
	color: #f57224;
	font-size: 17px;
	font-weight: bold;
}
.custom-card-description {
	font-size: 15px;
	height: 170px;
	width: 100%;
	overflow-y: scroll;
}
.custom-card {
	padding: 5px;
	background-color: white;

	border: 3px white solid;
}
.custom-card-image {
	/* background-color: red; */
	width: max-content;
	display: inline-block;
}
.custom-card-image img {
	height: 300px;
	width: 300px;
}
.custom-card-body {
	width: 100%;
}
</style>