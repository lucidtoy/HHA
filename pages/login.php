<?php
/**
Author: Solomon Oladokun
Date: 27-Nov-2023
Error Page
**/


?>

 <section class="hero">
        <div class="container">
            <div class="row">
				<!--<h1>Login Page</h1>-->
			</div>
        </div>
 </section>



 <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
            
            
            
            	<div class="col-lg-5 col-md-6" style="border:0px solid #000;">
                
                
                <?php
					
						echo'<center>';
					   	if(isset($_POST['login'])){
							echo"<br/><br/>";
							$email = strtolower(mysqli_real_escape_string($conn,$_POST['email']));
							$password = mysqli_real_escape_string($conn,$_POST['password']);
							$login = login($email , $password);
							//$login[0] = false;
							//$login[1] = "Invalid username";
							//echo "$login[0] : $login[1]";
							if($login[0]=='true'){
								echo'<span class="alert-success" style="padding:5px;">'.$login[1].' <img width="50px" height="50px" src="img/load.gif" /></span>';
								//echo"<meta http-equiv=\"refresh\" content=\"0;URL="."http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."\" />";
							}else{
								echo'<span class="alert-danger" style="padding:5px;">'.$login[1].'</span>';
							}
							
						}else{
							echo "<br/><br/><br/>";	
						}
						echo'</center>';
					?>        
                
                
                
                	<div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email"  required autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input name="login" type="submit"  class="site-btn" value="Login" />
                                <!--class="btn btn-lg btn-danger btn-block"-->
                            </fieldset>
                        </form>
                    </div>
                </div>
                </div><!--<div class="col-lg-5 col-md-6" style="border:0px solid #000;">-->
                
                
                
                <div class="col-lg-5 col-md-6" style="border:0px solid #000;">
                
                
                 <?php
					
						echo'<center>';
					   	if(isset($_POST['register'])){
							echo"<br/><br/>";
							$email = strtolower(mysqli_real_escape_string($conn,$_POST['email']));
							$cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
							$vpassword = mysqli_real_escape_string($conn,$_POST['vpassword']);
							$firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
							$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
							$phone_number = mysqli_real_escape_string($conn,$_POST['phone_number']);
							$register = register($email, $cpassword, $vpassword, $firstname, $lastname, $phone_number);
							//echo "$login[0] : $login[1]";
							if($register[0]=='true'){
								
								//
								
								echo'<span class="alert-success" style="padding:5px;">'.$register[1].'</span>';
								echo"<meta http-equiv=\"refresh\" content=\"0;URL="."http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."\" />";
							}else{
								echo'<span class="alert-danger" style="padding:5px;">'.$register[1].'</span>';
								
							}
							
						}else{
							echo "<br/><br/><br/>";	
						}
						echo'</center>';
					?>             
                                
                                 <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Register</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                                </div>
                                <div class="form-group">
                                	<div class="row">
                                    <div class="col-md-6 col-lg-6 col-xs-6">
                                    <input class="form-control" placeholder="First Name" name="firstname" type="text" required>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-6">
                                    <input class="form-control" placeholder="Last Name" name="lastname" type="text" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="cpassword" type="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Verify Password" name="vpassword" type="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone_number" type="phone" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="terms" type="checkbox" value="I Agree to Terms and Conditions" required>I Agree to Terms and Conditions
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input name="register" type="submit" class="btn btn-lg btn-danger btn-block" value="Register" />
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                </div><!--<div class="col-lg-5 col-md-6" style="border:0px solid #000;">-->
            
            
            </div>
        </div>
    </section>