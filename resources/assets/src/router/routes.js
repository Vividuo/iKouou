export default [{
    path: '/login',
    name: 'login',
    meta: {
        title: '登录'
    },
    component: () => import('../components/Login')
}, {
    path: '/',
    component: () => import('../components/Container'),
    children: [{
        path: '',
        name: 'dashboard',
        parent: 'login',
        meta: {
            title: '控制台'
        },
        component: () => import('../components/Dashboard')
    }, {
        path: 'profile',
        name: 'profile',
        meta: {
            title: '修改个人信息'
        },
        component: () => import('../components/User/Profile')
    }, {
        path: 'users',
        component: () => import('../components/User'),
        children: [{
            path: '',
            name: 'user.list',
            meta: {
                title: '用户列表'
            },
            component: () => import('../components/User/List')
        }, {
            path: 'add',
            name: 'user.add',
            meta: {
                title: '新增用户'
            },
            component: () => import('../components/User/Add')
        }]
    }, {
        path: 'roles',
        component: () => import('../components/Role'),
        children: [{
            path: '',
            name: 'role.list',
            meta: {
                title: '角色列表'
            },
            component: () => import('../components/Role/List')
        }, {
            path: 'add',
            name: 'role.add',
            meta: {
                title: '新增角色'
            },
            component: () => import('../components/Role/Add')
        }]
    }, {
        path: 'accesses',
        component: () => import('../components/Access'),
        children: [{
            path: '',
            name: 'access.list',
            meta: {
                title: '用户权限'
            },
            component: () => import('../components/Access/List')
        }, {
            path: 'add',
            name: 'access.add',
            meta: {
                title: '新增权限'
            },
            component: () => import('../components/Access/Add')
        }]
    }, {
        path: 'avatars',
        component: () => import('../components/Avatar'),
        children: [{
            path: '',
            name: 'avatar.list',
            meta: {
                title: '头像列表'
            },
            component: () => import('../components/Avatar/List')
        }, {
            path: 'add',
            name: 'avatar.add',
            meta: {
                title: '新增头像'
            },
            component: () => import('../components/Avatar/Add')
        }]
    }, {
        path: 'projects',
        name: 'project.list',
        meta: {
            title: '项目列表'
        },
        component: () => import('../components/Project/List')
    }, {
        path: 'projects/create',
        name: 'project.create',
        meta: {
            title: '新增项目'
        },
        component: () => import('../components/Project/Create')
    }]
}]
