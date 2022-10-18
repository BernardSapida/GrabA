import Vue from 'vue';
import axios from 'axios';
import store from './store';

let queries = {
    saveLogin: `mutation saveLogin($member: LoginInput) {
        saveLogin(member: $member) {
            error, 
            message,
            token
        }
    }`,
    getMember: `query getMember {
        getMember {
            email,
        }
    }`
        
};

let memberQueries = ['getMember'];

function getApiUrl(queryName) {
    let segment = '';

    if (memberQueries.some((q) => q == queryName)) {
        segment = '/member';
    }

    return `/graphql${segment}`;
}

Vue.prototype.$query = function (queryName, queryVariables) {
    let token;

    if (memberQueries.some((q) => q == queryName)) {
        token = store.state.member_api_token;
    }

    let options = {
        url: getApiUrl(queryName),
        method: 'POST',
        data: {
            query: queries[queryName],
        },
    };

    if (queryVariables) options.data.variables = queryVariables;

    if (token) {
        options.headers = {
            Authorization: `Bearer ${token}`,
        };
    }

    return axios(options);
};