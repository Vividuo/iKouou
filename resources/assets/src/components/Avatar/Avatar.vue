<template>
    <div>
        <User-Menu></User-Menu>
        <router-view></router-view>
    </div>
</template>
<script>
import UserMenu from '../Widgets/UserMenu'
export default {
    components: {
        UserMenu
    }
}
</script>
