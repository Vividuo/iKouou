<template>
    <Menu mode="horizontal" theme="light" :active-name="$route.name" @on-select="handleRedirect">
        <MenuItem :name="item.name" v-for="item in menus" :key="item.name" v-show="filterMenu(item)">
            <Icon :type="item.icon"></Icon>
            {{ item.title }}
        </MenuItem>
    </Menu>
</template>
<script>
import mixin from '../menuMixin'
export default {
    mixins: [mixin],
    data () {
        return {
            menus: [
                {title: '用户管理', name: 'user.list'},
                {title: '角色管理', name: 'role.list'},
                {title: '权限管理', name: 'access.list'},
                {title: '头像管理', name: 'avatar.list'}
            ]
        }
    }
}
</script>
