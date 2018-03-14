<template>
    <Row :gutter="12">
        <Col span="18" >
            <Card>
                <Form ref="form" :model="form" :rules="rules" :label-width="100">
                    <FormItem label="邮箱：" prop="email">
                        <Input v-model="form.email" :placeholder="user.email"/>
                    </FormItem>
                    <FormItem label="手机：" prop="mobile">
                        <Input v-model="form.mobile" :placeholder="user.mobile"/>
                    </FormItem>
                    <FormItem label="头像：" prop="avatar">
                        <Avatars @on-change="handleAvatarChange"></Avatars>
                    </FormItem>
                </Form>
            </Card>
        </Col>
        <Col span="6">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">操作</h4>
                <Button type="primary" @click="handleSubmit">修改</Button>
            </Card>
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">角色</h4>
            </Card>
            <Card>
                <h4 slot="title">权限</h4>
                <Transfer
                    :data="source"
                    :target-keys="target"
                    :render-format="renderTransfer"
                    @on-change="handleAccessChange">
                </Transfer>
            </Card>
        </Col>

    </Row>
</template>
<script>
import {mapState} from 'vuex'
import api from '@/utils/api'
import Avatars from '../Avatars'
export default {
    components: {
        Avatars
    },
    computed: {
        ...mapState({
            user: state => state.user
        })
    },
    data () {
        return {
            source: [
                {key: 'test', title: '测试'},
                {key: 'avatar', title: '头像管理'}
            ],
            target: [],
            form: {
                email: '',
                mobile: '',
                avatar: ''
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
        renderTransfer (item) {
            return item.title
        },
        handleAccessChange (targetKeys, directions, moveKeys) {
            this.target = targetKeys
        },
        handleReset () {
            this.form = {
                email: '',
                mobile: '',
                avatar: ''
            }
        },
        handleAvatarChange (item) {
            this.form.avatar = item.url
        },
        handleSubmit () {
            this.$refs['form'].validate((valid) => {
                if (valid) {
                    api.post('/api/user/' + this.user.id + '/edit', {
                        email: this.form.email,
                        mobile: this.form.mobile,
                        avatar: this.form.avatar
                    }).then(data => {
                        this.$Message.success('修改成功！')
                        this.$store.commit('updateUser', data.result)
                        this.$router.push({name: 'dashboard'})
                    })
                }
            })
        }
    }
}
</script>
