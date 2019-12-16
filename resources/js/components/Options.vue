<template>
    <div>
        <div v-for="option in options">
            <div v-if="option" class="option mt-4">
                <div class="form-check">
                    <input :id="option.id" :value="option.id" name="option_id" class="form-check-input" type="radio">
                    <label :for="option.id" class="form-check-label">
                        {{ option.content }}
                    </label>
                </div>
                <div class="mt-2 progress" style="padding-left:0;height: 45px;">
                    <progressbar :id="option.id" :percentage="option.percentage" :votes="option.votes">
                    </progressbar>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'id', 'options'
        ],
        created() {
            this.options = JSON.parse(this.options);

            window.Echo.channel('poll.'+this.id)
            .listen('Vote', (e) => {
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
            });
        }
    }
</script>