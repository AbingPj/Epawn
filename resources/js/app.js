/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




import Echo from "laravel-echo";
window.Pusher = require("pusher-js");
window.Echo = new Echo({
    broadcaster: "pusher",
    key: "daac01c5e5a1237f4168",
    cluster: "ap1",
    forceTLS: true
});


import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueEvents from "vue-events";
Vue.use(VueEvents);

import LoginComponent from './components/LoginComponent.vue';
import Signup from './components/Signup.vue';


//Parent Components(Main)
import PawnshopDashboard from './components/ParentComponents/PawnshopDashboard.vue';
import SuperAdminDashboard from './components/ParentComponents/SuperAdminDashboard.vue';
//


////////////// ADMIN  PAGES /////////////
import SuperAdminDashboardOld from './components/SuperAdminDashboard.vue'; 
import ReportedUsers from './components/AdminPages/ReportedUsers.vue'; 
Vue.component("reported-users", require("./components/AdminPages/ReportedUsers.vue").default);
Vue.component("api-api-api", require("./components/NewComponents/api.vue").default);
/////////////////////////////////


//////////////   pawnshop pages    //////////////
//Dashboird
import DashboardComponent2 from './components/PawnshopPages/DashboardComponent2.vue';
import SingleItem2 from './components/PawnshopPages/SingleItem2.vue';
import SingleBiddedItem2 from './components/PawnshopPages/SingleBiddedItem2.vue';
Vue.component("single-item-pictures", require("./components/PawnshopPages/SingleItemPictures.vue").default);
Vue.component("modal-report-user", require("./components/Modal/ModalReportUser.vue").default);
//

//Pending items
import ListOfPendingItems from './components/PawnshopPages/ListOfPendingItems.vue';
Vue.component("modal-pawning", require("./components/Modal/ModalPawning.vue").default);
//

//Pawned Items
import ListOfPawnedItems from './components/PawnshopPages/ListOfPawnedItems.vue';
Vue.component("modal-payments", require("./components/Modal/ModalPayments.vue").default);
Vue.component("modal-payment-history", require("./components/Modal/ModalPaymentHistory.vue").default);
//

//Profile
import ProfileComponent2 from './components/PawnshopPages/ProfileComponent2.vue';
Vue.component("modal-add-pacakge-two", require("./components/Modal/ModalAddPackage2.vue").default);
Vue.component("modal-edit-pacakge", require("./components/Modal/ModalEditPacakge.vue").default);
Vue.component("modal-package-details", require("./components/Modal/ModalPackageDetails.vue").default);


//

//Notification
import AdminNotification from './components/PawnshopPages/AdminNotification.vue';
//
///////////////////////////////////////////////////////////////////////////////



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/Login',
            name: 'login',
            component: LoginComponent
        },
        {
            path: '/Signup',
            name: 'signup',
            component: Signup
        },
        {
            path: '/SuperAdmin',
            component: SuperAdminDashboard,
            children: [
                {
                    path: '/SuperAdmin/Categories',
                    name: 'superadmindashboard',
                    component: SuperAdminDashboardOld
                },
                {
                    path: '/SuperAdmin/ReportedUsers',
                    name: 'reported-users',
                    components: {
                        helper: ReportedUsers
                    }

                },
            ]
        },
        {
            path: '/',
            component: PawnshopDashboard,
            children: [
                {
                    path: '',
                    name: 'dashboard',
                    component: DashboardComponent2
                },
                {
                    path: '/AdminNotification',
                    name: 'admin-notification',
                    components: {
                        helper: AdminNotification
                    }

                },
                {
                    path: '/MyProfile',
                    name: 'profile',
                    components: {
                        helper: ProfileComponent2
                    }

                },
                {
                    path: '/Singleitem/:itemId',
                    name: 'item2',
                    components: {
                        helper: SingleItem2
                    }
                },
                {
                    path: '/Bidding/:itemId/bidderId/:bidderId',
                    name: 'singlebid2',
                    components: {
                        helper: SingleBiddedItem2
                    }
                },

                {
                    path: '/PendingItems',
                    name: 'pending-items',
                    components: {
                        helper: ListOfPendingItems
                    }
                },
                {
                    path: '/PawnedItems',
                    name: 'pawned-items',
                    components: {
                        helper: ListOfPawnedItems
                    }
                },
            ]
        }
    ]
})


const app = new Vue({
    el: '#app',
    router,
});
