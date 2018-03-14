<template>
    <Transfer
        :data="source"
        :target-keys="target"
        :titles="['所有权限', '当前权限']"
        :render-format="renderFormat"
        filterable
        filter-placeholder="查询权限"
        :filter-method="handleFilter"
        @on-change="handleChange">
    </Transfer>
</template>
<script>
import api from '@/utils/api'
export default {
    data () {
        return {
            source: [],
            target: []
        }
    },
    props: {
        user: Object
    },
    methods: {
        renderFormat (item) {
            return item.title
        },
        handleFilter (data, query) {
            return query !== '' ? (data.title === query || data.slug === query) : true
        },
        handleChange (targetKeys) {
            this.target = targetKeys
            this.$emit('on-change', this.target)
        }
    },
    watch: {
        user (val) {
            this.target = val.accesses.map(item => {
                return item.id
            })
        }
    },
    mounted () {
        api.get('/api/access/list', {
            size: -1
        }).then(data => {
            this.source = data.result.map(item => {
                return {
                    title: item.title,
                    slug: item.slug,
                    key: item.id
                }
            })
        })
    }
}
</script>
