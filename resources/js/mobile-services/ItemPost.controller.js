import Vue from 'vue';
require('../bootstrap');

export default {
    methods: {
        isLogedIn() {
            return new Promise((resolve, reject) => {
                (window.localStorage.getItem('userId')) ? resolve(true) : reject(false);
            });
        },

    }
};