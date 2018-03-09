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
        path: 'users',
        name: 'user.list',
        meta: {
            title: '用户列表'
        },
        component: () => import('../components/User/List')
    }, {
        path: 'roles',
        name: 'role.list',
        meta: {
            title: '角色列表'
        },
        component: () => import('../components/User/Role')
    }, {
        path: 'accesses',
        name: 'access.list',
        meta: {
            title: '权限列表'
        },
        component: () => import('../components/User/Access')
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
