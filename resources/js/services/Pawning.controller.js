import Vue from 'vue';
require ('../bootstrap');

export default {
    methods : {
        displayBidDetails(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/getPawnedItem`,data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        payPawn(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/payPawn`,data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        getPaymentHistory(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/getPaymentHistory`,data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
    }
}