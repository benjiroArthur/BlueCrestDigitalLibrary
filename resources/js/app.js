/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import * as pdfjs from 'pdfjs';



window.Vue = require('vue');

import {Form, HasError, AlertError} from 'vform';

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');


window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import * as moment from 'moment';
//let moment = require('moment');
window.Fire = new Vue();

import VueRouter from 'vue-router';
import axios from "axios";

Vue.use(VueRouter, axios);

Vue.filter('uptext', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});
Vue.filter('myDate', function(text){
    return moment(text).format('Do MMMM YYYY');
});
Vue.filter('fromNow', function(text){
    return moment(text).startOf('day').fromNow();
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Book.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('book', require('./components/Book.vue').default);

// let routes = [
//     {path:'/get-book/:id', component: require('./components/Book.vue').default, name:'get-book'},
// ];
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode:'history',
    //routes

});

const app = new Vue({
    el: '#app',
    router,
    data:{
        book:'',
        comments:''
    },

});


/*var channel = Echo.channel('my-channel');
channel.listen('.my-event', function(data) {
    alert(JSON.stringify(data));
});*/

