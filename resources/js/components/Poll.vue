<template>
    <div>
        <div v-for="option in options" class="container-fluid" style="padding: 0; margin: 0; width:97%;">
            <div v-if="option" class="option mt-4">
                <div class="form-check form-check-inline">
                    <input v-if="showbuttons" :id="'input'+option.id" :value="option.id" name="options_id[]" class="form-check-input" :type="input_type">
                    <label :for="'input'+option.id" class="form-check-label">
                        {{ option.content }}
                    </label>
                </div>
                <!-- tttttt -->
                <div v-if="setprogressbars" class="progressContainer form-group">
                    <progressbar :style="[!option.responses ? {'color': 'black'} : {'color': 'white'}]" :id="option.id" :percentage="option.percentage" :responses="option.responses">
                    </progressbar>
                </div>
                <div v-if="!setprogressbars">
                    <hr>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Echo from "laravel-echo"

    export default {
        props: [
            'id', 'options', 'input_type', 'setprogressbars', 'showbuttons'
        ],
        mounted() {
            window.io = require('socket.io-client');
            window.Echo = new Echo({
                broadcaster: 'socket.io',
                host: "https://"+window.location.hostname + ':6001',
                wsHost: "https://"+window.location.hostname,
                wsPort: 6001,
                disableStats: true,
                enabledTransports: ['ws', 'wss'] // <- added this param
            });

            this.options = JSON.parse(this.options);

            if(this.setprogressbars === true) {
                this.updateProgessBars();
            }
        },
        methods: {
            isObject: function(obj) {
                return obj != null && obj.constructor.name === "Object";
            },
            updateProgessBars: function () {
                window.Echo.channel('poll.'+this.id)
                    .listen('Vote', (data) => {
                        var updatedOptions = data['options'];
                        for (let key in updatedOptions)
                        {
                            if(!this.isObject(updatedOptions[key])) {
                                return;
                            }

                            var e  = updatedOptions[key];
                            var pos = this.options.map(function(x) {return x.id; }).indexOf(e.id);

                            this.options[pos].responses = e.responses;
                            this.options[pos].percentage = e.percentage;

                            var totalresponses = 0;

                            for (var i = 0; i < this.options.length; i++) {
                                totalresponses += this.options[i].responses
                            }

                            this.options.forEach(function(option){
                                option.percentage = option.responses / totalresponses * 100;
                            });

                            var span = document.getElementById("totalresponses");
                            span.textContent = totalresponses;
                        }

                        // @TODO It's unclean and dirty. Need to create another method.

                        var visitor = data['visitor'];

                        // console.log(visitor);



                    });
            }
        }
    }
</script>

<style scoped>
    label {
        color: #232425;
        font-size: 1.15rem;
    }
    input {
        margin-top: 8px;
    }
</style>
