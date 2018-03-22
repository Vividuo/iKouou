<template>
    <div>
        <User-Menu></User-Menu>
        <router-view></router-view>
    </div>
</template>
<script>
import UserMenu from '../Widgets/UserMenu'
export default {
    components: {
        UserMenu
    },
    data () {
        return {
            menus: [
                {title: '用户管理', name: 'user.list'},
                {title: '角色管理', name: 'role'},
                {title: '权限管理', name: 'access'},
                {title: '头像管理', name: 'avatar.list'}
            ]
        }
    },
    methods: {
        handleMenuSelect (name) {
            this.$router.push({name})
        }
    },
    mounted () {

    }
}
</script>
