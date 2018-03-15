<template>
    <Row class="page" :gutter="12">
        <Col span="16" >
            <Card :style="{marginBottom: '12px'}">
                <h4 slot="title">角色列表</h4>
                <Table border :columns="columns" :data="list" :style="{marginBottom: '12px'}"></Table>
                <Page :current="pager.current" :total="pager.total" :page-size="pager.size" @on-change="handlePagerChange"></Page>
            </Card>
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
import AccessSelector from '../User/AccessSelector'
import Operations from './Operations'
export default {
    components: {
        AccessSelector,
        Operations
    },
    data () {
        return {
            columns: [{
                title: '名称',
                key: 'title',
                render: (h, {row}) => {
                    let title = row.title
                    let input = h('Input', {
                        props: {
                            placeholder: row.title
                        },
                        on: {
                            input: function (val) {
                                row.editForm.title = val
                            }
                        }
                    })
                    return row.editable ? input : title
                }
            }, {
                title: '标识符',
                key: 'slug',
                render: (h, {row}) => {
                    let slug = row.slug
                    let input = h('Input', {
                        props: {
                            placeholder: row.slug
                        },
                        on: {
                            input: function (val) {
                                row.editForm.slug = val
                            }
                        }
                    })
                    return row.editable ? input : slug
                }
            }, {
                title: '权限',
                key: 'access',
                render: (h, {row}) => {
                    let tags = []
                    row.accesses.forEach(item => {
                        let tag = h('Tag', [item.title])
                        tags.push(tag)
                    })
                    let selector = h(AccessSelector, {
                        props: {
                            defaultAccesses: row.accesses
                        },
                        on: {
                            'on-change': function (options) {
                                row.editForm.accesses = options
                            }
                        }
                    })
                    return row.editable ? selector : tags
                }
            }, {
                title: '操作',
                width: 130,
                align: 'center',
                render: (h, {row}) => {
                    return h(Operations, {
                        props: {
                            item: row
                        },
                        on: {
                            'on-edit-submit': this.handleEditSubmit,
                            'on-edit-toggle': this.handleEditToggle
                        }
                    })
                }
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
        handleEditSubmit (row) {
            api.post('/api/role/' + row.id + '/edit', row.editForm).then(data => {
                this.$Message.success('修改成功！')
                this.list = this.list.map(item => {
                    if (item.id === row.id) {
                        item = data.result
                    }
                    return item
                })
            })
        },
        handleEditToggle (row) {
            this.list = this.list.map(item => {
                if (item.id === row.id) {
                    item.editable = !item.editable
                    item.editForm = {}
                }
                return item
            })
        },
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
