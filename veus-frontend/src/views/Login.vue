<template>
  <div>
    <h2>Login Page</h2>
    <form>
      <div>
          <input placeholder="Your email" type="email" v-model="email">
      </div>
      <div>
          <input placeholder="Password" type="password" v-model="password">
      </div>
      <div>
          <button type="button" v-on:click="login()">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
  import {HTTP} from '../js/domain'

  export default {
    name: 'Login',
    data(){
      return {
        email : "",
        password : ""
      }
    },
    methods: {
      login: function () {
        let email = this.email 
        let password = this.password

        HTTP
        .post('api/v1/auth/login',{
            email: email,
            password: password
        })
        .then(function (response) {
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error);
        });
        return false;
        this.$store.dispatch('login', { email, password }).then(() => this.$router.push('/'))
        
      }
    }
  }
</script>
