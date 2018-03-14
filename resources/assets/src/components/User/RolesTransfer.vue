<template>
    <Transfer
        :data="source"
        :target-keys="target"
        :titles="['所有角色', '当前角色']"
        :render-format="renderFormat"
        filterable
        filter-placeholder="查询角色"
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
            this.target = val.roles.map(item => {
                return item.id
            })
        }
    },
    mounted () {
        api.get('/api/role/list', {
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
