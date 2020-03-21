<template>
    <div id="chart">
        <apexchart type="pie" width="380" :options="chartOptions" :series="series"></apexchart>
    </div>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts'

    export default {
        props: [
            'labels', 'scores'
        ],
        mounted() {
          console.log(this.labels);
        },
        components: {
            apexchart: VueApexCharts,
        },
        data: function() {
            return {
                series: JSON.parse(this.scores),
                chartOptions: {
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: JSON.parse(this.labels),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                },
            }
        },
    }
</script>
