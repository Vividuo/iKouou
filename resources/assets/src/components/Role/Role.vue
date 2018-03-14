<template>
    <Row class="page" :gutter="12">
        <Col span="16" >
            <Table border :columns="columns" :data="list" :style="{marginBottom: '12px'}"></Table>
            <Page :current="pager.current" :total="pager.total" :page-size="pager.size" @on-change="handlePagerChange"></Page>
        </Col>
        <Col span="8">
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">新增角色</h4>
                <Form ref="add-form" :model="addForm" :rules="rules" :label-width="70">
                    <FormItem label="名称：" prop="title">
                        <Input v-model="addForm.title" placeholder=""/>
                    </FormItem>
                    <FormItem label="标识符：" prop="slug">
                        <Input v-model="addForm.slug" placeholder=""/>
                    </FormItem>
                </Form>
                <Button type="primary" @click="handleAdd">新增</Button>
            </Card>
        </Col>
    </Row>
</template>
<script>
import api from '@/utils/api'
export default {
    data () {
        return {
            columns: [{
                title: '编号',
                key: 'id'
            }, {
                title: '名称',
                key: 'title'
            }, {
                title: '标识符',
                key: 'slug'
            }],
            list: [],
            pager: {
                total: 0,
                current: 1,
                size: 10
            },
            addForm: {
                title: '',
                slug: ''
            },
            rules: {
                title: [
                    {required: true, message: '标题是必填项', trigger: 'blur'}
                ],
                slug: [
                    {required: true, message: '标识符是必填项', trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        handleReset () {
            this.addForm = {
                title: '',
                slug: ''
            }
        },
        handleAdd () {
            this.$refs['add-form'].validate((valid) => {
                if (valid) {
                    api.post('/api/role/add', {
                        title: this.addForm.title,
                        slug: this.addForm.slug
                    }).then(list => {
                        this.$Message.success('添加成功！')
                        this.handleReset()
                        this.fetchData()
                    })
                }
            })
        },
        handlePagerChange (page) {
            this.pager.current = page
            this.fetchData()
        },
        fetchData () {
            api.get('/api/role/list', {
                page: this.pager.current,
                size: this.pager.size
            }).then(data => {
                this.list = data.result.list
                this.pager.total = data.result.total
            })
        }
    },
    mounted () {
        this.fetchData()
    }
}
</script>
