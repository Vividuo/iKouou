import error from './modules/error'
import app from './modules/app'
export default [...error, ...app, {
    path: '/',
    component: () => import('../components/Container'),
    children: [{
        path: '',
        name: 'dashboard',
        meta: {
            title: '控制台',
            auth: true
        },
        component: () => import('../components/Dashboard')
    }, {
        path: 'profile',
        name: 'profile',
        meta: {
            title: '修改个人信息',
            auth: true
        },
        component: () => import('../components/Profile')
    }, {
        path: 'test',
        name: 'test',
        meta: {
            title: '测试'
        },
        component: () => import('../components/Test')
    }, {
        path: 'charts',
        name: 'charts',
        meta: {
            title: '图表',
            auth: true
        },
        component: () => import('../components/Charts')
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
        }, {
            path: ':id/edit',
            name: 'user.edit',
            meta: {
                title: '修改用户'
            },
            component: () => import('../components/User/Edit')
        }]
    }, {
        path: 'roles',
        name: 'role.list',
        meta: {
            title: '用户角色'
        },
        component: () => import('../components/Role')

    }, {
        path: 'accesses',
        name: 'access.list',
        meta: {
            title: '用户权限'
        },
        component: () => import('../components/Access')
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
