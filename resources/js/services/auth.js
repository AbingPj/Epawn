import Vue from 'vue';
require('../bootstrap');
export default {

    methods: {
        isLogedIn() {
            return new Promise((resolve, reject) => {
                (window.localStorage.getItem('userId')) ? resolve(true) : reject(false);
            });
        },
        Login(uId) {
            return new Promise((resolve, reject) => {
                window.localStorage.setItem('userId', String(uId));
                resolve(true);
                // this.isLogedIn().then(() => {
                //     window.localStorage.set('userId', uId);
                //     resolve('succesfully loged in');
                // }).catch((err) => {
                //     reject('error in logging in', err);
                // })
            })
        },
        checkUser(username , password){
            let userData = {username : username , password : password};
            return new Promise( (resolve , reject) => {
                axios.post('/api/loginUser',userData).then(res => {
                    (res.data.length  == 1)? 
                        resolve(res.data)
                    : 
                        resolve([{'0' : 'user not found'}]);
                    ;
                }, err => reject(err));
            });
        },
        getUid(){
            return parseInt(window.localStorage.getItem('userId'));
        },
        Logout(){
            window.localStorage.clear();
        }

    }

};