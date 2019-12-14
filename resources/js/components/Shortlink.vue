<template>
    <div>
        <div class="form-group">
            <label for="bitly">Auto-generated Bit.ly shortlink</label>
            <input id="bitly" class="col-md-5 form-control" type="text" v-model="url">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: null
            }
        },
        methods: {
            getUrl(url) {
                axios.post('api/shorten', {
                    url: url
                }).then((response) => {
                    console.log(response);
                    this.url = response.data;
                });
            }
        },
        created() {
            console.log('Shortlenlink mounted.');
            this.getUrl(window.location.href);
        },
    }
</script>
