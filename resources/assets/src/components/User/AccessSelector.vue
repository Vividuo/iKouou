<template>
    <Select
        v-model="accesses"
        :label="labels"
        placeholder="选择权限"
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
            accesses: [],
            labels: [],
            loading: false,
            options: []
        }
    },
    props: {
        defaultAccesses: {
            type: Array,
            default () {
                return []
            }
        }
    },
    watch: {
        defaultAccesses (val) {
            val.forEach(access => {
                this.accesses.push(access.id)
                this.labels.push(access.title)
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
                api.get('/api/access/list', {
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
        this.defaultAccesses.forEach(access => {
            this.accesses.push(access.id)
            this.labels.push(access.title)
        })
    }
}
</script>
