<template>
   <div>
      <div class="container">
         <div class="row" v-for="item in pawnedItems" :key="item.id">
            <div class="col">Item:{{item.item_name}}</div>
            <div class="col">Customer:{{item.customer_name}}</div>
            <div class="col">
              <button class="btn btn-success" @click="showModal(item)">
                Manage
              </button>
            </div>
         </div>
       <modal-payments ref="modalPayments"></modal-payments>
      </div>
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
         pawnedItems: []
      };
   },
   methods: {
      async GetPawnedItemsByPawnshop() {
         await axios
            .get("/api/zGetPawnedItemsByPawnshop/" + this.pawnshop_id2)
            .then(res => {
               console.log(res);
               this.pawnedItems = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      },
       modalPawningShow(item){
     },
      showModal(item){
          this.$refs.modalPayments.pawned_item = item;
          this.$refs.modalPayments.getPaymentCalculations();
        $('#modalPawningPayment').modal('show');
      }
   }
};
</script>