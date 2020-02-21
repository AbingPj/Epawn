import Vue from 'vue';
import Swal from 'sweetalert2';
require ('../bootstrap');

export default {
    methods : {
        getCategoryRequestNotifications(data){
            return new Promise((resolve, reject) => {
                axios.post(`api/getCategoryRequestNotif`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            })
        },
        getSuperAdminNotifications(data){
            return new Promise((resolve, reject) => {
                axios.post(`api/getSuperAdminNotif`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            })
        },
        removeCategory(data){
            return new Promise((resolve, reject) => {
                axios.post(`api/removeCategory`, data).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            })
        }
    }
}