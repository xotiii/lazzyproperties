<br><br><br>

  <script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>
        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>
        <script src="assets/js/icheck.min.js"></script>
        <script src="assets/js/price-range.js"></script>
        <script type="text/javascript" src="assets/js/lightslider.min.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- register-area -->
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<script src="assets/js/parsley.min.js"></script>
  
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>New account : </h2> 
                           
                           <div class="form-group">

<form id="form-register" method="post" data-parsley-validate> 
<?php echo reg_user();?> 

<div class="form-group">
    <div>
  <label for="">Select a User Type</label>
      <select id="" name="reg_user_type" class="form-control">
        <option value="a">Property Owner</option>
        <option value="b">Real Estate Agent</option>
      </select>
    </div>
</div>


<div class="form-group">
    <label for="email">Email *</label>
    <input type="email" data-parsley-validate-if-empty data-parsley-type="email" id="reg-email" required class="form-control" name="reg_email" placeholder="Email@sample.com">
</div>
<div class="form-group">
    <label for="Lastname">Last Name *</label>
    <input type="text" id="reg-last" data-parsley-whitespace="trim" data-parsley-pattern="/^[a-zA-Z\s]*$/" data-parsley-validate-if-empty data-parsley-whitespace required class="form-control" name="reg_lname" placeholder="Last Name">
</div>
<div class="form-group">
    <label for="Firstname">First Name *</label>
    <input type="text" id="reg-first" data-parsley-whitespace="trim" data-parsley-pattern="/^[a-zA-Z\s]*$/"  data-parsley-validate-if-empty data-parsley-whitespace required class="form-control" name="reg_fname" placeholder="First Name">
</div>
<div class="form-group">
    <label for="Mobile">Mobile Number *</label>
    <input type="number"  id="reg-mobile" data-parsley-pattern="(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})"  data-parsley-type="number" data-parsley-validate-if-empty data-parsley-minlength="11" data-parsley-maxlength="11" required class="form-control" name="reg_mobile" placeholder="Mobile Number">
</div>
<div id="radio-c" class="form-group">
    <p style="font-style: 10px" class="custom-control custom-radio">
  <input id="radio1" name="reg_hide" type="radio" class="custom-control-input" value="0">
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Show Mobile Number</span>
</p>
<p style="font-style: 10px" class="custom-control custom-radio">
  <input id="radio2" name="reg_hide" type="radio" class="custom-control-input" value="1">
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Don't Show Mobile Number</span>
</p>
</div>


<div class="form-group">
    <label for="password">Password *</label>
    <input type="password" id="reg-pass" data-parsley-validate-if-empty required class="form-control"   name="reg_password" placeholder="Password">
</div>

</div>
<div class="text-center">
    <input name="_wp_http_referer" type="hidden" value="/register">
    <button name="reg_submit" id="reg-submit" type="submit" class="btn btn-default">Register</button>
</div>
    <p class="form-message"></p>
</form>

                                                          
                                <div class="form-group">
                                     
                                    <br>
                                    
                                </div>
                               
                            




                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-for overflow">                         
                        <div class="col-md-12 col-xs-12 login-blocks">
                            <h2>Login : </h2> 
                            
                            <form id="show" action="" method="post">
                            <?php echo login() ?>
                                <div class="form-group">
                                    <label for="email">Email/Mobile</label>
                                    <input type="text" data-parsley-validate-if-empty data-parsley-type="email" required class="form-control" name="login_email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" required class="form-control" name="login_password" id="password">
                                </div>
                                <div class="text-center">
                                <input name="_wp_http_referer" type="hidden" value="/login">
                                    <button name="login_submit" type="submit" class="btn btn-default"> Log in</button>
                                </div>
                            </form>
                            <br>
                            
                            <h2>Social login :  </h2> 
                            
                            <p>
                            <a class="login-social" href="#"><i class="fa fa-facebook"></i>&nbsp;Facebook</a> 
                            <a class="login-social" href="#"><i class="fa fa-google-plus"></i>&nbsp;Gmail</a> 
                            <a class="login-social" href="#"><i class="fa fa-twitter"></i>&nbsp;Twitter</a>  
                            </p> 
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>