<template>
    <div class="page">
        <Menu mode="horizontal" theme="light" :active-name="$route.name" @on-select="handleMenuSelect">
            <MenuItem name="user.list">
                <Icon type="ios-keypad"></Icon>
                用户列表
            </MenuItem>
            <MenuItem name="user.add">
                <Icon type="plus-round"></Icon>
                新增用户
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
