<template>
  <div>
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <Title title="Produtos" color="text-light"></Title>
    </nav>
    <div class="tabs-pills">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <router-link to="/produtos"><a class="nav-link">Produtos</a></router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link active">Cadastrar novo produto</a>
        </li>
      </ul>
    </div>
  </div>

</template>

<script>
import Title from '../components/title.vue'

export default {
  name: 'NovoProduto',
  components: {
    Title
  },
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

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "http://localhost:8888/api/v1/auth/login",
        data: {
          email: this.email,
          password: this.password
        },
        success: function (response) {
          localStorage.setItem('token','Bearer '+ response.access_token);
          
        },
        error: function(error){
          console.log(error.statusText);
        }
      });
    }
  }
}
</script>
<style>
.tabs-pills{
  margin-top: 100px;
}
</style>