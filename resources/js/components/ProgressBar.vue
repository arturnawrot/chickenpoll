<template>
    <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
        <span style="margin-left: 20px; color: white">
            {{ votes }} votes
        </span>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'votes'],
        mounted() {
            console.log('Progress bar mounted.')
        }
    }
</script>
