<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">login</router-link> | 
      <router-link to="/signup">Criar conta</router-link>    
    </div>
    <router-view/>
  </div>
</template>


<script>
import Login from './views/Login.vue'
import Signup from './views/Signup.vue'

export default {
  name: 'app',
  components: {
    Login,
    Signup
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
