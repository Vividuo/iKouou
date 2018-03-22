<template>
    <div>
        <div class="user-avatars">
            <Card v-for="(item, key) in data" :key="key" :class="{'active': item.id === selected}" @click.native="handleClick(item)">
                <Tooltip :content="item.title">
                    <Avatar :src="item.url" shape="square" size="large"/>
                </Tooltip>
            </Card>
        </div>
        <Page :current="pager.current" :total="pager.total" :page-size="pager.size" @on-change="handlePagerChange"></Page>
    </div>
</template>

<script>
import api from '@/utils/api'
export default {
    data () {
        return {
            selected: null,
            data: [],
            pager: {
                total: 0,
                current: 1,
                size: 24
            }
        }
    },
    methods: {
        handleClick (item) {
            this.selected = item.id
            this.$emit('on-change', item)
        },

        handlePagerChange (page) {
            this.pager.current = page
            this.fetchData()
        },
        fetchData () {
            api.get('/api/avatar/list', {
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
