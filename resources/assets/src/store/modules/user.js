import avatar from '@/assets/default-avatar.png'
const user = {
    state: {
        id: '',
        name: '',
        mobile: '',
        email: '',
        avatar: avatar,
        permissions: []
    },
    mutations: {
        updateUser (state, payload) {
            state.id = payload.id
            state.name = payload.username
            state.mobile = payload.mobile
            state.email = payload.email
            state.permissions = payload.permissions
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
            state.permissions = []
        }
    }
}
export default user
