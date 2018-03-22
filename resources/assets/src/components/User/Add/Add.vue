<template>
    <Row :gutter="12">
        <Col span="16" >
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">基本信息</h4>
                <Form ref="form" :model="form" :rules="rules" :label-width="100">
                    <FormItem label="用户名：" prop="username">
                        <Input v-model="form.username" placeholder="字母开头的4至12位字母数字和下划线"/>
                    </FormItem>
                    <FormItem label="密码：" prop="password">
                        <Input type="password" v-model="form.password" placeholder="6至16位字母或数字"/>
                    </FormItem>
                    <FormItem label="确认密码：" prop="passwordConfirm">
                        <Input type="password" v-model="form.passwordConfirm" placeholder="再输一次密码"/>
                    </FormItem>
                    <FormItem label="邮箱：" prop="email">
                        <Input v-model="form.email" placeholder="请输入联系邮箱"/>
                    </FormItem>
                    <FormItem label="手机：" prop="mobile">
                        <Input v-model="form.mobile" placeholder="请输入联系手机号"/>
                    </FormItem>
                </Form>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">头像</h4>
                <Avatar-Selector @on-change="handleAvatarChange"></Avatar-Selector>
            </Card>
        </Col>
        <Col span="8">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">角色</h4>
                <RoleSelector @on-change="handleRolesChange"></RoleSelector>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">权限</h4>
                <AccessSelector @on-change="handleAccessesChange"></AccessSelector>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">发布</h4>
                <Button type="primary" @click="handleSubmit">发布</Button>
            </Card>

        </Col>
    </Row>
</template>
<script>
import api from '@/utils/api'
import AvatarSelector from '@/components/Widgets/AvatarSelector'
import RoleSelector from '@/components/Widgets/RoleSelector'
import AccessSelector from '@/components/Widgets/AccessSelector'
export default {
    components: {
        AvatarSelector,
        RoleSelector,
        AccessSelector
    },
    data () {
        const validatePasswordConfirm = (rule, value, callback) => {
            if (value !== this.form.password) {
                callback(new Error('两次输入密码不一致!'))
            } else {
                callback()
            }
        }
        return {
            form: {
                username: '',
                password: '',
                passwordConfirm: '',
                email: '',
                mobile: '',
                avatar: ''
            },

            rules: {
                username: [
                    { required: true, message: '账号是必填项', trigger: 'blur' },
                    { pattern: /^[a-zA-z]\w{4,12}$/, message: '账号格式不正确', trigger: 'blur' }
                ],
                email: [
                    { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
                ],
                mobile: [
                    { pattern: /^1[3|4|5|7|8][0-9]{9}$/, message: '手机号格式不正确', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: '密码是必填项', trigger: 'blur' },
                    { pattern: /^[a-zA-z\d]{6,12}$/, message: '密码格式不正确', trigger: 'blur' }
                ],
                passwordConfirm: [
                    { required: true, message: '再输一次密码', trigger: 'blur' },
                    { validator: validatePasswordConfirm, trigger: 'blur' }
                ]
            }
        }
    },
    methods: {
        handleReset () {
            this.form = {
                username: '',
                email: '',
                mobile: '',
                avatar: '',
                password: '',
                passwordConfirm: ''
            }
        },
        handleAvatarChange (item) {
            this.form.avatar = item.url
        },
        handleRolesChange (roles) {
            this.form.roles = roles
        },
        handleAccessesChange (accesses) {
            this.form.accesses = accesses
        },
        handleSubmit () {
            this.$refs['form'].validate((valid) => {
                if (valid) {
                    api.post('/api/user/add', {
                        username: this.form.username,
                        password: this.form.password,
                        email: this.form.email,
                        mobile: this.form.mobile,
                        avatar: this.form.avatar,
                        roles: this.form.roles,
                        accesses: this.form.accesses
                    }).then(data => {
                        this.$Message.success('添加成功！')
                        this.$router.push({name: 'user.list'})
                    })
                }
            })
        }
    }
}
</script>
