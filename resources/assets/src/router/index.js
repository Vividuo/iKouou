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

export default router
