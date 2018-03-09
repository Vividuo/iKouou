<template>
    <div class="page">
        <Menu mode="horizontal" theme="light" :active-name="$route.name" @on-select="handleMenuSelect">
            <MenuItem name="avatar.list">
                <Icon type="ios-paper"></Icon>
                头像列表
            </MenuItem>
            <MenuItem name="avatar.add">
                <Icon type="ios-people"></Icon>
                新增头像
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
