<template>
    <div>
        <span class="percentage">{{ Math.round(percentage * 10) / 10 }}%</span>
        <div class="mt-3 progress" style="padding-left:0;height: 45px;">
            <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
            <span :style="[percentage < 8 ? {'margin-left': '5px', 'color': color} : {'color': color}]" class="lol">
                <!-- <div v-if="percentage > 8">{{responses}}<span v-if="responses > 1"> responses</span><span v-else> vote</span>
                </div>
                <div v-else-if="percentage > 3">{{ responses }}</div> -->
                <span v-if="percentage != 0" class="yolo">
                    {{responses}}<span v-if="responses > 1 || responses === 0"> votes</span><span v-else> vote</span>
                </span>
            </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'responses', 'color'],
    }
</script>

<style scoped>
.lol {
    padding: 3px 0;
}
.yolo {
    color: #ffffff;
    background-color: #ff4480;
    padding: 3px 5px;
    border-radius: 5px;
    font-weight: 500;
}
</style>
