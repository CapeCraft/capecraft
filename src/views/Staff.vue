<template>
  <div class="content">
    <div v-if="this.loading" class="text-center">
      <h1><i class="fas fa-spinner fa-spin"></i> Loading...</h1>
    </div>
    <div v-else>
      <h1 class="text-center">Staff</h1>
      <hr />
      <div class="row">
        <div class="col">
          <div class="staff-group">
            <img class="img-fluid" src="https://crafatar.com/avatars/ba4161c03a42496c8ae07d13372f3371?helm=true">
            <div>
              <h2>{{this.staff['ba4161c03a42496c8ae07d13372f3371'].name}} <i class="fas fa-crown fa-xs" style="color:#DAA520"></i></h2>
              <strong>Founder</strong>
              <p>I am the founder of the server, I make all of the final decisions. Well, that's a lie. Dylan tells me what to do.</p>
              <p>I also made the <a href="https://minecraftcapes.co.uk" target="_blank">MinecraftCapes mod!</a></p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="staff-group">
            <img class="img-fluid" src="https://crafatar.com/avatars/617687afc8a846978e5c3ed53b7a335f?helm=true">
            <div>
              <h2>{{this.staff['617687afc8a846978e5c3ed53b7a335f'].name}}</h2>
              <strong>Founder</strong>
              <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="staff-group">
            <img class="img-fluid" src="https://crafatar.com/avatars/bf8b08a5714c46678f49efce56cb7dc5?helm=true">
            <div>
              <h2>{{this.staff['bf8b08a5714c46678f49efce56cb7dc5'].name}}</h2>
              <strong>Admin</strong>
              <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="staff-group">
            <img class="img-fluid" src="https://crafatar.com/avatars/58f1a83b425d4844823ffa04a201facd?helm=true">
            <div>
              <h2>{{this.staff['58f1a83b425d4844823ffa04a201facd'].name}}</h2>
              <strong>Admin</strong>
              <p>The Small yet mighty Admin! I pretty much just hangout with players and keep the community happy while laying down the hammer of justice on those who deserve it!</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="staff-group">
            <img class="img-fluid" src="https://crafatar.com/avatars/1c1e62b7fec14effa4dc9d3b97f6ded6?helm=true">
            <div>
              <h2>{{this.staff['1c1e62b7fec14effa4dc9d3b97f6ded6'].name}}</h2>
              <strong>Mod</strong>
              <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Staff',
    data() {
      return {
        loading: true,
        staff: []
      }
    },
    created() {
      let host = (this.$devMode) ? "http://192.168.129.3" : "https://capecraft.net";
      axios.get(host + '/admin/api/staff').then(response => {
        this.staff = response.data;
        this.loading = false;
      })
    }
  }
</script>

<style>
  .staff-group {
    display: inline-flex;
  }

  .staff-group > img {
    margin-right: 1vw;
  }
</style>
