<template>
    <div>
        <Title title="Produtos" color="text-light"></Title>
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

        <div class="create-form">
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
                                        <input type="button" v-on:click="cadastrar()" class="btn btn-primary float-right" value="Cadastrar">
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
        name: 'NovoProduto',
        components: {
            Title
        },
        data(){
            return {
                nome : "",
                marca : 0,
                qtde: 0,
                preco: "",
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
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
            cadastrar(){
                HTTP
                    .post('api/v1/products',{
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
    .create-form {
        margin: 30px 0 30px;
    }
</style>