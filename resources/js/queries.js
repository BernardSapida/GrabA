import Vue from 'vue';
import axios from 'axios';
import store from './store';

let queries = {
    saveAccount: `mutation saveAccount($account: AccountInput) {
        saveAccount(account: $account) {
            error,
            message
        }
    }`,
    saveLogin: `mutation saveLogin($member: LoginInput) {
        saveLogin(member: $member) {
            error, 
            message,
            token
        }
    }`,
    savePost: `mutation savePost($post: PostInput) {
        savePost(post: $post) {
            error,
            message
        }
    }`,
    savePostImage: `mutation savePostImage($image: Upload) {
        savePostImage(image: $image) {
            error,
            message
        }
    }`,
    getMember: `query getMember {
        getMember {
            email,
        }
    }`,
    getPosts: `query getPosts($postId: String) {
        getPosts(postId: $postId) {
            id,
            materials,
            fullname,
            position,
            hardware,
            contact
            address,
            purpose,
            created_at,
            imageName
            project {
                id,
                name
                fullname
                position
                member {
                    id,
                    firstname,
                    lastname,
                    position
                }
            }
        }
    }`,
    getProjects: `query getProjects($projectId: String) {
        getProjects(projectId: $projectId) {
            id,
            name,
            location,
            total_cost,
            fullname,
            position
        }
    }`,
    saveProject: `mutation saveProject($project: ProjectInput) {
        saveProject(project: $project) {
            error,
            message
        }
    }`
        
};

let memberQueries = ['getMember', 'getProjects', 'getPosts', 'saveProject', 'savePost', 'savePostImage'];

let uploadQueries = ['savePostImage']

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

    if (uploadQueries.some(q => q == queryName)) {
        token = store.state.member_api_token;
        let bodyFormData = new FormData();

        bodyFormData.set('operations', JSON.stringify({
            'query': queries[queryName],
            'variables': {"attachment": queryVariables.image}
        }));

        bodyFormData.set('operationName', null);
        bodyFormData.set('map', JSON.stringify({"file":["variables.image"]}));
        bodyFormData.append('file', queryVariables.image);
        bodyFormData.append('data', JSON.stringify(queryVariables.post));


        const uploadUrl = '/graphql/member';
        return axios.post(uploadUrl, bodyFormData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                "Authorization": `Bearer ${token}`
            }
        })
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