import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        ym_sign: '',
        admin_api_token: '',
        member_api_token: '',
        login_type: '',
        admin_sidebar: 'dashboard',
        member_sidebar: 'dashboard',
    },
    mutations: {
        setYmSign(state, ym_sign) {
            state.ym_sign = ym_sign;
        },
        setLogin(state, response) {
            if (response.login_type === 'admin') {
                state.admin_api_token = response.token;
                state.login_type = response.login_type;
            } else if (response.login_type === 'member') {
                state.member_api_token = response.token;
                state.login_type = response.login_type;
            }
        },
        resetState(state) {
            state.admin_api_token = '';
            state.member_api_token = '';
            state.login_type = '';
            state.admin_sidebar = 'dashboard';
            state.member_sidebar = 'dashboard';
        },
        setAdminSidebar(state, link) {
            state.admin_sidebar = link;
        },
        setMemberSidebar(state, link) {
            state.member_sidebar = link;
        },
    },
    plugins: [createPersistedState()],
});

export default store;
