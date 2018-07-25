<!--     registration-->
      <modal v-if="registerForm" @close="closeRegisterForm()">
        <div slot="head" class="text-center">
             <h2>Create your account</h2> 
      </div>
        <div class="mt-3" slot="body">
            <div class="container">
            <div class="row">
         <div class="col-md-6">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-user"></i>
                  </span>
                </div>
               
                <input type="text" class="form-control" placeholder="Firstname" name="firstname" v-model="userRegister.firstname">
                
              </div>
                <p v-if="rValidate.firstname" class="text-danger minus-top" v-html="rValidate.firstname"></p>
                
                
                <div class="input-group mt-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-user"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Lastname" name="lastname" v-model="userRegister.lastname">
              </div>
              
               <p v-if="rValidate.lastname" class="text-danger minus-top" v-html="rValidate.lastname"></p>
               
              <div class="input-group  mt-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-user"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Username" name="username" v-model="userRegister.username">
              </div>
              
             <p v-if="rValidate.username" class="text-danger minus-top" v-html="rValidate.username"></p>
          </div>
             
            <div class="col-md-6">
                  <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fa fa-at"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Email" name="email" v-model="userRegister.email">
              </div>
              
             <p v-if="rValidate.email" class="text-danger minus-top" v-html="rValidate.email"></p>
             
              <div class="input-group  mt-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password" v-model="userRegister.password">
              </div>
              
         <p v-if="rValidate.password" class="text-danger minus-top" v-html="rValidate.password"></p>
             
              <div class="input-group mt-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <input type="password" class="form-control" placeholder="Repeat password" name="confirm_password" v-model="userRegister.confirm_password">
              </div>
               <p v-if="rValidate.confirm_password" class="text-danger minus-top" v-html="rValidate.confirm_password"></p>
            </div>
          </div>
            </div>
            
        </div>

 <input type="submit" slot="foot"class="btn btn-primary btn-block mx-3" value="Create Account" @click="register()">

     </modal> <!--     end registration-->
     
     
     
      <!--   forgot password-->
       <modal v-if="store.state.forgotPassword" @close="store.commit('closeForgotPw')">
    
        <div slot="head">
             <h2>Forgot Password</h2> 
      </div>
        <div class="container" slot="body">
            <p class="text-muted text-center">We can help you reset your password using your email address</p>
            
                <div class="input-group ">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-at"></i>
                    </span>
                  </div>
                  <input type="text" v-model="store.state.sendMail.email" class="form-control" placeholder="Email">
                </div>
                <p class="text-danger " v-if="store.state.emailValidate" v-html="store.state.emailValidate"></p>
          
                
                
        </div>
        <button slot="foot" class="btn btn-primary btn-block" @click="store.dispatch('sendEmail'); store.state.loadingBtn = true"> <i class="fa fa-refresh fa-spin mx-2"  v-if="store.state.loadingBtn"></i>Reset my password</button>
     </modal> <!--end forgot password-->
     

     
<!--     enter code-->
      <modal v-if="store.state.showEnterCode" @close="store.commit('closeEnterCode')">
    
        <div slot="head">
             <h2>Enter Security Code</h2> 
      </div>
        <div class="container" slot="body">
           <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                <p class="text-muted mb-0">Success to send a code to your email address</p>
                <p class="mb-0 text-primary h6" v-html="store.state.checkCode.email"></p>
                <p class="text-muted">Please check your email for a message with your code.</p>
                </div>
                <div class="col-md-8">
            <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-envelope-open"></i>
                    </span>
                  </div>
                  <input type="text" v-model="store.state.checkCode.code" class="form-control" placeholder="Enter Code">
                </div>
                <a href="#" @click="store.dispatch('sendEmail')">Didn't get a code?</a>
                <p class="text-danger" v-if="store.state.codeValidation" v-html="store.state.codeValidation"></p>
            </div>
           </div>
                
                
        </div>
        <button slot="foot" class="btn btn-primary btn-block mx-5" @click="store.dispatch('enterCode')">Continue</button>
     </modal> <!--    end enter code-->
     
     
<!--       reset password-->
        <modal v-if='store.state.showResetPw' @close="store.commit('closeResetPw')">    
        <div slot="head">
              <div class="container">
           <div class="col-md-12">
               <div class="row" v-if="store.state.userInfo.oauth_provider">
                <img :src="store.state.userInfo.picture" alt="" class="img-fluid rounded-circle img-thumbnail" width="100" height="100" style="margin-top:-50px;" >
                   <p class="m-3">Hi, <b v-html="store.state.userInfo.firstname +' '+ store.state.userInfo.lastname"></b> (Google User)</p>
            <p class="m-3 h5 text-center">Please enter a new password to finish sign in</p>
            </div>
            <div class="row" v-else>
                   <p class="m-3 h5">Hi, <b v-html="store.state.userInfo.firstname +' '+ store.state.userInfo.lastname"></b></p>
            <p class="m-3 h5 text-center">Please enter a new password to finish sign in</p>
            </div>
            </div>
            
            </div>
      </div>
        <div class="container" slot="body">
           <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                <p class="mb-0 text-primary h5" v-html="store.state.resetPw.email"></p>
                </div>
                <div class="col-md-12 text-center">
                    <p class="text-danger" v-if="store.state.resetPwValidation" v-html="store.state.resetPwValidation"></p>
                </div>
                <div class="col-md-8">
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" v-model="store.state.resetPw.pw" class="form-control" placeholder="New Password">
                </div>
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" v-model="store.state.resetPw.c_pw" class="form-control" placeholder="Confirm Password">
                </div>
               
            </div>
           </div>
        </div>
        <button slot="foot" class="btn btn-primary btn-block mx-5" @click="store.dispatch('resetPassword')">Done</button>
     </modal><!--      end reset password-->
     
     
     
    
