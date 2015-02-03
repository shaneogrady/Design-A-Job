<?php
session_start();

$user_id = "";
$username = "";
$search_output = "";
$id = $user_id;
include_once "connect_to_mysql.php";
if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];

    $toplinks =
       '<a href="index.php">Home</a> &bull; 
	<a href="member_account.php">Account</a> &bull;
        <a href="logout.php">Log Out</a>';
} else {

    $toplinks =
        '<a href="index.php">Home</a> &bull; 
        <a href="join_form.php">Register</a> &bull; 
        <a href="login.php">Login</a>';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
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

                <div id="header"><img src="img/header.jpg"></div>
                
                

                <div id="filter">
                    <form action="results.php" method="post">
			Search For: 
  			<input name="searchquery" type="text" size="44" maxlength="88"> 
			Within: 
			<select name="filter1">
				<!--<option value="Whole Site">Whole Site</option>-->
				<option value="Jobs">Jobs</option>
				<option value="Projects">Projects</option>
			</select>
			<input name="myBtn" type="submit">
			<br />
		</form>

                    <ul id="filterlist">
                        <form  name="form" method="post"><li>Filter by:</li>
                            
                        <input type="submit" name="WEB" value="WEB" /> 
                        <input type="submit" name="GRAPHIC" value="GRAPHIC" /> 
                        
                        </form> 
                    </ul>

                </div>
                
                    <?php
                if (isset($_POST['searchquery']) && $_POST['searchquery'] != "") {
    $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
    if ($_POST['filter1'] == "Jobs") {

        $sqlCommand = "SELECT job_id, user_id, job, description AS title FROM jobs WHERE job LIKE '%$searchquery%'";
    } else if ($_POST['filter1'] == "Projects") {
        $sqlCommand = "SELECT project_id, project_name, description, category AS title FROM projects WHERE project_name LIKE '%$searchquery%'";
    }

    include_once("connect_to_mysql.php");
    $id = $_GET['id'];
    $result = mysql_query("
        SELECT * FROM jobs
        ")
           or die(mysql_error());  
    $query = mysql_query($sqlCommand) or die(mysql_error());
    $count = mysql_num_rows($query);
    if ($count > 0) {
        while ($row = mysql_fetch_array($query)) {

            if ($_POST['filter1'] == "Jobs") {
                $id = $row["job_id"];
                $job = '<a href="job.php?id=' . $row['job_id'] . '"> ' . $row['job'] . '</a>';
                $viewJob = '<a href="job.php?id=' . $row['job_id'] . '">View Job</a>';
                $category = '' . $row['category'] . '';
                $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                $description = 'description: ' . $row['description'] . '<br />';
                $member = '<a href="member.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';


                
            } else if ($_POST['filter1'] == "Projects") {
                $pid = $row["project_id"];
                $pjob = '<a href="project.php?id=' . $row['project_id'] . '"> ' . $row['project_name'] . '</a>';
                $pviewJob = '<a href="project.php?id=' . $row['project_id'] . '">View Project</a>';
                $pcategory = '' . $row['category'] . '';
                $ppic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                $pdescription = 'description: ' . $row['description'] . '<br />';
                $pmember = '<a href="member.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';

            } 
           }
        
    } else {
        $search_output = "<hr />0 results for <strong>$searchquery</strong><hr />$sqlCommand";
    }
?>
                <div id="feed">
                    <table width="100%" border="0" cellspacing="0" cellpadding="6">
                    <div id="job">
                        <div id="openjobview"><?php echo $viewJob ?></div>
                           <div id="description"><a href="job.php"><?php echo $job ?></a></br>
                                <div id="prices"><strong>Price: </strong>€</div></div>
                            <div id="deets">
                                <ul id="deetslist">
                                    <li>Posted in:</li>
                                    <li><a href="#"><?php echo $category ?></a> - </li>
                                    
                                    <li>By <?php echo $member ?> </a></li>
                                </ul>
                            </div>
                            <div id="propic"><?php echo $pic ?></div>
                        </div>
                    </table>
                   

                    <table width="100%" border="0" cellspacing="0" cellpadding="6">
                    <div id="job">
                        <div id="openjobview"><?php echo $pviewJob ?></div>
                           <div id="description"><a href="job.php"><?php echo $pjob ?></a></br>
                                <div id="prices"><strong>Price: </strong>€</div></div>
                            <div id="deets">
                                <ul id="deetslist">
                                    <li><a href="#"><?php echo $pcategory ?></a> - </li>
                                    
                                    <li>By <?php echo $pmember ?> </a></li>
                                </ul>
                            </div>
                            <div id="propic"><?php echo $ppic ?></div>
                        </div>
                    </table>
                 </div>
                
                
                <?php } ?>
            

            </div>
            
            <?php include_once 'sidebar.php'; ?>

            <div id="footer">
                Copyright © Design A Job

            </div>

        </div>
    </div>
</body></html>
