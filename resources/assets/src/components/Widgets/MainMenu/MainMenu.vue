<template>
    <Menu :active-name="$route.name" theme="dark" width="auto" :open-names="[]" @on-select="handleRedirect">
        <div v-for="(item, key) in menus" :key="key">
            <Submenu :name="key" v-if="item.children" v-show="filterMenu(item)">
                <template slot="title">
                    <Icon :type="item.icon"></Icon>
                    {{ item.title }}
                </template>
                <MenuItem :name="child.name" v-for="child in item.children" :key="child.name" v-show="filterMenu(child)">{{ child.title }}</MenuItem>
            </Submenu>
            <MenuItem :name="item.name" v-else v-show="filterMenu(item)">
                <Icon :type="item.icon"></Icon>
                {{ item.title }}
            </MenuItem>
        </div>
        <MenuItem name="logout">
            <Icon type="log-out"></Icon>
            注销
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
                {title: '控制台', name: 'dashboard', icon: 'home'},
                {
                    title: '用户管理',
                    icon: 'person',
                    children: [
                        {title: '用户管理', name: 'user.list'},
                        {title: '角色管理', name: 'role.list'},
                        {title: '权限管理', name: 'access.list'},
                        {title: '头像管理', name: 'avatar.list'}
                    ]
                },
                {title: '项目管理', name: 'project.list', icon: 'ios-box'},
                {title: '图表', name: 'charts', icon: 'stats-bars'},
                {title: '测试', name: 'test', icon: 'home'}
            ]
        }
    }
}
</script>
