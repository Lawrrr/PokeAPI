<template>
  <div>
    <b-navbar toggleable="lg" type="dark">
      <b-navbar-brand href="/">PokeAPI</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="/">Pokemons</b-nav-item>
          <b-nav-item href="/trainers">Trainers</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right>
            <template #button-content>
              <b-icon icon="person-fill" />
            </template>
            <!-- Using 'button-content' slot -->
            <b-dropdown-item href="/profile">Profile</b-dropdown-item>
            <b-dropdown-item @click="logout">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Navbar',
    data () {
      return {
        userToken: localStorage.getItem('userToken')
      }
    },
    methods: {
      logout () {
        axios.post('/api/logout')
        .then((res) => {
          console.log('Logged out!')
          localStorage.removeItem('userToken')
          this.$router.push({ name: 'Login' })
        })
        .catch((err) => {
          console.log(err)
        })
      }
    }
}
</script>

<style>
  .navbar {
    background-color: #CC0000;
  }
</style>
