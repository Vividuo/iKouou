export default [{
    path: '*',
    redirect: {name: '404'}
}, {
    path: '/login',
    name: 'login',
    meta: {
        title: '登录',
        guest: true
    },
    component: () => import('@/components/Login')
}]
