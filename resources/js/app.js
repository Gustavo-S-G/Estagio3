require('./bootstrap');

window.Vue = require('vue');
window.Fire = new Vue();
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
// import '@fullcalendar/core/vdom' // solves problem with Vite
// import FullCalendar from '@fullcalendar/vue'
// Vue.use(FullCalendar);

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

import VueToastr from "vue-toastr";
Vue.use(VueToastr, {
    defaultTimeout: 3000,
    defaultPosition: "toast-top-right",
    defaultProgressBar: false,
    defaultProgressBarValue: 0,
});

import moment from 'moment';

Vue.filter("date", function (created) {
    return moment(created).format('DD/MM/YYYY HH:mm:ss');
});

import Swal from 'sweetalert2';
import Vue from 'vue';

window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.toast = Toast;

// import { Form, HasError, AlertError } from 'vform';

// window.Form = Form;

// Vue.component(HasError.name, HasError);
// Vue.component(AlertError.name, AlertError);

// vform component
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform/src/components/bootstrap5';

// 'vform/src/components/bootstrap5';
// 'vform/src/components/tailwind'

// import { Button } from 'vform/src/components/bootstrap5';

// Vue component
Vue.component(Button.name, Button);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

Vue.component('role', require('./components/role.vue').default);
Vue.component('user', require('./components/user.vue').default);
Vue.component('loading', require('./components/loading.vue').default);
Vue.component('roleedit', require('./components/roleedit.vue').default);
Vue.component('schedule', require('./components/schedule.vue').default);

const routes = [
    { path: '/role', component: require('./components/role.vue').default },
    { path: '/user', component: require('./components/user.vue').default },
    { path: '/roleedit', component: require('./components/roleedit.vue').default },
    { path: '/schedule', component: require('./components/schedule.vue').default },
];

// Vue Router
const app = new Vue({
    el: '#app'
});
