<template>
    <Row :gutter="12">
        <Col span="18" >
            <Form ref="form" :model="form" :rules="rules" :label-width="80">
                <Card :style="{marginBottom: '12px'}">
                    <h4 slot="title">基本信息</h4>
                    <FormItem label="账号：" prop="email">
                        <Input :value="user.username" disabled  />
                    </FormItem>
                    <FormItem label="邮箱：" prop="email">
                        <Input v-model="form.email" :placeholder="user.email"/>
                    </FormItem>
                    <FormItem label="手机：" prop="mobile">
                        <Input v-model="form.mobile" :placeholder="user.mobile"/>
                    </FormItem>
                </Card>
                <Card :style="{marginBottom: '12px'}">
                    <h4 slot="title">头像</h4>
                    <Avatar-Selector @on-change="handleAvatarChange"></Avatar-Selector>
                </Card>
            </Form>
        </Col>
        <Col span="6">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">角色</h4>
                <RoleSelector :default-roles="user.roles" @on-change="handleRolesChange"></RoleSelector>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">权限</h4>
                <AccessSelector :default-accesses="user.accesses" @on-change="handleAccessesChange"></AccessSelector>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">操作</h4>
                <Button type="primary" @click="handleSubmit">修改</Button>
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
        return {
            user: {
                email: '',
                mobile: ''
            },
            form: {
                email: '',
                mobile: ''
            },
            rules: {
                email: [
                    { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
                ],
                mobile: [
                    { pattern: /^1[3|4|5|7|8][0-9]{9}$/, message: '手机号格式不正确', trigger: 'blur' }
                ]
            }
        }
    },

    methods: {
        handleReset () {
            this.form = {
                email: '',
                mobile: '',
                avatar: '',
                accesses: []
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
                    api.post('/api/user/' + this.$route.params.id + '/edit', {
                        email: this.form.email,
                        mobile: this.form.mobile,
                        avatar: this.form.avatar,
                        accesses: this.form.accesses,
                        roles: this.form.roles
                    }).then(data => {
                        this.$Message.success('修改成功！')
                        this.$router.push({name: 'user.list'})
                    })
                }
            })
        }
    },
    mounted () {
        api.get('/api/user/' + this.$route.params.id + '/info').then(data => {
            this.user = data.result
        })
    }
}
</script>
