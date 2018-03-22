<template>
<div>
    <Row :gutter="10" >
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">柱状图</p>
                <Bar-Chart></Bar-Chart>
            </Card>
        </Col>
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">折线图</p>
                <Line-Chart></Line-Chart>
            </Card>
        </Col>
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">饼图</p>
                <Pie-Chart></Pie-Chart>
            </Card>
        </Col>
    </Row>
    <Row :gutter="10" >
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">雷达图</p>
                <Radar-Chart></Radar-Chart>
            </Card>
        </Col>
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">折线图</p>

            </Card>
        </Col>
        <Col :md="24" :lg="8">
            <Card>
                <p slot="title">饼图</p>

            </Card>
        </Col>
    </Row>
</div>
</template>
<script>
import BarChart from './BarChart'
import LineChart from './LineChart'
import PieChart from './PieChart'
import RadarChart from './RadarChart'
export default {
    components: {
        BarChart,
        LineChart,
        PieChart,
        RadarChart
    },
    mounted () {

    }
}
</script>
