<template >
	<div
		class="modal fade"
		id="addPackageModal"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<i class="fa fa-archive" aria-hidden="true"></i> Add Package
					</h5>
					<button
						type="button"
						class="close"
						data-dismiss="modal"
						aria-label="Close"
					>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-6">
							<small>Name</small>
							<input
								:class="packageNameErrorMessage ? 'is-invalid' : ''"
								class="form-control"
								v-model="pack.package_name"
							/>
							<div class="invalid-feedback">
								{{ packageNameErrorMessage }}
							</div>
						</div>
						<div class="col-6">
							<small>Description</small>
							<input
								:class="packageDescriptionErrorMessage ? 'is-invalid' : ''"
								class="form-control"
								v-model="pack.package_description"
							/>
							<div class="invalid-feedback">
								{{ packageDescriptionErrorMessage }}
							</div>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-12">
							<button
								type="button"
								class="btn btn-secondary"
								v-on:click="addDuration()"
							>
								Add Duration
							</button>
						</div>
					</div>
					<!-- duration of the package  -->

					<div
						class="row"
						v-for="(duration, index) of pack.duration"
						v-bind:key="duration.duration_from"
					>
						<div class="col-4">
							<small>From Day :</small>
							<input
								onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
								class="form-control"
								disabled
								type="number"
								v-model="duration.duration_from"
							/>
						</div>
						<div class="col-4">
							<small>To Day :</small>
							<input
								onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
								class="form-control"
								type="number"
								v-bind:disabled="toDisabled"
								v-on:input="editDuration(index)"
								v-model="duration.duration_to"
							/>
						</div>
						<div class="col-3">
							<small>Interest Rate</small>
							<input
								onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
								class="form-control"
								type="number"
								v-model="duration.interestRate"
							/>
						</div>
                  <div class="col-1">
								<div :class="(index == 0||index != pack.duration.length - 1)?'d-none':''">
                        <!-- <div :class="( index == 0 )? 'd-none' : '' "> -->
									<small>remove &nbsp; </small>
									<button @click="removeDuration(index)" class="btn btn-danger btn-sm">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</div>
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button
						type="button"
						class="btn btn-primary"
						v-bind:disabled="toDisabled"
						@click="addPackage()"
					>
						Save
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import AuthService from "../../services/auth";
import Swal from "sweetalert2";

export default {
	data() {
		return {
			packageNameErrorMessage: null,
			packageDescriptionErrorMessage: null,
			toDisabled: false,
			pack: {
				pawnshop_id: AuthService.methods.getUid(),
				package_name: "",
				package_description: "",
				duration: [
					{
						duration_from: 1,
						duration_to: 2,
						interestRate: 1
					}
				]
			}
		};
	},

	mounted() {
		let self = this;
		$("#addPackageModal").on("hidden.bs.modal", function() {
			self.clear();
		});
	},

	methods: {
      removeDuration(index){
         this.pack.duration.pop();
         // this.pack.duration.splice( index, 1);
		   // this.editDuration(index);
      },
		clear() {
         this.packageNameErrorMessage =  null;
			this.packageDescriptionErrorMessage = null;
			this.pack = {
				pawnshop_id: AuthService.methods.getUid(),
				package_name: "",
				package_description: "",
				duration: [
					{
						duration_from: 1,
						duration_to: 2,
						interestRate: 1
					}
				]
			};
		},

		async addPackage() {
         this.packageNameErrorMessage =  null;
			this.packageDescriptionErrorMessage = null;
			await axios
				.post("api/addPackageToPawnshop", this.pack)
				.then(res => {
					Swal.fire({
						title: "Package Added Succesfully",
						toast: true,
						timer: 3000,
						position: "top-right"
					});
					this.clear();
					this.$parent.viewPackages();
					$("#addPackageModal").modal("hide");
				})
				.catch(err => {
					if (err.response.data.errors.package_name) {
						this.packageNameErrorMessage =
							err.response.data.errors.package_name[0];
					}
					if (err.response.data.errors.package_description) {
						this.packageDescriptionErrorMessage =
							err.response.data.errors.package_description[0];
					}
				});
		},
		addDuration() {
			this.pack.duration.push({
				package_id: this.pack.package_id,

				duration_from:
					Number(
						this.pack.duration[this.pack.duration.length - 1].duration_to
					) + 1,

				duration_to:
					Number(
						this.pack.duration[this.pack.duration.length - 1].duration_to
					) + 2,

				interestRate: 1
			});
		},
		editDuration(index) {
			let _this = this;
			setTimeout(() => {
				_this.toDisabled = true;
				setTimeout(() => {
					_this.toDisabled = false;
					if (
						this.pack.duration[index].duration_to <=
						this.pack.duration[index].duration_from
					) {
						this.pack.duration[index].duration_to = Number(this.temp[index]);
						console.info(false);
					}
					for (let i = index; i < this.pack.duration.length; i++) {
						this.pack.duration[i + 1].duration_from =
							Number(this.pack.duration[i].duration_to) + 1;
						this.pack.duration[i + 1].duration_to =
							Number(this.pack.duration[i].duration_to) + 2;
					}

					console.info("inside", this.toDisabled);
				}, 400);
			}, 400);

			console.info("outside", this.toDisabled);
		}
	}
};
</script>