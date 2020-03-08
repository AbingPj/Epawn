<template>
	<div>
		<!-- managing item that is already pawned -->
		<div class="modal" tabindex="-1" role="dialog" id="paymentHistoryModal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Oayment History</h5>
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
						<!-- declineActive == false -->
						<div class="card" style="width: 100%;">
							<div class="card-body">
								<h5 class="text-center">
									Item Information
								</h5>
								<br />

								<div class="row">
									<div class="col col-3">
										<img
											:src="`../../images/${item_photo}`"
											style="width: 150px; height: 150px;"
										/>
									</div>
									<div class="col">
										<div style="width: 100%; font-size: 25px;">
											{{ item_name }}
										</div>
										<div style="color: #f57224;">
											{{ category_name }}
										</div>
										<div
											style="height: 100px; overflow-y: scroll; margin-top: 12px;"
										>
											{{ item_description }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mt-1" style="width: 100%;">
							<div class="card-body">
								<h5 class="text-center">
									Payment History
								</h5>
								<br>
								<div
									v-if="history.length == 0"
									class="alert alert-danger text-center"
									role="alert"
								>
									No payments yet.
								</div>
								<div v-else>
									<div class="row text-center">
										<div class="col">
											<small>payment amount</small>
										</div>
										<div class="col">
											<small>payment type</small>
										</div>
										<div class="col">
											<small>date of payment</small>
										</div>
									</div>
									<br />
									<div
										class="row text-center"
										v-for="payment in history"
										:key="payment.pawned_item_id"
									>
										<div class="col">₱{{ payment.amount }}</div>
										<div class="col">{{ payment.payment_type_desc }}</div>
										<div class="col">{{ payment.created_at }}</div>
									</div>
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
export default {
	data() {
		return {
			pawned_item: [],
			pawned_id: "",
			item_photo: "",
			item_name: "",
			item_description: "",
			category_name: "",
			history: []
		};
	},
	methods: {
		showModal(item) {
			this.item_photo = item.item.item_photo;
			this.item_name = item.item.item_name;
			this.item_description = item.item.item_description;
			this.category_name = item.item.category.category_name;
			this.pawned_id = item.id;
			this.getItemHistory(item.id);
			$("#paymentHistoryModal").modal("show");
		},
		async getItemHistory(id) {
			await axios
				.get("api/getPaymentHistory/" + this.pawned_id)
				.then(res => {
					console.log(res);
					this.history = res.data;
				})
				.catch(err => {
					console.error(err);
				});
		}
	}
};
</script>

