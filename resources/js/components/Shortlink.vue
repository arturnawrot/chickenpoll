<template>
    <div>
        <div class="form-group">
            <label for="bitly">Auto-generated Bit.ly shortlink</label>
            <input id="bitly" class="col-md-10 form-control" type="text" :value="url">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['slug'],
        data() {
            return {
                url: null
            }
        },
        methods: {
            getUrl(url) {
                axios.post('/api/shorten', {
                    url: url
                }).then((response) => {
                    this.url = response.data;
                });
            }
        },
        created() {
            this.getUrl(document.location.origin+"/"+this.slug);
        },
    }
</script>
