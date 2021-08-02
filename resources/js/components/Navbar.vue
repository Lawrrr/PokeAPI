<template>
  <div>
    <b-navbar toggleable="lg" type="dark">
      <b-navbar-brand to="/">PokeAPI</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item to="/">Pokemons</b-nav-item>
          <b-nav-item to="/trainers">Trainers</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" placeholder="Search Pokemon..."></b-form-input>
            <b-button size="sm" class="my-2 mr-2 my-sm-0 btn btn-success" type="submit">Search</b-button>
          </b-nav-form>
          <b-nav-item-dropdown right>
            <template #button-content>
              <em>User</em>
            </template>
            <!-- Using 'button-content' slot -->
            <b-dropdown-item to="/profile">Profile</b-dropdown-item>
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
    created () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.userToken}`
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
