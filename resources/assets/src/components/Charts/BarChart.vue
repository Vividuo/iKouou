<template>
    <div ref="chart" style="height:400px;"></div>
</template>
<script>
import echarts from 'echarts'
export default {
    mounted () {
        let option = {
            title: {
                show: false,
                padding: 0,
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            // grid: [
            //     {x: '5%', y: '5%'},
            // ],
            xAxis: {
                data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        }
        this.$nextTick(() => {
            let chart = echarts.init(this.$refs['chart'])
            chart.setOption(option)
        })
    }
}
</script>
