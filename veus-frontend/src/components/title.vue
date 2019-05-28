<template>
    <div>
        <nav class="navbar header-top fixed-top navbar-dark bg-dark">
            <div class="float-left">
                <h1 :class="color">{{ title }}</h1>
            </div>
            <div class="float-right">
                <button type="button" class="btn btn-link text-light" v-on:click="logout()">Sair</button>
            </div>
        </nav>
    </div>
</template>

<script>
    import {HTTP} from '../js/domain'
    export default {
        name: 'Title',
        props: ['title','color'],
        data () {
            return {

            }
        },
        methods:{
            logout(){
                localStorage.clear();
                this.$router.push('/');
            },
            verificaLogin(){
                let self = this
                HTTP.post('api/v1/auth/me')
                    .then(response => {

                    })
                    .catch(function (error) {
                        self.$router.push('/')
                    })
            },
        },
        mounted (){
            this.verificaLogin()
        }
    }
</script>