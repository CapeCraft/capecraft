<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.2.2/moment-duration-format.min.js"></script>
<div id="app" class="content col-sm-8">
  <h1 class="text-center">Presidential Election</h1>
  <hr>
  <div v-if="preElection" class="row justify-content-center text-center">
    <div class="col-sm-3">
      <img :src='"https://crafatar.com/avatars/" + candidates[0] + "?size=100&helm"'>
    </div>
    <div class="col-sm-1">
      <h1 class="mt-3">VS</h1>
    </div>
    <div class="col-sm-3">
      <img :src='"https://crafatar.com/avatars/" + candidates[1] + "?size=100&helm"'>
    </div>
  </div>
  <div v-else class="text-center">
    <img :src='"https://crafatar.com/avatars/" + resultData.uuid + "?size=100&helm"'>
  </div>
  <hr>
  <div class="text-center">
    <h3>Your next CapeCraft President is...</h3>
    <h1>{{ result }}</h1>
  </div>
</div>
<script>
var app = new Vue({
  el: '#app',
  data: {
    candidates: [],
    preElection: true,
    result: 0,
    resultData: []
  },
  created: function() {
    this.getCandidates();
    setInterval(this.getResults, 1000)
  },
  methods: {
    getCandidates: function() {
      axios.get('/api/election&checkElection')
      .then(response => {
        this.candidates = response.data;
      });
    },
    getResults: function() {
      axios.get('/api/election&getResults')
      .then(response => {
        if(!response.data.electionFinished) {
          this.preElection = true;
          this.result = moment.duration(response.data.timeLeft, 'seconds').format("hh:mm:ss");
        } else {
          this.resultData = response.data;
          if(response.data.isDraw) {
            this.result = "It's a draw!"
          } else {
            this.result = response.data.username;
            this.preElection = false;
          }
        }
      });
    }
  }
})
</script>
