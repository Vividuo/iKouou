<template>
    <div>
        <Table border :columns="columns" :data="data" :style="{marginBottom: '12px'}"></Table>
        <Page :current="pager.current" :total="pager.total" :page-size="pager.size" @on-change="handlePagerChange"></Page>
    </div>
</template>
<script>
import api from '@/utils/api'
import Operations from './Operations.vue'
export default {
    components: {
        Operations
    },
    data () {
        return {
            columns: [{
                width: 64,
                render (h, {row}) {
                    return h('Avatar', {
                        props: {
                            src: row.avatar
                        }
                    })
                }
            }, {
                title: '用户名',
                key: 'username'
            }, {
                title: '手机号',
                key: 'mobile'
            }, {
                title: '邮箱',
                key: 'email'
            }, {
                title: '角色',
                render (h, {row}) {
                    let tags = []
                    row.roles.forEach(role => {
                        tags.push(h('Tag', [role.title]))
                    })
                    return h('div', tags)
                }
            }, {
                title: '操作',
                render (h, {row}) {
                    return h(Operations, {
                        props: {
                            user: row
                        }
                    })
                }
            }],
            data: [],
            pager: {
                total: 0,
                current: 1,
                size: 10
            }
        }
    },
    methods: {
        handlePagerChange (page) {
            this.pager.current = page
            this.fetchData()
        },
        fetchData () {
            api.get('/api/user/list', {
                page: this.pager.current,
                size: this.pager.size
            }).then(data => {
                this.data = data.result.data
                this.pager.total = data.result.total
            })
        }
    },
    mounted () {
        this.fetchData()
    }
}
</script>
