import Vue from 'vue';
require ('../bootstrap');

export default {
    methods: {
        addToPawnshop(pack){
            return new Promise((resolve, reject) => {
                axios.post(`/api/addToPawnshop/`, pack).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            })
        },
        viewDurations(){
            return new Promise((resolve , reject)=>{
                axios.get(`api/viewDurations/`).then(res => {
                    resolve(res.data);
                }, err => {
                    reject(err);
                })
            })
        },
        addPackage(pack) {
            return new Promise((resolve, reject) => {
                console.info('value of apck is ' , JSON.stringify(pack))
                axios.post(`/api/addPackage/`, pack).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        editPackage(pack){
            return new Promise((resolve, reject) => {
                axios.post(`/api/updatePackage/`, pack).then(res => {
                    resolve(res.data,'succesfully edited');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        removePackage(pack){
            return new Promise((resolve, reject) => {
                axios.post(`/api/deletePackage/`, pack).then(res => {
                    resolve(res.data,'succesfully placed');
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        viewAllPackage(){
            return new Promise((resolve, reject) => {
                axios.get(`/api/viewPackages/`).then(res => {
                    resolve(res.data);
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        getItemCategories(){
            return new Promise((resolve,reject) => {
                axios.get(`/api/getItemCategories/`).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        addItemCategory(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/addItemCategory/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        viewPawnshopCategories(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/viewPawnshopCategories/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        sendCategoryRequest(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/sendCategoryRequest/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        getPendingCategories(data){
            return new Promise((resolve,reject) => {
                axios.post(`/api/getPendingCategories/`,data).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        acceptCategory(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/acceptCategoryRequest/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        declineCategry(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/declineCategoryRequest/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        removeItemCategory(category){
            return new Promise((resolve,reject) => {
                axios.post(`/api/removeItemCategory/`, category).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        getPawnshopPackages(data){
            return new Promise((resolve,reject) => {
                axios.post(`/api/getPawnshopPackages/`, data).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        },
        getDuration(data){
            return new Promise((resolve,reject) => {
                axios.post(`/api/getDuration/`, data).then(res => {
                    resolve(res.data);
                } , err=> { reject(`err with ${err}`)})
            })
        }
    }
}
