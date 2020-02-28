/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import LoginComponent from './components/LoginComponent.vue';
import DashboardComponent from './components/DashboardComponent.vue';
import BiddingDashboard from './components/BiddingDashboard.vue';
import ProfileComponent from './components/ProfileComponent.vue';
import SingleItem from './components/SingleItem.vue';
import SingleBiddedItem from './components/SingleBiddedItem.vue';
import SuperAdminDashboard from './components/SuperAdminDashboard.vue';
import AdminNotification from './components/AdminNotification.vue';
import Signup from './components/Signup.vue';

//////////////   Added By Abing    //////////
import ProfileComponent2 from './components/NewComponents/ProfileComponent2.vue';
import SingleItem2 from './components/NewComponents/SingleItem2.vue';
import SingleBiddedItem2 from './components/NewComponents/SingleBiddedItem2.vue';
import DashboardComponent2 from './components/NewComponents/DashboardComponent2.vue';
import BiddingDashboard2 from './components/NewComponents/BiddingDashboard2.vue';

Vue.component("modal-edit-pacakge", require("./components/Modal/ModalEditPacakge.vue").default);
Vue.component("modal-add-pacakge", require("./components/Modal/ModalAddPacakge.vue").default);
Vue.component("modal-add-pacakge-two", require("./components/Modal/ModalAddPackage2.vue").default);
Vue.component("modal-report-user", require("./components/Modal/ModalReportUser.vue").default);
Vue.component("reported-users", require("./components/NewComponents/SuperAdminReportedUsers.vue").default);
Vue.component("single-item-pictures", require("./components/NewComponents/SingleItemPictures.vue").default);
Vue.component("modal-pawning", require("./components/Modal/ModalPawning.vue").default);
Vue.component("list-of-pawned-items", require("./components/NewComponents/ListOfPawnedItems.vue").default);
Vue.component("modal-payments", require("./components/Modal/ModalPayments.vue").default);
////////////////////////////////////////////

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/Login',
            name: 'login',
            component: LoginComponent
        }, {
            path: '/2',
            name: 'dashboard',
            component: DashboardComponent
        }, {
            path: '/MyBids2',
            name: 'bidding',
            component: BiddingDashboard
        }, {
            path: '/MyProfile2',
            name: 'profile2',
            component: ProfileComponent
        }, {
            path: '/Singleitem2/:itemId',
            name: 'item',
            component: SingleItem
        }, {
            path: '/Bidding2/:itemId/bidderId/:bidderId',
            name: 'singlebid',
            component: SingleBiddedItem
        }, {
            path: '/SuperAdmin/Board',
            name: 'superadmin-dashboard',
            component: SuperAdminDashboard
        }, {
            path: '/AdminNotification',
            name: 'admin-notification',
            component: AdminNotification
        }, {
            path: '/Signup',
            name: 'signup',
            component: Signup
        },

        //////// New Routes Components Added By Abing
        {
            path: '/MyProfile',
            name: 'profile',
            component: ProfileComponent2
        },
        {
            path: '/Singleitem/:itemId',
            name: 'item2',
            component: SingleItem2
        }, 
        {
            path: '/Bidding/:itemId/bidderId/:bidderId',
            name: 'singlebid2',
            component: SingleBiddedItem2
        },
        {
            path: '/',
            name: 'dashboard2',
            component: DashboardComponent2
        },
        {
            path: '/MyBids',
            name: 'bidding',
            component: BiddingDashboard2
        },

        
        /////////////////////////////////////
    ],
});

const app = new Vue({
    el: '#app',
    components: { LoginComponent },
    router,
});