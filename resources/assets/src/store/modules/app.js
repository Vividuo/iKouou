// import routes from '../../router/routes'
const app = {
    state: {
        // routes: routes,
        theme: 'dark',
        token: ''
    },
    mutations: {
        updateToken (state, payload) {
            state.token = payload
        }
    }
}
export default app
