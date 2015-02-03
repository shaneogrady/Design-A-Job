<?php
session_start();
$errorMsg = "";
if (!isset($_SESSION['id'])) {
    echo 'Please <a href="login.php">log in</a> to access your account';
    exit();
}
include_once "connect_to_mysql.php";
$userid = $_SESSION['id'];



if (isset($_POST['job'])) {
    $job = $_POST['job'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    echo 'Your job has been posted <a href="member_account.php">click here</a> to return to your profile.<br /><br />';
   


    if ((!$job) || (!$category) || (!$description)) {

        $errorMsg = "You did not submit the following required information!<br /><br />";
        if (!$job) {
            $errorMsg .= "--- Job Title";
        } else if (!$category) {
            $errorMsg .= "--- category";
        } else if (!$description) {
            $errorMsg .= "--- description";
        }
    } else {




        $sql = mysql_query("INSERT INTO jobs (job, category, description, user_id) 
		VALUES('$job','$category','$description','$userid')") or die(mysql_error());




        $id = mysql_insert_id();
        mysql_query("INSERT INTO test (job_id,user_id) 
            VALUES ('$id','$userid')");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Upload Job</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="script/./jquery.textareaCounter.plugin.js" type="text/javascript"></script>
		<script type="text/javascript">
			var info;
			$(document).ready(function(){

				var options2 = {
						'maxCharacterSize': 120,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '#input/#max | #words words'
				};
				$('#testTextarea2').textareaCount(options2);
			});
		</script>
</head>

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

			<div id="mainblock">

				<div id="clientuploadpgtitle">Create a job</div>

				<div id="clientuploadpage">
					<div id="loginform">
						<form action="postjob.php" method="post" enctype="multipart/form-data" id="clientform" class="form-horizontal">
  							<div class="control-group">
   								<label class="control-label" for="inputTitle">Title</label>
    							<div class="controls">
      								<textarea name="job" type="text" id="testTextarea2" placeholder="Your job title, remember to keep it short and to the point.."></textarea>
    							</div>
  							</div>
  							<div class="control-group">
    							<label class="control-label" for="inputDesc">Description</label>
    							<div class="controls">
      								<textarea name="description" type="text" id="inputDesc" placeholder="A description explaining the details of the job you need done.."></textarea>
    							</div>
  							</div>
  							<div class="control-group">
							    <label class="control-label" for="category">Job Category</label>
							    <div class="controls">
	  								<select name="category" type="text" id="jbcategory" placeholder="Category">
	  									<option value="Animation">Animation</option>
	  									<option value="Cartooning">Cartooning</option>
										<option value="Drawing">Drawing</option>
										<option value="Fashion">Fashion</option>
										<option value="Graphic">Graphic</option>
										<option value="Illustration">Illustration</option>
										<option value="Painting">Painting</option>
										<option value="Web">Web</option>
	  								</select>
							    </div>
  							</div>
  							<div class="control-group">
							    <label class="control-label" for="deadline">Deadline</label>
							    <div class="controls">
	  								<select type="text" id="day" placeholder="Deadline">
	  									<option>1</option>
	  									<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
	  								</select>
									<select type="text" id="month" placeholder="Deadline">
	  									<option>Jan</option>
	  									<option>Feb</option>
										<option>Mar</option>
										<option>Apr</option>
										<option>May</option>
										<option>Jun</option>
										<option>Jul</option>
										<option>Aug</option>
										<option>Sep</option>
										<option>Oct</option>
										<option>Nov</option>
										<option>Dec</option>
	  								</select>
							    </div>
  							</div>
  							<div class="control-group">
								<label class="control-label" for="price">Price</label>
								<div class="controls">
									<input type="text" id="price" placeholder="€">
								</div>
  							</div>

  							<div class="control-group">
    							<div class="controls">
      								<button type="submit" name="Submit" value="Submit Form" class="btn">Create</button>
    							</div>
  							</div>
						</form>
						</div>
				</div>

			</div>

			<?php include_once "sidebar.php"; ?>
		</div>
	<div id="footer">
    Copyright © Design A Job

	</div>
</body>

</html>