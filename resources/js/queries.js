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
            message,
            id
        }
    }`,
    savePostImage: `mutation savePostImage($image: [Upload!], $postId: Int) {
        savePostImage(image: $image, postId: $postId) {
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
            purpose,
            fullname,
            address,
            contact
            created_at,
            imageName,
            name,
            position,
            images
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
    }`,
    getEditPost: `query getEditPost($postId: Int, $projectId: Int) {
        getEditPost(postId: $postId, projectId: $projectId) {
            id,
            materials,
            purpose,
            fullname,
            address,
            contact
            created_at,
            imageName,
            images
            name,
            position
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
    saveEditPost: `mutation saveEditPost($post: PostInput) {
        saveEditPost(post: $post) {
            error,
            message
        }
    }`,
    deletePost: `query deletePost($postId: Int, $projectId: Int) {
        deletePost(postId: $postId, projectId: $projectId) {
            error,
            message
        }
    }`,
    saveEditPostImage:`mutation saveEditPostImage($image: [Upload!], $postId: Int) {
        saveEditPostImage(image: $image, postId: $postId) {
            error,
            message
        }
    }`
        
};

let memberQueries = ['getMember', 'getProjects', 'getPosts', 'saveProject', 'savePost', 'savePostImage', 'getEditPost', 'saveEditPost', 'deletePost', 'saveEditPostImage'];

let uploadQueries = ['savePostImage', 'saveEditPostImage']

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

        let objects = Object.values(queryVariables.image)

        bodyFormData.set('operations', JSON.stringify({
            'query': queries[queryName],
            'variables': queryVariables
        }));
        bodyFormData.set('operationName', null);
 
        
        
        // bodyFormData.set('map', JSON.stringify(queryVariables.image));

        for (let i = 0; i<objects.length; i++){
            bodyFormData.append('file[]', objects[i]);
            // bodyFormData.append('file', objects[i]);
            bodyFormData.append('map', JSON.stringify({"file":[`variables.image.${[i]}`]}));
        }

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