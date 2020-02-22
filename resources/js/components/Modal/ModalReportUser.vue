
<template>
	<div>
		<div class="modal" tabindex="-1" role="dialog" id="reportModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title">Report User</h5>
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
						<div class="row ml-5 mr-5 text-center">
							<h5>User: {{ data.username }}</h5>
						</div>
						<div class="row  mb-4 ml-5 mr-5 text-center">
							<h6>Item: {{ data.item_name }}</h6>
						</div>
						<div class="row mb-5">
							<div class="col-12 ">
								<label for="situation"
									>Type Your Sitation/Reason (Optional)</label
								>
								<textarea
									class="form-control"
									id="situation"
									rows="3"
									v-model="report.situation"
								></textarea>
							</div>
						</div>
						<div class="row mb-2">
							<div class="col-12">
								<button
									type="button"
									class="btn btn-danger btn-block"
									@click="sendReport(data)"
								>
									Send Report
								</button>
							</div>
						</div>

						<div class="row">
							<div class="col"></div>
							<div class="col">
								<button
									type="button"
									class="btn btn-secondary btn-block"
									data-dismiss="modal"
								>
									Cancel
								</button>
							</div>
							<div class="col"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Swal from "sweetalert2";

export default {
	data() {
		return {
			data: [],
			report: {
				userId: null,
				pawnshopId: null,
				situation: null,
				isFromPawnshop: 1
			}
		};
	},

	methods: {
		async sendReport(data) {
			console.log("sendreport");
			this.report.userId = this.data.user_id;
			this.report.pawnshopId = this.data.pawnshop_id;
			await axios
				.post("api/sendReport", this.report)
				.then(res => {
                    $('#reportModal').modal('hide');
					this.clear();
					Swal.fire({
						title: "User Reported",
						toast: true,
						timer: 3000,
						position: "top-right"
					});
				})
				.catch(err => {
					console.error(err);
				});
		},
		clear() {
			this.report.userId = null;
			this.report.pawnshopId = null;
			this.report.situation = null;
		}
	},
	mounted() {
		let self = this;
		$("#reportModal").on("hidden.bs.modal", function() {
			self.clear();
		});
	}
};
</script>