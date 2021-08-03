<template>
  <div>
    <Navbar />
    <div class="container">
      <!-- Display Pokemons -->
      <div v-if="currentRoute === 'Home'">
        <Home />
      </div>
      <div v-else-if="currentRoute === 'Profile'">
        <Profile />
      </div>
      <div v-else>
        <Trainer />
      </div>
    </div>
  </div>
</template>

<script>
  import Navbar from './Navbar.vue'
  import Home from './Home.vue'
  import Profile from './Profile.vue'
  import Trainer from './Trainer.vue'

  export default {
    name: 'Base',
    components: {
      Navbar,
      Home,
      Profile,
      Trainer
    },
    data () {
      return {
        currentRoute: this.$route.name,
        userToken: localStorage.getItem('userToken'),
      }
    },
    mounted () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.userToken}` 
    }
  }
</script>
