import { Message } from 'iview'
import axios from 'axios'
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
        return this.fetch(path, options)
    },
    fetch (path, options) {
        return new Promise((resolve, reject) => {
            options = Object.assign({
                url: origin + path
            }, options)
            axios(options).then(res => {
                if (res.data.code === '200') {
                    resolve(res.data)
                } else {
                    Message.warning(res.data.msg)
                    if (res.data.code === '401') {
                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    } else {
                        reject(res.data)
                    }
                }
            }).catch(err => {
                console.log(err)
                if (err.response.status === '520') {
                    Message.error('页面已过期, 即将自动刷新页面')
                    setTimeout(() => {
                        location.reload()
                    }, 1000)
                } else {
                    Message.error('妈呀，服务器跑偏了，稍后再试一下吧')
                    reject(err)
                }
            })
        })
    }
}

export default api
