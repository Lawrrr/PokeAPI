<template>
  <div class="container">
    <div class="row">
      <div class="register-form">
        <form v-on:submit.prevent="register">
          <h2 class="text-center font-weight-normal">Registration Form</h2>

          <div class="form-group">
            <label for="username">Username</label>
            <input 
              v-model="formData.username" 
              class="form-control" 
              name="username" 
              placeholder="Enter your username..."
              required
              minlength="6"
            >
          </div>

          <div class="form-group">
            <label for="email"> Email Address</label>
            <input 
              v-model="formData.email" 
              type="email" 
              class="form-control" 
              name="email" 
              placeholder="Enter your email address..."
              required
            >
          </div>

          <div class="form-group">
            <label for="password"> Password</label>
            <input 
              v-model="formData.password" 
              type="password" 
              class="form-control" 
              name="password" 
              placeholder="Enter your password..."
              required
              minlength="8"
            >
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input 
              v-model="formData.password_confirmation" 
              type="password" 
              class="form-control" 
              name="password_confirmation" 
              placeholder="Re-enter your password..."
              required
              minlength="8"
            >
          </div>

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input 
              v-model="formData.first_name" 
              class="form-control" 
              name="first_name" 
              placeholder="Enter your first name..."
              required
            >
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input 
              v-model="formData.last_name" 
              class="form-control" 
              name="last_name" 
              placeholder="Enter your last name..."
              required
            >
          </div>

          <div class="form-group">
            <label for="date_of_birth">Birth Date</label><br />
              <date-picker 
                v-model="formData.date_of_birth"
                value-type="format"
                format="YYYY-MM-DD"
                placeholder="Select Date"
                required
              ></date-picker>
          </div>

          <button class="btn btn-lg btn-primary btn-block">Register</button>
        </form>
        <p><router-link to="/login">Return to Login Page</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import DatePicker from 'vue2-datepicker'
  import 'vue2-datepicker/index.css';

  export default {
    name: 'Register',
    components: {
      DatePicker
    },
    data() {
      return {
        formData: {
          username: '',
          first_name: '',
          last_name: '',
          email: '',
          password: '',
          password_confirmation: '',
          date_of_birth: new Date()
        }
      }
    },
    methods: {
      register () {
        if(this.password === this.password_confirmation) {
          axios.post('/api/register', this.formData)
          .then((res) => {
            localStorage.setItem('userToken', res.data.token)
            this.username = ''
            this.email = ''
            this.first_name = ''
            this.last_name = ''
            this.password = ''
            this.password_confirmation = ''
            this.date_of_birth = ''
            this.$router.push({ name: 'Home' })
          })
          .catch((err) => {
            console.log(err)
            alert('Registration not successful')
          })
        } else {
          alert('Password and confirm password must be identical')
        }
      },
    }
  }
</script>
