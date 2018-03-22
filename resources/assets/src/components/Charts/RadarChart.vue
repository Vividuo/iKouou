<template>
    <div ref="chart" style="height:400px;"></div>
</template>
<script>
import echarts from 'echarts'
export default {
    mounted () {
        this.$nextTick(() => {
            let chart = echarts.init(this.$refs['chart'])
            chart.setOption(option)
        })
        var dataBJ = [
            [52, 24, 60, 1.03, 50, 21, 30],
            [46, 5, 49, 0.28, 10, 6, 31]
        ]

        var lineStyle = {
            normal: {
                width: 1,
                opacity: 0.5
            }
        }

        let option = {
            backgroundColor: '#161627',
            title: {
                text: 'AQI - 雷达图',
                left: 'center',
                textStyle: {
                    color: '#eee'
                }
            },
            legend: {
                bottom: 5,
                data: ['北京', '上海', '广州'],
                itemGap: 20,
                textStyle: {
                    color: '#fff',
                    fontSize: 14
                },
                selectedMode: 'single'
            },
            visualMap: {
                show: true,
                min: 0,
                max: 20,
                dimension: 6,
                inRange: {
                    colorLightness: [0.5, 0.8]
                }
            },
            radar: {
                indicator: [
                    {name: 'AQI', max: 300},
                    {name: 'PM2.5', max: 250},
                    {name: 'PM10', max: 300},
                    {name: 'CO', max: 5},
                    {name: 'NO2', max: 200},
                    {name: 'SO2', max: 100}
                ],
                shape: 'circle',
                splitNumber: 5,
                name: {
                    textStyle: {
                        color: 'rgb(238, 197, 102)'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: [
                            'rgba(238, 197, 102, 0.1)', 'rgba(238, 197, 102, 0.2)',
                            'rgba(238, 197, 102, 0.4)', 'rgba(238, 197, 102, 0.6)',
                            'rgba(238, 197, 102, 0.8)', 'rgba(238, 197, 102, 1)'
                        ].reverse()
                    }
                },
                splitArea: {
                    show: false
                },
                axisLine: {
                    lineStyle: {
                        color: 'rgba(238, 197, 102, 0.5)'
                    }
                }
            },
            series: [
                {
                    name: '北京',
                    type: 'radar',
                    lineStyle: lineStyle,
                    data: dataBJ,
                    symbol: 'none',
                    itemStyle: {
                        normal: {
                            color: '#F9713C'
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.1
                        }
                    }
                }
            ]
        }
    }

}
</script>
