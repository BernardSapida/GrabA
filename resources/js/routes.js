import Signin from './components/Signin';
import Signup from './components/Signup';
import Dashboard from './components/Dashboard';
import Projects from './components/Projects';
import Analytics from './components/Analytics';

export default [
    {
        path: '/',
        name: 'signin',
        component: Signin
    },
    {
        path: '/signup',
        name: 'signup',
        component: Signup
    },
    {
        path: '/dashboard/:id',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects
    },
    {
        path: '/analytics/:id',
        name: 'analytics',
        component: Analytics
    },
]
