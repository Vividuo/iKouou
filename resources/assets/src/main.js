// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import iView from 'iview'
import api from './utils/api'
// import avatar from './assets/avatar.png'
import 'iview/dist/styles/iview.css'
Vue.use(iView)
Vue.config.productionTip = false

api.get('/api/init').then(data => {
    if (data.result.user) {
        store.commit('updateUser', data.result.user)
    }
    if (data.result.permissions) {
        store.commit('updatePermissions', data.result.permissions)
    }
    store.commit('updateToken', data.result.token)
}).finally(() => {
    /* eslint-disable no-new */
    new Vue({
        el: '#app',
        router,
        store,
        components: {
            App
        },
        template: '<App/>'
    })
})
