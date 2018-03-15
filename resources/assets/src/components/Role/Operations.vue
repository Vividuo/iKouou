<template>
    <div>
        <template v-if="item.editable">
            <Button type="primary" size="small" @click="handleSubmit">提交</Button>
            <Button size="small" @click="handleCancel">取消</Button>
        </template>
        <template v-else>
            <Button type="primary" size="small" @click="handleEdit">修改</Button>
            <Button type="error" size="small" @click="handleDel">删除</Button>
        </template>
    </div>
</template>
<script>
export default {
    props: {
        item: Object
    },
    methods: {
        handleSubmit () {
            this.$emit('on-edit-submit', this.item)
            this.$emit('on-edit-toggle', this.item)
        },
        handleCancel () {
            this.$emit('on-edit-toggle', this.item)
        },
        handleEdit () {
            this.$emit('on-edit-toggle', this.item)
        },
        handleDel () {
            this.$Modal.confirm({
                title: '删除',
                content: '确认删除角色"' + this.item.title + '"?',
                onOk () {
                    console.log('confirm ok')
                }
            })
        }
    }
}
</script>
