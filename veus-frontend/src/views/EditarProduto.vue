<template>
    <div>
        <Title title="Produtos" color="text-light"></Title>

        <div class="tabs-pills">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <router-link to="/produtos"><a class="nav-link">Produtos</a></router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/novo-produto"><a class="nav-link">Cadastrar novo produto</a></router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Editar produto</a>
                </li>
            </ul>
        </div>

        <div class="edit-form">
            <div class="row">
                <div class="col">
                    <!-- form user info -->
                    <div class="card">

                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Nome</label>
                                    <div class="col-lg-9">
                                        <input v-on:keydown.enter.prevent='enterPressed' class="form-control" type="text" v-model="nome">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Marca</label>
                                    <div class="col-lg-9">
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="marca">
                                            <option value="0">Selecione uma marca...</option>
                                            <option v-for="item in listamarcas" :value="item.id">{{ item.nome }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Quantidade</label>
                                    <div class="col-lg-9">
                                        <input v-on:keydown.enter.prevent='enterPressed' class="form-control" type="number" v-model="qtde">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Preço (R$)</label>
                                    <div class="col-lg-9">
                                        <input v-on:keydown.enter.prevent='enterPressed' class="form-control" type="text" v-model="preco">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col">
                                        <input type="button" v-on:click="alterar()" class="btn btn-primary float-right" value="Alterar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Vue from 'vue'
    import Title from '../components/title.vue'
    import {HTTP} from '../js/domain'

    export default {
        name: 'EditarProduto',
        components: {
            Title,
        },
        data(){
            return {
                id: this.$route.params.id,
                nome: '',
                marca: 0,
                qtde: 0,
                preco: 0,
                listamarcas: []
            }
        },
        watch:{
            qtde () {
                if (this.qtde < 0) {
                    this.qtde = 0;
                }
            },
        },
        methods: {
            getMarcas(){
                HTTP.get('api/v1/marcas')
                    .then(response => {
                        Vue.set(this, 'listamarcas', response.data)
                        this.getProduct()
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
            getProduct(){
                let id = this.id
                HTTP
                    .get('api/v1/products/'+id+'/edit')
                    .then(response => {
                        this.nome = response.data.nome
                        this.marca = response.data.marcas_id
                        this.qtde = response.data.qtde
                        this.preco = this.formatPrice(response.data.preco)
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
            alterar(){
                let id = this.id

                HTTP
                    .put('api/v1/products/'+id,{
                        nome: this.nome,
                        marcas_id: this.marca,
                        qtde: this.qtde,
                        preco: this.preco.replace(',','.')
                    })
                    .then(response => {
                        this.$router.push('/produtos');
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
            goToProdutos(){
                this.$router.push('/produtos')
            },
            enterPressed: function(e)
            {

                if(e) e.preventDefault();
            }
        },
        mounted() {
            this.getMarcas()
        }
    }
</script>

<style>
    .tabs-pills{
        margin-top: 100px;
    }
    .edit-form{
        margin: 30px 0 30px;
    }
</style>