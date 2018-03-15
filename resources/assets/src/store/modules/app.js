import routes from '../../router/routes'
const app = {
    state: {
        routes,
        theme: 'dark',
        permissions: [],
        token: ''
    },
    mutations: {
        updateToken (state, payload) {
            state.token = payload
        },
        updatePermissions (state, payload) {
            state.permissions = payload
        }
    }
}
export default app
