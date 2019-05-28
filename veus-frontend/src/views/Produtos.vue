<template>
  <div>
    <Title title="Produtos" color="text-light"></Title>

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

    <div class="search">
      <form>
        <div class="form-row align-items-center" @keydown.enter.stop>
          <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputName">Pesquisar</label>
            <input v-on:keydown.enter.prevent='enterPressed' type="text" class="form-control" id="inlineFormInputName" placeholder="Pesquisa" v-model="searchword" >
          </div>
          <div class="col-sm-3 my-1">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="filter">
              <option value="0">Ordenar...</option>
              <option value="nome">Nome</option>
              <option value="marca">Marca</option>
              <option value="qtde">Qtde</option>
              <option value="preco">Preço</option>
            </select>
          </div>
          <div class="col-auto my-1">
            <button type="button" class="btn btn-primary" v-on:click="pesquisar()">Pesquisar</button>
          </div>
        </div>
      </form>
    </div>

    <div class="products">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Marca</th>
            <th scope="col">Qtde</th>
            <th scope="col">Preço</th>
            <th scope="col">Editar</th>
            <th scope="col">Deletar</th>
          </tr>
        </thead>
         <tbody>
          <tr v-for="item in listaprodutos" :key="item.id">
            <th scope="row">{{ item.id }}</th>
            <td>{{ item.nome }}</td>
            <td>{{ item.marca }}</td>
            <td>{{ item.qtde }}</td>
            <td>{{ formatPrice(item.preco) }}</td>
            <td><a href="javascript:void(0)" v-on:click="editar(item.id)" class="nav-link">Editar</a></td>
            <td><a href="javascript:void(0)" v-on:click="deletar(item.id)" class="nav-link">Deletar</a></td>
          </tr>
         </tbody>
      </table>
    </div>
    <div class="pagination" v-if="total > 1">
        <v-pagination 
          v-model="currentPage" 
          :page-count="total"
          :classes="bootstrapPaginationClasses"
          :labels="paginationAnchorTexts"></v-pagination>
    </div>
  </div>

</template>

<script>
import Vue from 'vue'
import Title from '../components/title.vue'
import {HTTP} from '../js/domain'
import vPagination from 'vue-plain-pagination'

export default {
  name: 'Produtos',
  components: {
    Title,
    vPagination
  },
  data(){
    return {
      listaprodutos: [],
      searchword: '',
      filter: '0',
      currentPage: 1,
      total: 0,
      bootstrapPaginationClasses: {
        ul: 'pagination',
        li: 'page-item',
        liActive: 'active',
        liDisable: 'disabled',
        button: 'page-link'  
      },paginationAnchorTexts: {
        first: 'Primeira',
        prev: 'Anterior',
        next: 'Próxima',
        last: 'Última'
      },

      
    }
  },
  watch: {
    currentPage () {
      let searchword = this.searchword
      let filter = this.filter
      this.getProdutos(this.currentPage,searchword,filter);
    },
  },
  methods: {
    getProdutos: function (page = 1, searchword = "", filter = "") {
      HTTP
      .get('api/v1/products?page='+page+'&q='+searchword+"&filter="+filter)
      .then(response => {
        
        this.currentPage = response.data.current_page
        this.total = response.data.last_page

        Vue.set(this, 'listaprodutos', response.data.data)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    formatPrice(value) {
      const val = Number(value.toString().replace(",", "."));
      if (!val) return '0,00';
      const valueString = val.toFixed(2).replace(".", ",");
      return valueString.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    pesquisar() {
      let searchword = this.searchword
      let filter = this.filter
      this.getProdutos(1,searchword,filter)
    },
    deletar(id) {
      HTTP
      .delete('api/v1/products/'+id)
      .then(response => {
        this.getProdutos(this.currentPage,this.searchword,this.filter)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    editar: function(id) {
      this.$router.push('/produto/editar/'+id);
    },
    enterPressed: function(e)
    {
      this.getProdutos(this.currentPage,this.searchword,this.filter)
      if(e) e.preventDefault();
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

.products, .search{
  margin: 30px 0;
}

</style>