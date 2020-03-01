<template >
	<div
		class="modal fade"
		id="modalAddPackage2"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<i class="fa fa-archive" aria-hidden="true"></i>New Add Package
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
						<div class="col">
							<b>Package Name</b>
							<input
								v-model="package_name"
								type="text"
								class="form form-control"
							/>
						</div>
						<div class="col">
							<b>Package Desc</b>
							<input
								v-model="package_desc"
								type="text"
								class="form form-control"
							/>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col">
							<label for="">No. of Months</label>
							<input
								v-model="number_of_month"
								type="number"
								class="form form-control"
								disabled
							/>
						</div>
						<div class="col">
							<label for="">Interest Per Month</label>
							<input
								v-model="interest_per_month"
								type="number"
								class="form form-control"
							/>
						</div>
						<div class="col">
							<label for="">Penalty Per Month</label>
							<input
								v-model="pinalty_per_month"
								type="number"
								class="form form-control"
							/>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col">
							<label for="">Interest Payment Term</label>
							<select class="form-control" v-model="if_advance_interest">
								<option value="1">With Advance Interest</option>
								<option value="0">No Advance Interest</option>
							</select>
						</div>
					</div>
					<br />
					<br />
					<div class="row">
						<div class="col">
							<button class="btn btn-dark" @click="addDuration">
								Add Duration
							</button>
						</div>
						<div class="col"></div>
						<div class="col"></div>
					</div>
					<br />
					<div v-for="(dur, index) in durations" :key="index">
						<div class="row">
							<div class="col-4">
								<small>From Day :</small>
								<input
									class="form-control"
									disabled
									type="number"
									v-model="dur.from"
								/>
							</div>
							<div class="col-4">
								<small>To Day :</small>
								<input
									:disabled="index < durations.length - 1"
									@change="updateTo(index)"
									class="form-control"
									type="number"
									v-model="dur.to"
								/>
							</div>
							<div class="col-3">
								<small>Interest Rate</small>
								<input
									class="form-control"
									type="number"
									v-model="dur.interest"
								/>
							</div>
							<div class="col-1">
								<div :class="index != durations.length - 1 ? 'd-none' : ''">
									<small>remove &nbsp; </small>
									<button
										@click="removeDuration()"
										class="btn btn-danger btn-sm"
									>
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="addPackage()">
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
			pawnshop_id: AuthService.methods.getUid(),
			package_name: "",
			package_desc: "",
			number_of_month: 0,
			interest_per_month: "",
			pinalty_per_month: "",
			if_advance_interest: 1,
			durations: []
		};
	},
	methods: {
		addPackage() {
			let data = {
				pawnshop_id: this.pawnshop_id,
				package_name: this.package_name,
				package_desc: this.package_desc,
				number_of_month: this.number_of_month,
				interest_per_month: this.interest_per_month,
				pinalty_per_month: this.pinalty_per_month,
				if_advance_interest: this.if_advance_interest,
				durations: this.durations
			};

			axios
				.post("/api/zSavePackage", data)
				.then(res => {
					Swal.fire({
						title: "Package Added Succesfully",
						toast: true,
						timer: 3000,
						position: "top-right"
					});
					$("#modalAddPackage2").modal("hide");
					this.$parent.viewPackages();
					this.clear();
				})
				.catch(err => {
					console.error(err);
				});
		},
		updateTo(index) {
			if (Number(this.durations[index].to) > 35) {
				this.durations[index].to = 0;
			} else {
				if (
					Number(this.durations[index].to) <= Number(this.durations[index].from)
				) {
					this.durations[index].to = Number(this.durations[index].from) + 1;
				}
			}
		},
		removeDuration() {
			this.durations.pop();
		},
		addDuration() {
			if (this.durations.length <= 0) {
				this.durations.push({
					from: 1,
					to: 2,
					interest: 1
				});
			} else {
				let length = Number(this.durations.length - 1);
				this.durations.push({
					from: Number(this.durations[length].to) + 1,
					to: Number(this.durations[length].to) + 2,
					interest: Number(this.durations[length].interest) + 1
				});
			}
		}
	}
};
</script>