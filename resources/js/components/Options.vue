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
                    <progressbar :style="[!option.votes ? {'color': 'black'} : {'color': 'white'}]" :id="option.id" :percentage="option.percentage" :votes="option.votes">
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
    export default {
        props: [
            'id', 'options', 'input_type', 'setprogressbars', 'showbuttons'
        ],
        mounted() {
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
                    .listen('Vote', (updatedOptions) => {
                        for (let key in updatedOptions)
                        {
                            if(!this.isObject(updatedOptions[key])) {
                                return;
                            }

                            var e  = updatedOptions[key];
                            var pos = this.options.map(function(x) {return x.id; }).indexOf(e.id);

                            this.options[pos].votes = e.votes;
                            this.options[pos].percentage = e.percentage;

                            var totalVotes = 0;

                            for (var i = 0; i < this.options.length; i++) {
                                totalVotes += this.options[i].votes
                            }

                            this.options.forEach(function(option){
                                option.percentage = option.votes / totalVotes * 100;
                            });

                            var span = document.getElementById("totalVotes");
                            span.textContent = totalVotes;
                        }
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
