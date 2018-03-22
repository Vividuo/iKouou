<template>
    <Card>
        <h4 slot="title">头像列表</h4>
        <router-link slot="extra" :to="{name: 'avatar.add'}">新增头像</router-link>
        <div class="avatar-list">
            <Card v-for="(item, key) in data" :key="key">
                <Tooltip :content="item.title">
                    <Avatar :src="item.url" shape="square" size="large"/>
                </Tooltip>
            </Card>
        </div>
        <Page :current="pager.current" :total="pager.total" :page-size="pager.size" @on-change="handlePagerChange"></Page>
    </Card>

</template>

<script>
import api from '@/utils/api'
export default {
    data () {
        return {
            data: [],
            pager: {
                total: 0,
                current: 1,
                size: 40
            }
        }
    },
    methods: {
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
