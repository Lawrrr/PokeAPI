<template>
  <div class="container">
    <div class="row">
      <div class="login-form">
        <form v-on:submit.prevent="login">
          <h2 class="text-center">PokeAPI Login</h2>

          <div class="form-group">
            <label for="email"> Email Address</label>
            <input 
              type="email" 
              v-model="formData.email" 
              class="form-control" 
              name="email" 
              placeholder="Email Address"
            >
          </div>

          <div class="form-group">
            <label for="password"> Password</label>
            <input 
              type="password" 
              v-model="formData.password" 
              class="form-control" 
              name="password" 
              placeholder="Password"
            >
          </div>

          <button class="btn btn-lg btn-primary btn-block">Sign in</button>
        </form>
        <p class="text-center"><router-link to="/register">Create an Account</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        formData: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      login () {
        axios.post('/api/login', this.formData)
        .then((res) => {
          localStorage.setItem('userToken', res.data.token)
          this.email = ''
          this.password = ''
          this.$router.push({ name: 'Home' })
        })
        .catch((err) => {
          console.log(err)
          alert("Incorrect email or password")
        })
      }
    }
  }
</script>

<style>
  @import url('./LoginRegister.css');
</style>
