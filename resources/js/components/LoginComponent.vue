<template >
  <div style="display: flex; justify-content: center; align-items: center;font-family : 'Roboto'; " class="parent-div">
    <div class="custom-card">
      <div class="custom-card-header">
        <i class="fa fa-user-circle mr-3"></i>Login
      </div>
      <input placeholder="Email Address" type="email" v-model="user.username" class="form-control" />
      <input placeholder="Password" type="password" v-model="user.password" class="form-control mt-2" />

      <button v-on:click="Login()" class="login-button">
        <i class="fa fa-sign-in"></i> Login
      </button>
      <button class="register-button" @click="gotoRegister()">
        <i class="fa fa-user-plus"></i> Register
      </button>
    </div>

    <div style="position: absolute; bottom: 0; width: 100%; text-align: center;"> 
       version 1.0
    </div>
  </div>
</template>
<style scoped>
.parent-div{
   background: linear-gradient(
        to bottom,
        #ffffff,
        #f7af83
      );
      height: 100vh;
  background-size: 100% 100%;
}
.login-button {
   border: #f57224 2px solid;
  margin-top: 15px;
  width: 35%;
  height: 30px;
  background-color: white;
  color: #f57224;
}
.register-button {
  border: none;
  height: 30px;
  width: 63%;
  margin-top: 15px;
  background-color: #f57224;
  color: white;
  margin-bottom: 20px;
}
.panel {
  border-top: 2px white solid;
  margin-top: 10%;
}
.panel-header {
  margin-top: -12px;
  font-size: 15px;
  background-color: #f57224;
  width: max-content;
  color: white;
  padding-left: 10px;
  padding-right: 10px;
  margin-left: auto;
  margin-right: auto;
  display: block;
}
::placeholder {
  color: #7a7a78;
  opacity: 0.7; /* Firefox */
}
.row {
  width: 100vw;
  background-color: #f57224;
}
.welcome-banner {
  font-size: 35px;
}
.right-panel {
  background-color: black;
  height: 50vh;
}
.body-level {
  margin-top: 10%;
}
.right-body {
  color: white;
}
.custom-card {
  color: #f57224;
  width: 40%;
  margin-top: 5%;
  background-color: white;
  padding: 0px 30px;
  -webkit-box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
  -moz-box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
  box-shadow: 3px 7px 16px 0px rgba(0, 0, 0, 0.75);
}
.custom-card-header {
  background-color: white;
  font-size: 30px;
  text-align: center;
  width: 50%;
  margin-left: auto;
  margin-right: auto;
  display: block;
  color:  #f57224;
  margin-bottom: 5%;
}
.custom-card-input {
  background: transparent;
  border: none;
  margin-top: 2%;
  width: 100%;
  display: block;
  color: #7a7a78;
  padding: 5px 5px;
  border-bottom: 2px #7a7a78 solid;
}
.custom-card-input:focus {
  outline: none;
}
</style>
<script>
import AuthService from "../services/auth";
import Swal from "sweetalert2";
export default {
  data: () => {
    return {
      user : {
        username : '',
        password : ''
      },
      userDetails : []
    };
  },
  created() {
    AuthService.methods.isLogedIn().then(() => {
      this.$router.push('/');
    });
  },
  methods: {
    Login: function() {

      AuthService.methods.checkUser(this.user.username, this.user.password).then(
        res => {

        this.userDetails = [...res];
        console.info(this.userDetails);
       
        AuthService.methods.Login(this.userDetails[0].user_id).then(res => {
          if(res){
            window.localStorage.setItem('isUserValid',this.userDetails[0].isValid);
            window.localStorage.setItem('reason',this.userDetails[0].reason);
            if(this.userDetails[0].role_id == 2){
                this.$router.push({path: '/'});
                 Swal.fire({
                    title: "Epawn Application",
                    text : `Welcome back ${this.userDetails[0].fname}`,
                    icon : 'success'
                 });
            }else if(this.userDetails[0].role_id == 1){
               this.$router.push({path: '/SuperAdmin/Board'});
                Swal.fire({
                    title: "Epawn Application",
                    text : "Welcome Back Super Admin",
                    icon : 'success'
                 
                 }); 
            }else if(this.userDetails[0].role_id == 3){
              AuthService.methods.Logout();
                Swal.fire({
                  title: "Epawn Application",
                  title: "For Users Please use the mobile version",
                  icon: 'error'
                }); 
            }else{
              Swal.fire({
                  title: "Epawn Application",
                  title: "Password/Email incorrect",
                  icon: 'error'
                }).then( e=>{
                  AuthService.methods.Logout();
                }); 
            }
          }
        });
        })
     // AuthService.methods.Login();
      // this.$router.push({path : '/'});
    },
    gotoRegister(){
       this.$router.push({path: '/Signup'});
    }
  }
};
</script>