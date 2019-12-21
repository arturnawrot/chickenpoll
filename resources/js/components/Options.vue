<template>
    <div>
        <div v-for="option in options">
            <div v-if="option" class="option mt-4">
                <div class="form-check">
                    <input :id="'input'+option.id" :value="option.id" name="options_id[]" class="form-check-input" :type="input_type">
                    <label :for="option.id" class="form-check-label">
                        {{ option.content }}
                    </label>
                </div>
                <div class="mt-3 progress" style="padding-left:0;height: 45px;">
                    <progressbar :style="[!option.votes ? {'color': 'black', 'margin-left': '20px'} : {'color': 'white'}]" :id="option.id" :percentage="option.percentage" :votes="option.votes">
                    </progressbar>
                    <div class="progress-bar per px-2">
                        {{ Math.round(option.percentage * 10) / 10 }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'id', 'options', 'input_type'
        ],
        mounted() {
            function isObject(obj)
            {
                return obj != null && obj.constructor.name === "Object";
            }

            this.options = JSON.parse(this.options);

            window.Echo.channel('poll.'+this.id)
            .listen('Vote', (updatedOptions) => {
                for (let key in updatedOptions)
                {
                    if(!isObject(updatedOptions[key])) {
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