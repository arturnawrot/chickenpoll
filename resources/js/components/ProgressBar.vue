<template>
    <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
        <span :style="[percentage < 8 ? {'margin-left': '5px', 'color': color} : {'color': color}]" class="lol">
            <!-- <div v-if="percentage > 8">{{votes}}<span v-if="votes > 1"> votes</span><span v-else> vote</span>
            </div>
            <div v-else-if="percentage > 3">{{ votes }}</div> -->
            <span class="yolo">
                {{votes}}<span v-if="votes > 1 || votes === 0"> votes</span><span v-else> vote</span>
            </span>
        </span>
        <span class="percentage">{{ Math.round(percentage * 10) / 10 }}%</span>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'votes', 'color'],
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
}
</style>