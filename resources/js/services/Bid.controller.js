import Vue from 'vue';
require ('../bootstrap');

export default {
    methods : {
        placeBid(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/placeBid/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        displayBidDetails(data){
            return new Promise((resolve, reject) => {
                axios.get(`/api/getBidPlacements/${data.itemId}/bidder/${data.bidderId}/pawnshop/${data.pawnshopId}`).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        closeDeal(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/closeDeal/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        getMyBiddings(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/getMyBiddings/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        getMyBiddingRecords(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/getBiddingRecords/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        AcceptDeal(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/acceptDeal/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        rejectDeal(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/rejectDeal/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        }
    }
}