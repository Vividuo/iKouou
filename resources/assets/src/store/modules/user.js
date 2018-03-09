const user = {
    state: {
        name: '',
        avatar: ''
    },
    mutations: {
        userLogin (state, payload) {
            state.name = payload.name
            state.avatar = payload.avatar
        },
        userLogout (state, payload) {
            state.name = ''
            state.avatar = ''
        }
    }
}
export default user
