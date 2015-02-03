<?php
if ($_POST['email']) {
    include_once "connect_to_mysql.php";
    $email = stripslashes($_POST['email']);
    $email = strip_tags($email);
    $email = mysql_real_escape_string($email);
    $password = $_POST['password'];
    $password = md5($password);

    $sql = mysql_query("SELECT * FROM `mem` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");

    $login_check = mysql_num_rows($sql);
    if ($login_check > 0) {
        while ($row = mysql_fetch_array($sql)) {
            $id = $row["id"];
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header("location: member_profile.php?id=$id");
            exit();
        }
    } else {
        print '<br /><br /><font color="#FF0000">No match in our records, try again </font><br />
               <br /><a href="login.php">Click here</a> to go back to the login page.';
        exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Login</title>
	        <script type="text/javascript">
            <!-- Form Validation -->
            function validate_form ( ) { 
                valid = true; 
                if ( document.logform.username.value == "" ) { 
                    alert ( "Please enter your User Name" ); 
                    valid = false;
                }
                if ( document.logform.pass.value == "" ) { 
                    alert ( "Please enter your password" ); 
                    valid = false;
                }
                return valid;
            }
            <!-- Form Validation -->
        </script>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div id="container">

		<div id="topnav">

			<div id="links">
				<ul id="navlist">
					<li><a href="login.php">Login</a></li>
					<li><a href="join_form.php">Register</a></li>
				</ul>
			</div>

			<div id="logo"><a href="index.php"><img src="img/logo4.jpg"></a></div>

		</div>

		<div id="content">


				<div id="loginpage">
					<div id="loginform">
						<form action="login.php" method="post" enctype="multipart/form-data" name="logform" id="logform" onsubmit="return validate_form ( );" class="form-horizontal">
  							<div class="control-group">
   								<label class="control-label" for="email">Email</label>
    							<div class="controls">
      								<input name="email" type="text" id="email" placeholder="Email">
    							</div>
  							</div>
  							<div class="control-group">
    							<label class="control-label" for="password">Password</label>
    							<div class="controls">
      								<input name="password" type="password" id="password" placeholder="Password">
    							</div>
  							</div>
  							<div class="control-group">
    							<div class="controls">
      								<label class="checkbox">
        								<input type="checkbox"> Remember me
      								</label>
      								<button type="submit" class="btn">Sign in</button>
    							</div>
  							</div>
						</form>
					</div>
					<div id="notauser"><a href="join_form.php">Not a member?</a></div>
				</div>

			</div>
	<div id="footer">
    Copyright © Design A Job

	</div>
	</div>
</body>

</html>