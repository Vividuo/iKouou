<template>
    <Row :gutter="12" >
        <Col span="18" >
            <Card>
                <Form ref="form" :model="form" :rules="rules" :label-width="80">
                    <FormItem label="标题：" prop="title">
                        <Input v-model="form.title" placeholder="请输入头像标题..." />
                    </FormItem>
                    <FormItem label="图标：" prop="fid">
                        <Upload ref="upload" :action="uploadPath" :with-credentials="true" :headers="headers" :on-error="handleUploadError" :on-success="handleUploadSuccess">
                            <Button type="ghost" icon="ios-cloud-upload-outline">Upload files</Button>
                        </Upload>
                    </FormItem>
                </Form>
            </Card>
        </Col>
        <Col span="6">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">发布</h4>
                <Button type="primary" @click="handleSubmit">发布</Button>
            </Card>
            <Card>
                <h4 slot="title">标签</h4>
            </Card>
        </Col>
    </Row>
</template>
<script>
import api from '@/utils/api'
export default {
    data () {
        return {
            uploadPath: process.env.NODE_ENV === 'development' ? 'http://test.ikouou.com/api/file/upload' : '/api/file/upload',
            form: {
                title: '',
                fid: ''
            },
            rules: {
                title: [
                    {required: true, message: '标题是必填项', trigger: 'blur'}
                ],
                fid: [
                    {type: 'number', required: true, message: '请上传图片', trigger: 'blur'}
                ]
            },
            headers: {
                'X-CSRF-TOKEN': this.$store.state.app.token
            }
        }
    },
    methods: {
        handleReset () {
            this.form = {
                title: '',
                fid: ''
            }
            this.$refs['upload'].clearFiles()
        },
        handleUploadError () {
            this.$Message.error('上传失败！')
        },
        handleUploadSuccess (res) {
            this.form.fid = res.result.id
            console.log('success', this.form, res.result.id)
        },
        handleSubmit () {
            this.$refs['form'].validate((valid) => {
                if (valid) {
                    api.post('/api/avatar/add', {
                        title: this.form.title,
                        fid: this.form.fid
                        // username: this.form.username,
                        // password: this.form.password,
                        // email: this.form.email,
                        // mobile: this.form.mobile
                    }).then(data => {
                        this.$Message.success('添加成功！')
                        this.handleReset()
                    })
                }
            })
        }
    }
}
</script>
