import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta';
import App from './App.vue';
import routes from './routes';
import store from './store';

import './queries';
import './../sass/app.scss';
import './queries';
import './helper';

import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import Multiselect from 'vue-multiselect';

Vue.use(VueRouter);
Vue.use(VueMeta);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueSweetalert2);

Vue.component('multiselect', Multiselect);


const router = new VueRouter({
    routes,
    mode: 'history',
});

router.beforeEach((to, from, next) => {
   
    next();
    return;
});
Vue.prototype.$appEvents = new Vue();

new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount('#app');