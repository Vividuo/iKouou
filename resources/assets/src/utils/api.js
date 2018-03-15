import { Message } from 'iview'
import axios from 'axios'
import store from '@/store'
import router from '@/router'
const origin = process.env.NODE_ENV === 'development' ? '//test.ikouou.com' : '//www.ikouou.com'
const api = {
    get (path, params) {
        const options = {
            method: 'get',
            params: params
        }
        return this.fetch(path, options)
    },
    post (path, params) {
        const options = {
            method: 'post',
            data: params,
            headers: {
                'X-CSRF-TOKEN': store.state.app.token
            }
        }
        return this.fetch(path, options)
    },
    fetch (path, options) {
        return new Promise((resolve, reject) => {
            options = Object.assign({
                url: origin + path,
                withCredentials: true
            }, options)
            axios(options).then(res => {
                if (res.data.code === '200') {
                    resolve(res.data)
                } else if (res.data.code === '403') {
                    router.push({name: '403'})
                } else if (res.data.code === '500') {
                    console.log(res)
                    router.push({name: '500'})
                } else {
                    Message.warning(res.data.msg)
                    reject(res.data)
                }
            }).catch(err => {
                if (err.response && err.response.status === '520') {
                    Message.error('页面已过期, 即将自动刷新页面')
                    setTimeout(() => {
                        location.reload()
                    }, 1000)
                } else {
                    router.push({name: '500'})
                    // Message.error('妈呀，服务器跑偏了，稍后再试一下吧')
                }
                reject(err)
            })
        })
    }
}

export default api
