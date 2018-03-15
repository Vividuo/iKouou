<template>
    <div class="layout">
        <Layout :style="{minHeight: '100vh'}">
            <Header>
                <Menu mode="horizontal" theme="dark" :active-name="$route.name">
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
                            <Dropdown @on-click="handleRedirect">
                                <Avatar :src="user.avatar" style="background: #619fe7;margin-left: 10px;"></Avatar>
                                {{ user.name }}
                                <Icon type="arrow-down-b"></Icon>
                                <DropdownMenu slot="list">
                                    <DropdownItem name="profile">修改个人资料</DropdownItem>
                                    <DropdownItem :disabled="true">修改密码</DropdownItem>
                                    <DropdownItem name="logout" :divided="true">注销</DropdownItem>
                                </DropdownMenu>
                            </Dropdown>
                        </MenuItem>
                    </div>
                </Menu>

            </Header>
            <Layout>
                <Sider >
                    <Menu :active-name="$route.name" theme="dark" width="auto" :open-names="[]" @on-select="handleRedirect">
                        <MenuItem name="dashboard">
                            <Icon type="home"></Icon>
                            控制台
                        </MenuItem>
                        <Submenu name="1">
                            <template slot="title">
                                <Icon type="person"></Icon>
                                账号相关
                            </template>
                            <MenuItem name="user.list">用户管理</MenuItem>
                            <MenuItem name="role">角色管理</MenuItem>
                            <MenuItem name="access">权限管理</MenuItem>
                            <MenuItem name="avatar.list">头像管理</MenuItem>
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

<script>
// import './container.scss'
import { mapState } from 'vuex'
import api from '@/utils/api'
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
        handleRedirect (name) {
            if (name === 'logout') {
                api.get('/api/logout')
                this.$store.commit('resetUser')
                name = 'login'
            }
            this.$router.push({name})
        },
        handleClickUserDropdown () {

        }
    }
}
</script>
