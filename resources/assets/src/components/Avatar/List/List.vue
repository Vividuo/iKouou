<template>
    <div class="avatar-list">
        <Card v-for="(item, key) in list" :key="key">
            <Tooltip :content="item.title">
                <Avatar :src="item.url" shape="square" size="large"/>
            </Tooltip>
        </Card>
    </div>
</template>

<style lang="scss">
.avatar-list {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 0 -12px;
    .ivu-card {
        margin: 12px;
        width: 128px;
    }
    .ivu-avatar {
        width: 100%;
        height: auto;
        img {
            display: block;
        }
    }
}
</style>
<script>
export default {
    data () {
        return {
            list: [
                {title: 'PI_Ana_Cute_Ana-min', url: '//test.ikouou.com/avatar/PI_Ana_Cute_Ana-min.png'},
                {title: 'PI_Ana_Face-min', url: '//test.ikouou.com/avatar/PI_Ana_Face-min.png'},
                {title: 'PI_Ana_Watcher-min', url: '//test.ikouou.com/avatar/PI_Ana_Watcher-min.png'},
                {title: 'PI_Ana_Wedjat-min', url: '//test.ikouou.com/avatar/PI_Ana_Wedjat-min.png'},
                {title: 'PI_Bastion_Cute_Bastion-min', url: '//test.ikouou.com/avatar/PI_Bastion_Cute_Bastion-min.png'},
                {title: 'PI_Bastion_Face-min', url: '//test.ikouou.com/avatar/PI_Bastion_Face-min.png'},
                {title: 'PI_Bastion_Ganymede-min', url: '//test.ikouou.com/avatar/PI_Bastion_Ganymede-min.png'},
                {title: 'PI_Bastion_Tank_Crossing-min', url: '//test.ikouou.com/avatar/PI_Bastion_Tank_Crossing-min.png'},

                {title: 'PI_D.Va_Bunny-min', url: '//test.ikouou.com/avatar/PI_D.Va_Bunny-min.png'},
                {title: 'PI_D.Va_Cute_D.Va-min', url: '//test.ikouou.com/avatar/PI_D.Va_Cute_D.Va-min.png'},
                {title: 'PI_D.Va_Face-min', url: '//test.ikouou.com/avatar/PI_D.Va_Face-min.png'},
                {title: 'PI_D.Va_Keychain-min', url: '//test.ikouou.com/avatar/PI_D.Va_Keychain-min.png'},
                {title: 'PI_Doomfist_Cute_Doomfist-min', url: '//test.ikouou.com/avatar/PI_Doomfist_Cute_Doomfist-min.png'},
                {title: 'PI_Doomfist_Face-min', url: '//test.ikouou.com/avatar/PI_Doomfist_Face-min.png'},
                {title: 'PI_Doomfist_Fist-min', url: '//test.ikouou.com/avatar/PI_Doomfist_Fist-min.png'},
                {title: 'PI_Doomfist_Initials-min', url: '//test.ikouou.com/avatar/PI_Doomfist_Initials-min.png'}
            ]
        }
    }
}
</script>
