<template>
    <div class="page">
        <Menu mode="horizontal" theme="light" :active-name="$route.name" @on-select="handleMenuSelect">
            <MenuItem name="access.list">
                <Icon type="ios-keypad"></Icon>
                权限列表
            </MenuItem>
            <MenuItem name="access.add">
                <Icon type="plus-round"></Icon>
                新增权限
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
