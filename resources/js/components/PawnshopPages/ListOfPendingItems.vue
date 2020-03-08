<template>
	<div>
		<div class="parent-div">
			<div class="container">
				<h1>Pending Item Records</h1>
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
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="item in items" :key="item.id">
									<td>
										<img
											:src="`../../images/${item.item_photo}`"
											style="height:50px; width: 50px; border: #f57224 solid 1.5px;"
										/>
										{{ item.item_name }}
									</td>
									<td>{{ item.category.category_name }}</td>
									<td>{{ item.user.username }}</td>

									<td>
										<button class="btn btn-success" @click="showModal(item)">
											Manage
										</button>
										<button class="btn btn-danger" @click="report(item)">
											<i
												class="fa fa-exclamation-circle"
												aria-hidden="true"
											></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- <modal-payments ref="modalPayments"></modal-payments> -->
		</div>
		<modal-report-user ref="reportModal"></modal-report-user>
		<modal-pawning ref="modalPawning"></modal-pawning>
	</div>
</template>
<style lang="scss"scoped>
.parent-div {
	margin: 0% 0%;
	padding: 3% 5%;
}
</style>
<script>
import AuthService from "../../services/auth";
export default {
	created() {
		this.GetPendingItemsByPawnshop();
	},
	mounted() {
		this.$parent.selectedLi = "pending";
	},

	data() {
		return {
			pawnshop_id: AuthService.methods.getUid(),
			items: []
		};
	},
	methods: {
		showModal(item) {
			this.$refs.modalPawning.item = item;
			$("#modalPawning").modal("show");
		},

		report(data) {
			//let spreadedData = { ...data };
			// this.$refs.reportModal.data = data;",
			this.$refs.reportModal.username = data.user.username;
			this.$refs.reportModal.item_name = data.item_name;
			this.$refs.reportModal.report.userId = data.user_id;
			this.$refs.reportModal.report.pawnshopId = data.pawnshop_id;

			$("#reportModal").modal("show");
		},
		async GetPendingItemsByPawnshop() {
			await axios
				.get("api/getPendingItems/" + this.pawnshop_id)
				.then(res => {
					console.log(res);
					this.items = res.data;
				})
				.catch(err => {
					console.error(err);
				});
		}
	}
};
</script>