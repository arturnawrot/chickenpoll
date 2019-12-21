<template>
    <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
        <span :style="{'color': color}">
            <div v-if="percentage > 8">{{votes}}<span v-if="votes > 1"> votes</span><span v-else>vote</span>
            </div>
            <div v-else>{{ votes }}</div>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'votes', 'color'],
    }
</script>

<style scoped>
span {
    margin-left: 1px;
}
</style>