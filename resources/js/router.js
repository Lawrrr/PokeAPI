import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/Home'
import Login from './components/LoginRegister/Login'
import Register from './components/LoginRegister/Register'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name:  'Home',
      component: Home,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        guest: true
      }
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta: {
        guest: true
      }
    }
  ]
})
