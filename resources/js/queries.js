import Vue from 'vue';
import axios from 'axios';

let queries = {
    saveLogin: `mutation saveLogin($member: LoginInput) {
        saveLogin(member: $member) {
            error, 
            message
        }
    }`,
};

let grabQueries = [];

function getApiUrl(queryName) {
    let segment = '';

    if (grabQueries.some((q) => q == queryName)) {
        segment = '/user';
    }

    return `/graphql${segment}`;
}

Vue.prototype.$query = function (queryName, queryVariables) {
    let token;

    if (grabQueries.some((q) => q == queryName)) {
        token ='test';
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