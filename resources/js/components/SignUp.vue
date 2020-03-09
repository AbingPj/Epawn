<template>
	<div
		class="parent-div"
		style="display: flex; justify-content: center; align-items: center;font-family : 'Roboto'; "
	>
		<div class="custom-card">
			<div class="custom-card-header">
				<i class="fa fa-user-plus mr-3" aria-hidden="true"></i> Register
			</div>
			<input
				placeholder="Email Address"
				v-model="user.email"
				class="form-control"
			/>
			<input
				placeholder="Company Name"
				v-model="user.username"
				class="form-control mt-2"
			/>
			<input
				placeholder="Contact"
				type="number"
				v-model="user.contact"
				class="form-control mt-2"
			/>
			<input
				placeholder="Control #"
				max="11"
				type="number"
				v-model="user.control_num"
				class="form-control mt-2"
			/>
			<textarea
				placeholder="Address"
				class="mt-2 form-control"
				v-model="user.address"
			>
			</textarea>
			<img
				:src="permitImg"
				v-if="permitImg != ''"
				style="margin: 4px auto 0 auto; height: 105px; display : block;"
			/>
			<small> Business permit picture</small>
			<input
				placeholder="picturwe"
				type="file"
				@change="onFileChange"
				class="form-control mt-2"
			/>
			<input
				placeholder="Password"
				type="password"
				v-model="user.password"
				class="form-control mt-2"
			/>
			<input
				placeholder="Confirm Password"
				type="password"
				v-model="user.confirm"
				class="form-control mt-2"
			/>

			<button class="register-button" @click="Register()">
				<i class="fa fa-user-plus"></i> Register
			</button>
			<button v-on:click="gotoLogin()" class="login-button">
				<i class="fa fa-sign-in"></i> Login
			</button>
		</div>
	</div>
