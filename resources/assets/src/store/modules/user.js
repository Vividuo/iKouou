import avatar from '@/assets/default-avatar.png'
const user = {
    state: {
        id: '',
        name: '',
        mobile: '',
        email: '',
        avatar: avatar
    },
    mutations: {
        updateUser (state, payload) {
            state.id = payload.id
            state.name = payload.username
            state.mobile = payload.mobile
            state.email = payload.email
            if (payload.avatar) {
                state.avatar = payload.avatar
            }
        },
        resetUser (state, payload) {
            state.id = ''
            state.name = ''
            state.mobile = ''
            state.email = ''
            state.avatar = avatar
        }
    }
}
export default user
