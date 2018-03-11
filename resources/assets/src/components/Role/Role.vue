<template>
    <div class="page">
        <Menu mode="horizontal" theme="light" :active-name="$route.name" @on-select="handleMenuSelect">
            <MenuItem name="role.list">
                <Icon type="ios-keypad"></Icon>
                角色列表
            </MenuItem>
            <MenuItem name="role.add">
                <Icon type="plus-round"></Icon>
                新增角色
            </MenuItem>
        </Menu>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    methods: {
        handleMenuSelect (name) {
            this.$router.push({name})
        }
    }
}
</script>
