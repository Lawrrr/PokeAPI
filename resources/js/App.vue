<template>
    <div id="app"> 
      <router-view> </router-view>
    </div>
</template>
 
<script>
  import Login from './components/LoginRegister/Login.vue';

  export default {
    name: 'App',
    components: {
      Login
    }
  }
</script>
