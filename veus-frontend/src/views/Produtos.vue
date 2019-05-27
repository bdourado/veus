<template>
  <div>
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <Title title="Produtos" color="text-light"></Title>
    </nav>
    <div class="tabs-pills">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link active">Produtos</a>
        </li>
        <li class="nav-item">
          <router-link to="/novo-produto"><a class="nav-link">Cadastrar novo produto</a></router-link>
        </li>
      </ul>
    </div>
    <div class="for">
      <ul v-for="item in listaprodutos" :key="item.id">
        <li>{{ item.nome }}</li>
      </ul>  
    </div>
  </div>

</template>

<script>
import Vue from 'vue'
import Title from '../components/title.vue'
import {HTTP} from '../js/domain'

export default {
  name: 'Produtos',
  components: {
    Title
  },
  data(){
    return {
      listaprodutos: []
    }
  },
  methods: {
    getProdutos: function () {
      let email = this.email 
      let password = this.password
      let token = localStorage.getItem('token');
      let listaprod = JSON.parse(localStorage.getItem('produtos'));
      Vue.set(this, 'listaprodutos', listaprod)

      HTTP
      .get('api/v1/products')
      .then(data => {
        console.log(data)
      })
      .catch(function (error) {
        console.log(error)
      })
    

      /*$.ajax({
        type: 'GET',
        //headers: {"Authorization": localStorage.getItem('token')},
        dataType: 'json',
        url: "http://localhost:8888/api/v1/products?token="+token,
        success: function (response) {
          console.log(response.data);
          localStorage.setItem('produtos',JSON.stringify(response.data));
          Vue.set(this, 'listaprodutos', response.data)
        },
        error: function(error){
          console.log(error.statusText);
        }
      });*/
    }
  },
  mounted () {
    this.getProdutos();
  }
}
</script>
<style>
.tabs-pills{
  margin-top: 100px;
}
</style>