<template>
<div>
    <Card>
        <Form ref="form" :label-width="80">
            <FormItem label="图标：" prop="fid">
                <Upload ref="upload" :action="uploadPath" :with-credentials="true" :headers="headers" :on-error="handleUploadError" :on-success="handleUploadSuccess">
                    <Button type="ghost" icon="ios-cloud-upload-outline">Upload files</Button>
                </Upload>
            </FormItem>
        </Form>
        <form :action="uploadPath" method="post" enctype="multipart/form-data">
            <input type="file" name="file"/>
            <input type="hidden" name="_token" :value="$store.state.app.token" />
            <input type="submit" value="提交" />
        </form>
    </Card>
</div>
</template>
<script>
export default {
    data () {
        return {
            uploadPath: process.env.NODE_ENV === 'development' ? 'http://test.ikouou.com/api/excel/upload' : '/api/excel/upload',
            headers: {
                'X-CSRF-TOKEN': this.$store.state.app.token
            }
        }
    },
    methods: {
        handleUploadError () {
            this.$Message.error('上传失败！')
        },
        handleUploadSuccess (res) {
            // this.form.fid = res.result.id
        }
    }
}
</script>