</template>
<style scoped>
.parent-div {
	background: linear-gradient(to bottom, #ffffff, #f7af83);
	height: 100vh;
	background-size: 100% 100%;
}
.overlay {
	/* Height & width depends on how you want to reveal the overlay (see JS below) */
	height: 100%;
	width: 0;
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	background-color: rgb(0, 0, 0); /* Black fallback color */
	background-color: rgba(0, 0, 0, 0.9); /* Black w/opacity */
	overflow-x: hidden; /* Disable horizontal scroll */
	transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
}

.login-button {
	border: #f57224 2px solid;
	margin-top: 15px;
	width: 35%;
	height: 30px;
	background-color: white;
	color: #f57224;
}
.register-button {
	border: none;
	height: 30px;
	width: 63%;
	margin-top: 15px;
	background-color: #f57224;
	color: white;
	margin-bottom: 20px;
}
.panel {
	border-top: 2px white solid;
	margin-top: 10%;
}
.panel-header {
	margin-top: -12px;
	font-size: 15px;
	background-color: #f57224;
	width: max-content;
	color: white;
	padding-left: 10px;
	padding-right: 10px;
	margin-left: auto;
	margin-right: auto;
	display: block;
}
::placeholder {
	color: #7a7a78;
	opacity: 0.7; /* Firefox */
}
.row {
	width: 100vw;
	background-color: #f57224;
}
.welcome-banner {
	font-size: 35px;
}
.right-panel {
	background-color: black;
	height: 50vh;
}
.body-level {
	margin-top: 10%;
}
.right-body {
	color: white;
}
.custom-card {
	color: #f57224;
	width: 40%;
	margin-top: 5%;
	background-color: white;
	padding: 0px 30px;
	-webkit-box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
	-moz-box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
	box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
}
.custom-card-header {
	background-color: white;
	font-size: 30px;
	text-align: center;
	width: 50%;
	margin-left: auto;
	margin-right: auto;
	display: block;
	color: #f57224;
	margin-bottom: 5%;
}
.custom-card-input {
	background: transparent;
	border: none;
	margin-top: 2%;
	width: 100%;
	display: block;
	color: #7a7a78;
	padding: 5px 5px;
	border-bottom: 2px #7a7a78 solid;
}
.custom-card-input:focus {
	outline: none;
}
</style>
<script>
import UserService from "../services/User.controller";
import Swal from "sweetalert2";
export default {
	mounted() {
		// var apiGeolocationSuccess = function(position) {
		// 	alert(
		// 		"API geolocation success!\n\nlat = " +
		// 			position.coords.latitude +
		// 			"\nlng = " +
		// 			position.coords.longitude
		// 	);
		// };
		// var tryAPIGeolocation = function() {
		// 	jQuery
		// 		.post(
		// 			"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDCa1LUe1vOczX1hO_iGYgyo8p_jYuGOPU",
		// 			function(success) {
		// 				apiGeolocationSuccess({
		// 					coords: {
		// 						latitude: success.location.lat,
		// 						longitude: success.location.lng
		// 					}
		// 				});
		// 			}
		// 		)
		// 		.fail(function(err) {
		// 			alert("API Geolocation error! \n\n" + err);
		// 		});
		// };
		// tryAPIGeolocation();
		// var browserGeolocationSuccess = function(position) {
		// 	alert(
		// 		"Browser geolocation success!\n\nlat = " +
		// 			position.coords.latitude +
		// 			"\nlng = " +
		// 			position.coords.longitude
		// 	);
		// };
		// var browserGeolocationFail = function(error) {
		// 	switch (error.code) {
		// 		case error.TIMEOUT:
		// 			alert("Browser geolocation error !\n\nTimeout.");
		// 			break;
		// 		case error.PERMISSION_DENIED:
		// 			if (error.message.indexOf("Only secure origins are allowed") == 0) {
		// 				tryAPIGeolocation();
		// 			}
		// 			break;
		// 		case error.POSITION_UNAVAILABLE:
		// 			alert("Browser geolocation error !\n\nPosition unavailable.");
		// 			break;
		// 	}
		// };
		// var tryGeolocation = function() {
		// 	if (navigator.geolocation) {
		// 		navigator.geolocation.getCurrentPosition(
		// 			browserGeolocationSuccess,
		// 			browserGeolocationFail,
		// 			{ maximumAge: 50000, timeout: 20000, enableHighAccuracy: true }
		// 		);
		// 	}
		// };
		// tryGeolocation();
	},
	created() {
		setTimeout(() => {
			// console.info(this.getUserLocation());
			this.getLocationsFromIpStack();
		}, 1000);
	},
	data: () => {
		return {
			user: {
				username: "",
				password: "",
				email: "",
				control_num: "",
				contact: "",
				confirm: "",
				address: ""
			},
			position: {
				lat: "",
				long: ""
			},

			permitImg: "",
			imageFile: ""
		};
	},
	methods: {
		gotoLogin() {
			this.$router.push({ path: "/Login" });
		},
		maximize() {},
		Register() {
			if (this.user.password == this.user.confirm) {
				console.info(this.isFieldValid());
				if (this.isFieldValid()) {
					Swal.fire({
						title: "Epawn Application",
						text: "Please Complete the field",
						icon: "error"
					});
				} else {
					this.getUserLocation();
					let formData = new FormData();
					formData.append("username", this.user.username);
					formData.append("contact", this.user.contact);
					formData.append("password", this.user.password);
					formData.append("email", this.user.email);
					formData.append("control", this.user.control_num);
					formData.append("permit", this.imageFile);
					formData.append("lat", this.position.lat);
					formData.append("long", this.position.long);
					formData.append("address", this.user.address);

					UserService.methods.addStore(formData).then(r => {
						Swal.fire({
							title: "Epawn Application",
							text: "Account Created succesfully ",
							icon: "success"
						});
						this.$router.push({ path: "/Login" });
					});
				}
			} else {
				Swal.fire({
					title: "Epawn Application",
					text: "Password Mismatch",
					icon: "error"
				});
			}
		},
		isFieldValid() {
			if (this.user.username.trim().length == 0) {
				return true;
			}
			if (this.user.password.trim().length == 0) {
				return true;
			}
			if (this.user.email.trim().length == 0) {
				return true;
			}
			if (this.user.control_num.trim().length == 0) {
				return true;
			}
			if (this.user.contact.trim().length == 0) {
				return true;
			}
			if (this.user.confirm.trim().length == 0) {
				return true;
			}
			if (this.user.address.trim().length == 0) {
				return true;
			}
			if (this.imageFile == "") {
				return true;
			}

			return false;
		},
		onFileChange(e) {
			var files = e.target.files || e.dataTransfer.files;
			if (!files.length) return;
			this.imageFile = files[0];
			this.createImage(files[0]);
		},
		createImage(file) {
			var image = new Image();
			var reader = new FileReader();
			var vm = this;

			reader.onload = e => {
				vm.permitImg = e.target.result;
			};
			reader.readAsDataURL(file);
		},
		getLocationsFromIpStack() {
			let that = this;
			axios
				.get(
					"http://api.ipstack.com/check?access_key=383589390dc31cd39bf407135d851c21",
					{ headers: { "Access-Control-Allow-Origin": "*" } }
				)
				.then(res => {
					console.log(res);
					that.position.lat = res.latitude;
					that.position.long = res.longitude;
				})
				.catch(err => {
					console.error(err);
				});

			

			$.ajax({
				url:
					"http://api.ipstack.com/check?access_key=383589390dc31cd39bf407135d851c21",
				success: function(result) {
					console.log(result);
					console.log(result.latitude);
					console.log(result.longitude);
					that.position.lat = result.latitude;
					that.position.long = result.longitude;
				}
			});
		},
		getUserLocation() {
			if (window.navigator.geolocation) {
				window.navigator.geolocation.getCurrentPosition(e => {
					this.position.lat = e.coords.latitude;
					this.position.long = e.coords.longitude;
				});
			} else {
				Swal.fire({
					title: "Epawn Application",
					text: "Geolocation is not supported with this browser",
					icon: "error"
				});
			}
		}
	}
};
</script>