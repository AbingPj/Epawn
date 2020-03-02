<template>
	<div>
		<div class="container">
			<div class="row">
				<div class="col" :class="items.length == 0 ? '' : 'd-none'">
					<div class="alert alert-danger text-center">
						Pending is Empty as of the moment
					</div>
				</div>
				<div class="col" :class="items.length == 0 ? 'd-none' : ''">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Item</th>
								<th>Category</th>
								<th>Customer</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in items" :key="item.id">
								<td>
									<img
										:src="`../../images/${item.item.item_photo}`"
										style="height:50px; width: 50px; border: #f57224 solid 1.5px;"
									/>
									{{ item.item_name }}
								</td>
								<td>{{ item.item.category.category_name }}</td>
								<td>{{ item.customer.username }}</td>

								<td>
									<button
										:disabled="
											item.is_claimed == 1 ||
												item.is_rejected == 1 ||
												item.is_confiscated == 1
										"
										:class="
											item.is_claimed == 1 ||
											item.is_rejected == 1 ||
											item.is_confiscated == 1
												? 'btn-light'
												: ''
										"
										class="btn btn-success"
										@click="showModal(item)"
									>

									<span v-if="item.is_claimed == 1">Claimed</span>
									<!-- <span v-else-if="is_rejected == 1">rejected</span> -->
									<span v-else-if="item.is_confiscated == 1">Confiscated</span>
									<span v-else > Manage </span>
									
									</button>
									<button class="btn btn-success d-none" @click="showModal(item)">
										Manage
									</button>
									<button class="btn btn-info" @click="showHistortModal(item)">
										Payment History
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<modal-payments ref="modalPayments"></modal-payments>
		<modal-payment-history ref="modalPaymentsHistory"></modal-payment-history>
	</div>
</template>
<script>
import AuthService from "../../services/auth";
export default {
	created() {
		this.GetPawnedItemsByPawnshop();
	},
	data() {
		return {
			pawnshop_id2: AuthService.methods.getUid(),
			items: []
		};
	},
	methods: {
		async GetPawnedItemsByPawnshop() {
			await axios
				.get("/api/getPawenedItems/" + this.pawnshop_id2)
				.then(res => {
					console.log(res);
					this.items = res.data;
				})
				.catch(err => {
					console.error(err);
				});
		},

		showModal(item) {
			this.$refs.modalPayments.pawned_item = item;
			this.$refs.modalPayments.getPaymentCalculations();
			$("#modalPawningPayment").modal("show");
		},
		showHistortModal(item) {
			this.$refs.modalPaymentsHistory.showModal(item);
		}
	}
};
</script>