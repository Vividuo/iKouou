<template>
    <Row :gutter="12">
        <Col span="18" >
            <Card>
                <Form class="avatar-form" :model="form" :label-width="80">
                    <FormItem label="标题：">
                        <Input />
                    </FormItem>
                    <FormItem label="图标：">
                        <Upload action="//jsonplaceholder.typicode.com/posts/">
                            <Button type="ghost" icon="ios-cloud-upload-outline">Upload files</Button>
                        </Upload>
                    </FormItem>
                </Form>
            </Card>
        </Col>
        <Col span="6">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">发布</h4>
                <Button type="primary">发布</Button>
            </Card>
            <Card>
                <h4 slot="title">标签</h4>
            </Card>
        </Col>
    </Row>
</template>
<script>
export default {
    data () {
        return {
            form: {}
        }
    }
}
</script>
