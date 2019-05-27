<template>

  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4"></h3>
              
                <div class="form-label-group">
                  <input type="email" id="inputEmail" class="form-control" v-model="email" placeholder="Email address" required autofocus>
                  <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" v-model="password" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                </div>
                <button  v-on:click="login()" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign in</button>
             
            </div>
          </div>
        </div>
      </div>
    </div>
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
      .then(data => {
        console.log(data)
      })
      .catch(function (error) {
        console.log(error)
      })

      /*$.ajax({
        type: 'POST',
        dataType: 'json',
        url: "http://localhost:8888/api/v1/auth/login",
        data: {
          email: this.email,
          password: this.password
        },
        success: function (response) {
          //localStorage.setItem('token','Bearer '+ response.access_token);
          localStorage.setItem('token',response.access_token);
          location.replace('/produtos')
        },
        error: function(error){
          console.log(error.statusText);
        }
      });*/
    }
  }
}
</script>

<style>
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: 0.75rem;
}

.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('https://source.unsplash.com/WEQbe2jBg40/600x1200');
  background-size: cover;
  background-position: center;
}

.login-heading {
  font-weight: 300;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
  border-radius: 2rem;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
  height: auto;
  border-radius: 2rem;
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  cursor: text;
  /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

</style>