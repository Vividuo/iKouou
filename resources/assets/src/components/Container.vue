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
                <Sider>
                    <Main-Menu></Main-Menu>
                </Sider>
                <Layout>
                    <Content>
                        <Breadcrumb class="layout-breadcrumb">
                            <BreadcrumbItem v-if="$route.name !== 'dashboard'" :to="{name: 'dashboard'}">控制台</BreadcrumbItem>
                            <BreadcrumbItem>{{ $route.meta.title }}</BreadcrumbItem>
                        </Breadcrumb>
                        <router-view></router-view>
                    </Content>
                    <Footer class="layout-footer">2017-2018 &copy; iKouOu</Footer>
                </Layout>
            </Layout>
        </Layout>
    </div>
</template>

<script>
import './container.scss'
import { mapState } from 'vuex'
import api from '@/utils/api'
import MainMenu from './Widgets/MainMenu'
export default {
    components: {
        MainMenu
    },
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
</script>
