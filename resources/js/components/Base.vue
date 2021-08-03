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
    </div>
  </div>
</template>

<script>
  import Navbar from './Navbar.vue'
  import Home from './Home.vue'
  import Profile from './Profile.vue'

  export default {
    name: 'Base',
    components: {
      Navbar,
      Home,
      Profile
    },
    data () {
      return {
        currentRoute: this.$route.name
      }
    }
  }
</script>
