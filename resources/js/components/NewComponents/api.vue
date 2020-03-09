<template lang="">
    <div>
        .
    </div>
</template>

<script>
export default {
	created() {
		this.getUserBiddingRecords2();
		this.getUserBiddings2();
	},
	methods: {
		async getUserBiddingRecords2() {
			let data = {
				userId: 19
			};
			await axios
				.post("api/mobile2/getUserBiddingRecords2", data)
				.then(res => {
					console.log(res);
				})
				.catch(err => {
					console.error(err);
				});
		},

		async getUserBiddings2() {
			let data = {
				userId: 19
			};
			await axios
				.post("api/mobile2/getUserBiddings2", data)
				.then(res => {
					console.log(res);
				})
				.catch(err => {
					console.error(err);
				});
		}
	}
};
</script>