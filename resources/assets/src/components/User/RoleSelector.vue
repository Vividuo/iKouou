<template>
    <Select
        v-model="roles"
        :label="labels"
        placeholder="选择角色"
        multiple
        filterable
        remote
        :remote-method="remote"
        :loading="loading"
        @on-change="handleChange">
        <Option v-for="(option, index) in options" :value="option.id" :key="index">{{ option.title }}</Option>
    </Select>
</template>
<script>
import api from '@/utils/api'
export default {
    timer: null,
    data () {
        return {
            roles: [],
            labels: [],
            loading: false,
            options: []
        }
    },
    props: {
        defaultRoles: Array
    },
    watch: {
        defaultRoles (val) {
            val.forEach(role => {
                this.roles.push(role.id)
                this.labels.push(role.title)
            })
        }
    },
    methods: {
        remote (query) {
            if (this.timer) {
                clearTimeout(this.timer)
            }
            this.loading = true
            this.timer = setTimeout(() => {
                api.get('/api/role/list', {
                    q: query
                }).then(data => {
                    this.loading = false
                    this.options = data.result.list
                })
            }, 500)
        },
        handleChange (options) {
            this.$emit('on-change', options)
        }
    },
    mounted () {

    }
}
</script>
