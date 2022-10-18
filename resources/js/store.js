import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        member_api_token: '',
    },
    mutations: {
        setLogin(state, response) {
            state.member_api_token = response.token;
        },
        resetState(state) {
            state.member_api_token = '';
        },
    },
    plugins: [createPersistedState()],
});

export default store;
