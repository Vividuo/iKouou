
<template>
    <div class="login" @keydown.enter="handleSubmit" @mousemove="handleMove" >
        <div class="login-bg" :style="bgStyles"></div>
        <div class="login-con">
            <Card :bordered="false">
                <p slot="title">
                    <Icon type="log-in"></Icon>
                    欢迎登录
                </p>
                <div class="form-con">
                    <Form ref="loginForm" :model="form" :rules="rules">
                        <FormItem prop="username">
                            <Input v-model="form.username" placeholder="请输入用户名">
                                <span slot="prepend">
                                    <Icon :size="16" type="person"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem prop="password">
                            <Input type="password" v-model="form.password" placeholder="请输入密码">
                                <span slot="prepend">
                                    <Icon :size="14" type="locked"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem>
                            <Button @click="handleSubmit" type="primary" long>登录</Button>
                        </FormItem>
                    </Form>
                    <p class="login-tip">输入任意用户名和密码即可</p>
                </div>
            </Card>
        </div>
    </div>
</template>

<style lang="sass">
@import './login.scss'
</style>

<script>
import api from '@/utils/api'
import avatar from '@/assets/avatar.png'
export default {
    data () {
        return {
            bgStyles: {

            },
            form: {
                username: '',
                password: ''
            },
            rules: {
                userName: [
                    { required: true, message: '账号不能为空', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: '密码不能为空', trigger: 'blur' }
                ]
            }
        }
    },
    methods: {
        handleMove (event) {
            let offset = {
                x: (event.pageX - window.innerWidth / 2) * 0.08,
                y: (event.pageY - window.innerHeight / 2) * 0.04
            }
            this.bgStyles = {
                transform: 'scale(1.2) translate3d(' + offset.x + 'px, ' + offset.y + 'px, 0)'
            }
        },
        handleSubmit () {
            this.$refs.loginForm.validate((valid) => {
                if (valid) {
                    this.handleLogin()
                }
            })
        },
        handleLogin () {
            let _this = this
            api.post('/api/login', {
                username: this.form.username,
                password: this.form.password
            }).then(data => {
                this.$store.commit('userLogin', {
                    name: data.result.username,
                    avatar
                })
                this.$Message.loading({
                    content: '登录成功',
                    duration: 1,
                    onClose () {
                        _this.$router.push({
                            name: 'dashboard'
                        })
                    }
                })
            }, error => {
                this.$Message.error({
                    content: '用户名或密码错误',
                    duration: 3
                })
            })
            // if (this.form.userName === 'root' && this.form.password === 'root') {
            //     this.$store.commit('userLogin', {
            //         name: this.form.userName,
            //         avatar
            //     })
            //
            // } else {
            //
            // }
        }
    }
}
</script>
