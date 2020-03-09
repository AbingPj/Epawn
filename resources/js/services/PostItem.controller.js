import Vue from 'vue';
require ('../bootstrap');

export default {
    methods: {
        getSingleItem(itemId) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/getSingleitem/${itemId}`).then(res => {
                    resolve(res.data);
                }, err => {
                    reject(`error with ${err}`)
                });
            });
        },
        getItemPictures(itemId) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/getItemPictures/${itemId}`)
                    .then(res => {
                        resolve(res.data)
                    }, err => `error with ${err}`);
            })

        },
        getAllItems(data){
            return new Promise((resolve , reject) =>{
                axios.post("/api/getItems2", data).then(res => {
                    resolve(res.data);
                  }, err =>{
                      reject(err);
                  });
            })
        }
    }
}
