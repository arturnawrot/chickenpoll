<template>
    <div class="progress-bar" role="progressbar" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100" :style="{'width': percentage + '%' }">
        <span style="margin-left: 20px; color: #363636">
            {{ votes }} votes
        </span>
    </div>
</template>

<script>
    export default {
        props: ['percentage', 'votes'],
        data() {
            return {

            }
        },
        methods: {

        },
        created() {
            console.log('Shortlenlink mounted.');
        },
    }
</script>