<?php
$errorMsg = "";
if (isset($_POST['username'])) {
    include_once "connect_to_mysql.php";
    $username = $_POST['username']; 
    $country = $_POST['country']; 
    $state = $_POST['state']; 
    $city = $_POST['city']; 
    $accounttype = $_POST['accounttype']; 
    $email = ($_POST['email']);
    $password = $_POST['password']; 


    if ((!$username) || (!$country) || (!$state) || (!$city) || (!$accounttype) || (!$email) || (!$password)) {

        $errorMsg = "You did not submit the following required information!<br /><br />";
        if (!$username) {
            $errorMsg .= "--- User Name";
        } else if (!$country) {
            $errorMsg .= "--- Country";
        } else if (!$state) {
            $errorMsg .= "--- State";
        } else if (!$city) {
            $errorMsg .= "--- City";
        } else if (!$accounttype) {
            $errorMsg .= "--- Account Type";
        } else if (!$email) {
            $errorMsg .= "--- Email Address";
        } else if (!$password) {
            $errorMsg .= "--- Password";
        }
    } else {


        $sql_username_check = mysql_query("SELECT id FROM mem WHERE username='$username' LIMIT 1");
        $sql_email_check = mysql_query("SELECT id FROM mem WHERE email='$email' LIMIT 1");
        $username_check = mysql_num_rows($sql_username_check);
        $email_check = mysql_num_rows($sql_email_check);
        if ($username_check > 0) {
            $errorMsg = "<u>ERROR:</u><br />Your User Name is already in use inside our system. Please try another.";
        } else if ($email_check > 0) {
            $errorMsg = "<u>ERROR:</u><br />Your Email address is already in use inside our system. Please try another.";
        } else {
            $hashedPass = md5($password);
            $sql = mysql_query("INSERT INTO mem (username, country, state, city, accounttype, email, password, signupdate) 
		VALUES('$username','$country','$state','$city','$accounttype','$email','$hashedPass', now())") or die(mysql_error());
            $id = mysql_insert_id();
            mkdir("memberFiles/$id", 0755); 
            header("location: member_profile.php?id=$id");

            
        } 
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Register</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
    <script type="text/javascript">
    
        function checkPass(){
            var password = document.getElementById('password');
            var password2 = document.getElementById('password2');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field 
            //and the confirmation field
            if(password.value == password2.value){
                //The passwords match. 
                //Set the color to the good color and inform
                //the user that they have entered the correct password 
                password2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }
            else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                password2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }  
        
        function placeOrder(form) {
            if (
            //validateNonEmpty(form["username"], form["username_help"]) &&
            validateNonEmpty(form["password1"], form["password1_help"]) &&
                validateNonEmpty(form["password2"], form["password2_help"]) ) {
                // Submit the order to the server
                form.submit();
                //otherwise a pop up alert box will notify the user that there is an error
            } else {
                alert("I'm sorry but there is something wrong with the order information.");
            }
        }
    
    
    </script>
<body>
	<div id="container">

		<div id="topnav">

			<div id="links">
				<ul id="navlist">
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				</ul>
			</div>

			<div id="logo"><a href="index.php"><img src="img/logo4.jpg"></a></div>

		</div>

		<div id="content">

				<div id="registerpgtitle">Register</div>

				<div id="registerpage">
					<div id="loginform">
						<form action="join_form.php" method="post" enctype="multipart/form-data" class="form-horizontal">
  							<div class="control-group">
   								<label class="control-label" for="username">Username</label>
    							<div class="controls">
      								<input name="username" type="text" value="<?php echo "$username"; ?>" id="username" placeholder="Username">
    							</div>
  							</div>
  							<div class="control-group">
    							<label class="control-label" for="email">Email</label>
    							<div class="controls">
      								<input name="email" type="text" value="<?php echo "$email"; ?>" id="email" placeholder="Email">
    							</div>
  							</div>
  							<div class="control-group">
							    <label class="control-label" for="password">Password</label>
							    <div class="controls">
							      	<input name="password" type="password" id="password" value="<?php echo "$password"; ?>" 
                               onblur="validateNonEmpty(this, document.getElementById('password_help'))"
                               onkeyup="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage" id="password_help" class="help" placeholder="Password">
							    </div>
  							</div>
  							<div class="control-group">
							  	<label class="control-label" for="inputPasswordConfirm">Confirm Password</label>
							    <div class="controls">
							    	<input name="password2" type="password" id="password2" value="<?php echo "$password2"; ?>" 
                               onblur="validateNonEmpty(this, document.getElementById('password2_help'))"
                               onkeyup="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage" id="password2_help" class="help" placeholder="Confirm Password">
							    </div>
  							</div>
  							<div class="control-group">
							    <label class="control-label" for="accounttype">Account Type</label>
							    <div class="controls">
	  								<select type="text" name="accounttype" id="accounttype" placeholder="Account Type">
										<option value="<?php echo "$accounttype"; ?>"><?php echo "$accounttype"; ?></option>
	  									<option value="a">Designer</option>
	  									<option value="b">Client</option>
										
	  								</select>
							    </div>
  							</div>
  							<div class="control-group">
							    <label class="control-label" for="country">Country</label>
							    <div class="controls">
							      	<select type="text" id="country" name="country" placeholder="Country">
										<option value="<?php echo "$country"; ?>"><?php echo "$country"; ?></option>
										<option value="Ireland">Ireland</option>
										<option value="Australia">Australia</option>
										<option value="Canada">Canada</option>
										<option value="Mexico">Mexico</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="United States">United States</option>
										<option value="Zimbabwe">Zimbabwe</option>
	  								</select>
								</div>
  							</div>
  							<div class="control-group">
								<label class="control-label" for="state">State</label>
								<div class="controls">
									<input name="state" type="text" value="<?php echo "$state"; ?>" id="state" placeholder="State">
								</div>
  							</div>
  							<div class="control-group">
								<label class="control-label" for="city">City</label>
								<div class="controls">
									<input name="city" type="text" value="<?php echo "$city"; ?>" id="city" placeholder="City">
								</div>
  							</div>
  							<div class="control-group">
    							<div class="controls">
      								<button type="submit" name="Submit" value="Submit Form" onclick="placeOrder(this.form);" class="btn">Register</button>
    							</div>
  							</div>
						</form>
						<div id="notauser"><a href="login.php">Already a member?</a></div>
						</div>
				</div>




		</div>
	<div id="footer">
    Copyright © Design A Job

	</div>
</body>

</html>