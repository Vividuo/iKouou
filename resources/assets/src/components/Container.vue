<template>
    <div class="layout">
        <Layout :style="{minHeight: '100vh'}">
            <Header>
                <Menu mode="horizontal" theme="dark" active-name="1">
                    <div class="layout-logo"></div>
                    <div class="layout-nav">
                        <MenuItem name="1">
                            <Icon type="ios-navigate"></Icon>
                            Item 1
                        </MenuItem>
                        <MenuItem name="2">
                            <Icon type="ios-keypad"></Icon>
                            Item 2
                        </MenuItem>
                        <MenuItem name="3">
                            <Icon type="ios-analytics"></Icon>
                            Item 3
                        </MenuItem>
                        <MenuItem name="4">
                            <Avatar :src="user.avatar" style="background: #619fe7;margin-left: 10px;"></Avatar>
                            {{ user.name }}
                        </MenuItem>
                    </div>
                </Menu>

            </Header>
            <Layout>
                <Sider >
                    <Menu active-name="dashboard" theme="dark" width="auto" :open-names="[]" @on-select="handleMenuSelect">
                        <MenuItem name="dashboard">
                            <Icon type="ios-home"></Icon>
                            控制台
                        </MenuItem>
                        <Submenu name="1">
                            <template slot="title">
                                <Icon type="ios-person" size="24"></Icon>
                                用户管理
                            </template>
                            <MenuItem name="user.list">用户列表</MenuItem>
                            <MenuItem name="role.list">角色列表</MenuItem>
                            <MenuItem name="access.list">权限列表</MenuItem>
                            <MenuItem name="avatar.list">头像列表</MenuItem>
                        </Submenu>
                        <Submenu name="2">
                            <template slot="title">
                                <Icon type="ios-box"></Icon>
                                项目管理
                            </template>
                            <MenuItem name="project.create">新建项目</MenuItem>
                            <MenuItem name="project.list">项目列表</MenuItem>

                        </Submenu>
                        <MenuItem name="logout">
                            <Icon type="log-out"></Icon>
                            注销
                        </MenuItem>
                    </Menu>
                </Sider>
                <Layout :style="{padding: '0 24px'}">
                    <Breadcrumb class="layout-breadcrumb">
                        <BreadcrumbItem v-if="$route.name !== 'dashboard'" :to="{name: 'dashboard'}">控制台</BreadcrumbItem>
                        <BreadcrumbItem>{{ $route.meta.title }}</BreadcrumbItem>
                    </Breadcrumb>
                    <Content>
                        <router-view></router-view>
                    </Content>
                    <Footer class="layout-footer">2017-2018 &copy; iKouOu</Footer>
                </Layout>
            </Layout>

        </Layout>
    </div>
</template>

<style lang="sass">
@import './container.scss'
</style>

<script>
import { mapState } from 'vuex'
export default {
    data () {
        return {
            breadcrumbs: [{
                label: '控制台',
                name: 'dashboard'
            }, {
                label: this.$route.meta.title,
                name: this.$route.name
            }]
        }
    },
    computed: {
        ...mapState({
            user: state => state.user,
            routes: state => state.routes
        })
    },
    methods: {
        handleMenuSelect (name) {
            if (name === 'logout') {
                this.$store.commit('userLogout')
                name = 'login'
            }
            this.$router.push({name})
        },
        handleClickUserDropdown () {

        }
    }
}
</script>
