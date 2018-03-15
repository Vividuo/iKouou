<template>
<div class="page">
    <Row :gutter="10" >
        <Col :md="24" :lg="8">
            <Row :gutter="10">
                <Col :md="12" :lg="24" :style="{marginBottom: '10px'}">
                    <Card>
                        <Row type="flex" class="user-infor">
                            <Col span="8">
                                <Row class-name="made-child-con-middle" type="flex" align="middle">
                                    <img class="avator-img" :src="user.avatar" />
                                </Row>
                            </Col>
                            <Col span="16" style="padding-left:6px;">
                                <Row class-name="made-child-con-middle" type="flex" align="middle">
                                    <div>
                                        <b class="card-user-infor-name">{{ user.name }}</b>
                                        <p>super admin</p>
                                    </div>
                                </Row>
                            </Col>
                        </Row>
                        <div class="line-gray"></div>
                        <Row class="margin-top-8">
                            <Col span="8"><p class="notwrap">上次登录时间:</p></Col>
                            <Col span="16" class="padding-left-8">2017.09.12-13:32:20</Col>
                        </Row>
                        <Row class="margin-top-8">
                            <Col span="8"><p class="notwrap">上次登录地点:</p></Col>
                            <Col span="16" class="padding-left-8">北京</Col>
                        </Row>
                    </Card>
                </Col>
                <Col :md="12" :lg="24" :style="{marginBottom: '10px'}">
                    <Card>
                        <p slot="title">
                            <Icon type="android-checkbox-outline"></Icon>
                            待办事项
                        </p>
                        <a type="text" slot="extra">
                            <Icon type="plus-round"></Icon>
                        </a>
                        <div>
                            <div v-for="(item, index) in toDoList" :key="'todo-item' + (toDoList.length - index)" class="to-do-item">
                                {{ item.title }}
                            </div>
                        </div>
                    </Card>
                </Col>
            </Row>
        </Col>
        <Col :md="24" :lg="16" :style="{marginBottom: '10px'}">
            <Card :padding="0">
                <p slot="title">
                    <Icon type="map"></Icon>
                    今日服务调用地理分布
                </p>
            </Card>
        </Col>
    </Row>
    <Row :gutter="10">
        <Col :md="24" :lg="8" :style="{marginBottom: '10px'}">
            <Card>
                <p slot="title">
                    <Icon type="android-map"></Icon>
                    上周每日来访量统计
                </p>
            </Card>
        </Col>
        <Col :md="24" :lg="8" :style="{marginBottom: '10px'}">
            <Card>
                <p slot="title">
                    <Icon type="ios-pulse-strong"></Icon>
                    数据来源统计
                </p>
            </Card>
        </Col>
        <Col :md="24" :lg="8" :style="{marginBottom: '10px'}">
            <Card>
                <p slot="title">
                    <Icon type="android-wifi"></Icon>
                    各类用户服务调用变化统计
                </p>
            </Card>
        </Col>
    </Row>
</div>
</template>

<script>
// import './dashboard.scss'
import { mapState } from 'vuex'
export default {
    data () {
        return {
            toDoList: [
                {
                    title: '去iView官网学习完整的iView组件'
                },
                {
                    title: '去iView官网学习完整的iView组件'
                },
                {
                    title: '去iView官网学习完整的iView组件'
                },
                {
                    title: '去iView官网学习完整的iView组件'
                },
                {
                    title: '去iView官网学习完整的iView组件'
                }
            ]
        }
    },
    computed: {
        ...mapState({
            user: state => state.user
        })
    },
    methods: {
        handleClick () {
            let arr = [1, 2, 3]
            arr = arr.map(item => {
                return item + 1
            })
            console.log(...arr)
        }
    }
}
</script>
