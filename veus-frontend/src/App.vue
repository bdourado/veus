<template>
  <div id="app">
    <!--<div id="nav">
      <router-link to="/">login</router-link> | 
      <router-link to="/signup">Criar conta</router-link>    
    </div>-->
  
    <div class="container-fluid">

      <router-view/>

    </div>
  </div>
</template>


<script>
import Login from './views/Login.vue'
import Signup from './views/Signup.vue'
import Produtos from './views/Produtos.vue'
import NovoProduto from './views/NovoProduto.vue'
import Title from './components/title.vue'

export default {
  name: 'app',
  components: {
    Login,
    Signup,
    Produtos,
    NovoProduto,
    Title
  }
}
</script>