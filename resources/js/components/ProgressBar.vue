<template>
    <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
        <span :style="{'color': color}">
            {{ votes }} votes
        </span>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'votes', 'color']
    }
</script>

<style scoped>
span {
    margin-left: 20px;
}
</style>