/* eslint-disable vue/multi-word-component-names */
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta';
import App from './App.vue';
import routes from './routes';
import store from './store';
import VueAppend from 'vue-append'

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
Vue.use(VueAppend);

Vue.component('Multiselect', Multiselect);


const router = new VueRouter({
    routes,
    mode: 'history',
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((m) => m.meta.memberAuth === false)) {
        let member_is_authenthicated = store.state.member_api_token;

        if (member_is_authenthicated) next('/projects');

        next();
        return;
    }

    if (to.matched.some((m) => m.meta.memberAuth === true)) {
        var access_token = store.state.member_api_token;
        if (access_token) next();
        if (access_token == '') next('/');
        return;
    }

    next();
    return;
});
Vue.prototype.$appEvents = new Vue();

new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount('#app');
