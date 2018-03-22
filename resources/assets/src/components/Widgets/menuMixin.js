import api from '@/utils/api'
import {mapState} from 'vuex'
export default {
    computed: {
        ...mapState({
            user: state => state.user
        })
    },
    methods: {
        filterMenu (item) {
            if (item.children) {
                return item.children.some(child => {
                    return this.user.permissions.indexOf(child.name) >= 0
                })
            } else {
                return this.user.permissions.indexOf(item.name) >= 0
            }
        },
        handleRedirect (name) {
            if (name === 'logout') {
                api.get('/api/logout')
                this.$store.commit('resetUser')
                name = 'login'
            }
            this.$router.push({name})
        }
    }
}
