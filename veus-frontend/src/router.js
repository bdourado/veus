import  Vue  from  'vue'
import  Router  from  'vue-router'
import  Login  from  './views/Login.vue'
import  Produtos  from  './views/Produtos.vue'
import  NovoProduto  from  './views/NovoProduto.vue'
import  EditarProduto  from  './views/EditarProduto.vue'

Vue.use(Router)

export  default  new  Router({
    mode:  'history',
    routes: [
    {
        path:  '/',
        redirect: {name: 'Login'}
    },
    {
        path:  '/login',
        name:  'Login',
        component:  Login
    },
    {
        path:  '/produtos',
        name:  'produtos',
        component:  Produtos
    },
    {
        path:  '/novo-produto',
        name:  'novoProduto',
        component:  NovoProduto
    },
    {
        path:  '/produto/editar/:id',
        name:  'editarProduto',
        component:  EditarProduto
    }
    ]
})
