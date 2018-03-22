export default [{
    path: '/errors',
    component: () => import('@/components/Errors'),
    children: [{
        path: '404',
        name: '404',
        meta: {
            title: '页面不存在',
            guest: true
        },
        component: () => import('@/components/Errors/404')
    }, {
        path: '403',
        name: '403',
        meta: {
            title: '没有权限',
            guest: true
        },
        component: () => import('@/components/Errors/403')
    }, {
        path: '500',
        name: '500',
        meta: {
            title: '服务器错误',
            guest: true
        },
        component: () => import('@/components/Errors/500')
    }]
}]
