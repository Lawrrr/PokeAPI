<template>
  <div>
    <Navbar />
    <div class="container">
      <!-- Display Pokemons -->
      <div v-if="currentRoute === 'Home'">
        <Home />
      </div>
    </div>
  </div>
</template>

<script>
  import Navbar from './Navbar.vue'
  import Home from './Home.vue'

  export default {
    name: 'Base',
    components: {
      Navbar,
      Home
    },
    data () {
      return {
        currentRoute: this.$route.name
      }
    }
  }
</script>
