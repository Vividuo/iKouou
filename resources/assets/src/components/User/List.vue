<template>
<div class="page">
    <Card>
        <p slot="title">
            <Icon type="android-checkbox-outline"></Icon>
            用户列表
        </p>
        <a type="text" slot="extra">
            <Icon type="plus-round"></Icon>
        </a>
        <Table border :columns="columns" :data="data"></Table>
    </Card>
</div>
</template>
<script>
export default {
    data () {
        return {
            columns: [{
                title: '编号',
                key: 'id'
            }, {
                title: '用户名',
                key: 'username'
            }, {
                title: '手机号',
                key: 'mobile'
            }, {
                title: '角色',
                key: 'roles'
            }, {
                title: '操作'
            }],
            data: [
                {id: 1, username: 'root', mobile: '13701960700', roles: 'super admin'},
                {id: 2, username: 'root2', mobile: '13701960700', roles: 'super admin'},
                {id: 3, username: 'root3', mobile: '13701960700', roles: 'super admin'}
            ]
        }
    },
    mounted () {

    }
}
</script>
