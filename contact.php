<?php
//bugs
session_start();
$errorMsg = "";
if (!isset($_SESSION['id'])) {
    echo 'Please <a href="login.php">log in</a> to send a message';
    exit();
}




$id = mysql_insert_id();


$to = "$email";
$from = "$username";
$subject = "Hi id like to contact you";

$message = ''.$username.'Message' . $messagedata . '		
		
		
		E-mail Address: ' . $useremail . ' <br />
		<br /><br /> 
		Thanks! 
		</body>
		</html>';

$headers = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";
$to = "$to";
mail($to, $subject, $message, $useremail);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Contact</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="script/./jquery.textareaCounter.plugin.js" type="text/javascript"></script>

</head>

<body>
	<div id="container">

		<div id="topnav">

			<div id="links">
				<ul id="navlist">
					<?php echo $toplinks; ?>
				</ul>
			</div>

			<div id="logo"><a href="index.php"><img src="img/logo4.jpg"></a></div>

		</div>

		<div id="content">

			<div id="mainblock">

				<div id="contactuser">Contact</div>
				<div id="contactuserpage">
					<div id="loginform">
						<form id="clientform" class="form-horizontal" action="comment.php" method="post" enctype="multipart/form-data">
  							<div class="control-group">
   								<label class="control-label" for="inputTitle">Subject</label>
    							<div class="controls">
      								<textarea name="title" type="text" id="testTextarea2" placeholder="RE: Photoshop wor.."></textarea>
    							</div>
  							</div>
  							<div class="control-group">
    							<label class="control-label" for="inputDesc">Message</label>
    							<div class="controls">
      								<textarea name="comment" id="inputDesc" placeholder="Hi there.."></textarea>
    							</div>
  							</div>
  						
  							<div class="control-group">
    							<div class="controls">
      								<button type="submit" name="Submit" class="btn">Send</button>
    							</div>
  							</div>
						</form>
						</div>
				</div>

			</div>

			<?php include_once 'sidebar.php';?>
		</div>
	<div id="footer">
    Copyright © Design A Job

	</div>
</body>

</html>