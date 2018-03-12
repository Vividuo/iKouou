// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import iView from 'iview'
import api from './utils/api'
import avatar from './assets/avatar.png'
import 'iview/dist/styles/iview.css'
Vue.use(iView)
Vue.config.productionTip = false

api.get('/api/init').then(data => {
    console.log(data.result)
    store.commit('userLogin', {
        name: data.result.username,
        avatar: avatar
    })
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
