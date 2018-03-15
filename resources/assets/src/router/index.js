import Vue from 'vue'
import Router from 'vue-router'
import routes from './routes'
import store from '../store'
import iView from 'iview'
Vue.use(Router)

const router = new Router({
    routes
})

router.beforeEach((to, from, next) => {
    if (to.name !== 'login' && !store.state.user.name) {
        next({name: 'login'})
        return
    } else if (to.name === 'login' && store.state.user.name) {
        next({name: 'dashboard'})
        return
    }
    window.document.title = to.meta.title
    iView.LoadingBar.start()
    next()
})

router.afterEach((to) => {
    iView.LoadingBar.finish()
    window.scrollTo(0, 0)
})

console.log(mapRoute(routes, 'avatar.add'))
function mapRoute (routes, target) {
    let result
    routes.forEach(item => {
        if (item.name === target) {
            result = item
            return false
        }
        if (item.children) {
            result = mapRoute(item.children, target)
            if (result) {
                return false
            }
        }
    })
    return result
}

export default router
