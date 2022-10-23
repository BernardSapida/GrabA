import Signin from './components/Signin';
import Signup from './components/Signup';
import Dashboard from './components/Dashboard';
import Post from './components/NewPost';
import Projects from './components/Projects';
import Analytics from './components/Analytics';
import PageNotFound from './components/PageNotFound';

export default [
    {
        path: '/',
        name: 'signin',
        component: Signin,
        meta: { memberAuth: false },
    },
    {
        path: '/signup',
        name: 'signup',
        component: Signup,
        meta: { memberAuth: false },
    },
    {
        path: '/dashboard/:id',
        name: 'dashboard',
        component: Dashboard,
        meta: { memberAuth: true },
    },
    {
        path: '/post/:id',
        name: 'post',
        component: Post,
        meta: { memberAuth: true },
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects,
        meta: { memberAuth: true },
    },
    {
        path: '/analytics/:id',
        name: 'analytics',
        component: Analytics,
        meta: { memberAuth: true },
    },
    {
        path: '*',
        name: '404',
        component: PageNotFound
    }
]
