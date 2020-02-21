import Vue from 'vue';
require ('../bootstrap');

export default {
    methods : {
        sendSMS(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/sendSMS/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        closeDealSMS(data){
            return new Promise((resolve, reject) => {
                axios.post(`/api/closeDealSMS/`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
    }
}