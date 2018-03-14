<template>
    <div>
        <Button type="primary" size="small" @click="handleEdit">修改</Button>
        <Button type="error" size="small" @click="handleDel">删除</Button>
    </div>
</template>
<script>
export default {
    props: {
        user: Object
    },
    methods: {
        handleEdit () {
            this.$router.push({name: 'user.edit', params: {id: this.user.id}})
        },
        handleDel () {
            this.$Modal.confirm({
                title: '删除',
                content: '确认删除当前用户',
                onOk () {
                    console.log('confirm ok')
                }
            })
        }
    }
}
</script>
