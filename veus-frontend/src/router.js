import  Vue  from  'vue'
import  Router  from  'vue-router'
import  Signup  from  './views/Signup.vue'
import  Login  from  './views/Login.vue'

Vue.use(Router)

export  default  new  Router({
    mode:  'history',
    base:  process.env.BASE_URL,
    routes: [
    {
        path:  '/',
        name:  'Login',
        component:  Login
    },
    {
        path:  '/signup',
        name:  'signup',
        component:  Signup
    }
    ]
})
