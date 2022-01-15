

require('./bootstrap');



window.Vue = require('vue').default;

import VueRouter from 'vue-router'



Vue.use(VueRouter)



import Home from './components/Home.vue';
import Welcome from './components/EndUserPages/Welcome.vue';


//added for vform

window.Form = Form;
import Form from 'vform'
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
  } from 'vform/src/components/bootstrap4'


  Vue.component(Button.name, Button)
  Vue.component(HasError.name, HasError)
  Vue.component(AlertError.name, AlertError)
  Vue.component(AlertErrors.name, AlertErrors)
  Vue.component(AlertSuccess.name, AlertSuccess)


//  ending for vform

//  recall function starts
window.Fire = new Vue();
//  recall function ends

//  pagination starts
Vue.component('pagination', require('laravel-vue-pagination'));
//  pagination ends





//swall starting
import Swal from 'sweetalert2';
import Vue from 'vue';
window.Swal = Swal;

const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
onOpen: (toast) => {
toast.addEventListener('mouseenter', Swal.stopTimer)
toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})



window.Toast = Toast;
//swall import ending

//Fire command starts
window.Fire = new Vue();
//Fire command ends

//Progress bar starting
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '28px'
})
//Progress bar ending


let routes = [

    { path: '/', component: require('./components/Home.vue').default },
    { path: '/home', component: require('./components/Dashboard.vue').default },
    { path: '/Dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/Profile', component: require('./components/Profile.vue').default },
    { path: '/*', component: require('./components/NotFound.vue').default }

]


const router = new VueRouter({
    mode:'history',
    routes
})



const home = new Vue({
    el: '#home',
    render: h => h(Home),
    router,
});

const welcome = new Vue({
    el: '#welcome',
    render: h => h(Welcome),
    router,
});


