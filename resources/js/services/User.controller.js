import vue from 'vue';
import Axios from 'axios';
require ('../bootstrap');

export default {
    methods : {
        getUserDetails(userId) {
            return new Promise( (resolve, reject) => {
                axios.get(`/api/getUserDetails/${userId}`).then( res => {
                    resolve(res.data);
                }, err => reject(err));
            })
        },
        changeProfile(user){
            return new Promise((resolve, reject)=>{
                axios.post(`/api/changeProfile`, user).then(res =>{
                    resolve(res.data);
                }, err => reject(err))
            })
        },
        getPendingUsers(data){
            return new Promise((resolve, reject)=>{
                axios.post(`/api/getPendingUsers`,data).then(res =>{
                    resolve(res.data);
                }, err => reject(err))
            })
        },
        addStore(data){
            return new Promise((resolve, reject)=>{
                axios.post(`/api/addStore`, data, {
                    headers : {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res =>{
                    resolve(res.data);
                }, err => reject(err))
            })
        },
        updateSatus(data){
            return new Promise((resolve, reject)=>{
                axios.post(`/api/updateSatus`, data).then(res =>{
                    resolve(res.data);
                }, err => reject(err))
            })
        },
        
    }
}