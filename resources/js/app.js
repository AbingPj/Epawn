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

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/Login',
            name: 'login',
            component: LoginComponent
        },{
            path: '/',
            name: 'dashboard',
            component: DashboardComponent
        },{
            path: '/MyBids',
            name: 'bidding',
            component: BiddingDashboard
        },{
            path: '/MyProfile',
            name: 'profile',
            component: ProfileComponent
        },{
            path: '/Singleitem/:itemId',
            name: 'item',
            component: SingleItem
        },{
            path : '/Bidding/:itemId/bidderId/:bidderId',
            name: 'singlebid',
            component: SingleBiddedItem
        },{
            path : '/SuperAdmin/Board',
            name : 'superadmin-dashboard',
            component : SuperAdminDashboard
        },{
            path : '/AdminNotification',
            name : 'admin-notification',
            component : AdminNotification
        },{
            path : '/Signup',
            name : 'signup',
            component : Signup
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { LoginComponent },
    router,
});