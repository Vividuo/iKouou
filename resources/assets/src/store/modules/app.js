import routes from '../../router/routes'
const app = {
    state: {
        routes,
        theme: 'dark',
        token: ''
    },
    mutations: {
        updateToken (state, payload) {
            console.log('update token', payload)
            state.token = payload
        }
    }
}
export default app
