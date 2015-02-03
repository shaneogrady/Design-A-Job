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

if (isset($_POST['searchquery']) && $_POST['searchquery'] != "") {
    $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
    if ($_POST['filter1'] == "Jobs") {

        $sqlCommand = "SELECT project_id, user_id, job, description AS title FROM jobs WHERE job LIKE '%$searchquery%'";
    } else if ($_POST['filter1'] == "Projects") {
        $sqlCommand = "SELECT project_id, project_name, description AS title FROM projects WHERE project_name LIKE '%$searchquery%'";
    }

    include_once("connect_to_mysql.php");
    $id = $_GET['id'];
    $result = mysql_query(
        "SELECT * FROM jobs")
           or die(mysql_error());  
    $query = mysql_query($sqlCommand) or die(mysql_error());
    $count = mysql_num_rows($query);
    if ($count > 0) {
        while ($row = mysql_fetch_array($query)) {

            if ($_POST['filter1'] == "Jobs") {
                //$id = $_GET["user_id"];
                $id = $row["project_id"];
                
                $job = '<a href="job.php?id=' . $row['project_id'] . '"> ' . $row['job'] . '</a>';
                $viewJob = '<a href="job.php?id=' . $row['project_id'] . '">View Job</a>';
                $category = '' . $row['category'] . '';
                $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                $description = 'description: ' . $row['description'] . '<br />';
                $member = '<a href="member.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';

                ?>

                    <table width="100%" border="0" cellspacing="0" cellpadding="6">
                    <div id="job">
                        <div id="openjobview"><?php echo $viewJob ?></div>
                           <div id="description"><a href="job.php"><?php echo $job ?></a></br>
                                <div id="prices"><strong> </strong></div></div>
                            <div id="deets">
                                <ul id="deetslist">
                                    <li>Posted in:</li>
                                    <li><a href="#"><?php echo $category ?></a> - </li>
                                    <li><a href="#">2 hours ago</a> - </li>
                                    <li><a href="#">Dublin City</a> - </li>
                                    <li>By <?php echo $member ?> </a></li>
                                </ul>
                            </div>
                            <div id="propic"><?php echo $pic ?></div>
                        </div>
                    </table>
                    <?php
                    
                //echo $id;
               
                
                
            } else if ($_POST['filter1'] == "Projects") {
                $id = $row["project_id"];
                $project_name = $row["project_name"];
                $description = $row["title"];
                $search_output = "$id $project_name $description";
            } 
            }
        
    } else {
        $search_output = "<hr />0 results for <strong>$searchquery</strong><hr />$sqlCommand";
    }
    
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
                    <form action="index.php" method="post">
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
                        <input type="submit" name="button3" value="Button 3" /> 
                        <input type="submit" name="button4" value="Button 4" />
                        </form> 
                    </ul>

                </div>
                <?php echo $search_output;
                
                      
                ?>

                <div id="feed">
                <div id="openjobview"><?php echo $viewJob ?></div>

                <?php $result = mysql_query("SELECT * FROM projects  
         WHERE category = 'Cartooning' ORDER BY project_id DESC ")
                    or die(mysql_error());

                while ($row = mysql_fetch_array($result)) {

                $Jobhy = '<a href="project.php?id=' . $row['project_id'] . '"> ' . $row['project_name'] . '</a>';
                $viewJob = '<a href="project.php?id=' . $row['project_id'] . '">Project</a>';
                $category = '' . $row['category'] . '';
                $description = 'description: ' . $row['description'] . '<br />';
                $member = '<a href="member.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';
                $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                ?>


                        <div id="job">
                        <div id="openjobview"><?php echo $viewJob ?></div>
                           <div id="description"><a href="project.php"><?php echo $Jobhy ?></a></br>
                                <div id="prices"><strong>Price: </strong></div></div>
                            <div id="deets">
                                <ul id="deetslist">
                                    <li>Posted in:</li>
                                    <li><a href="#"><?php echo $category ?></a> - </li>
                                    <li><a href="#">2 hours ago</a> - </li>
                                    <li><a href="#">Dublin City</a> - </li>
                                    <li>By <?php echo $member ?> </a></li>
                                </ul>
                            </div>
                            <div id="propic"><?php echo $pic ?></div>
                        </div>
                        <?php } ?>
  
                </div>
                
                <?php  if(isset($_POST['WEB'])){
  $webcat = mysql_query("SELECT * FROM jobs 
    WHERE category = 'Web'")
        or die(mysql_error());

    while ($row = mysql_fetch_array($webcat)) {
    echo 'job: ' . $row['job'] . '<br />';
    }
}

  if(isset($_POST['GRAPHIC'])){
  $graphiccat = mysql_query("SELECT * FROM jobs 
    WHERE category = 'Graphic'")
        or die(mysql_error());

    while ($row = mysql_fetch_array($graphiccat)) {
    echo 'job: ' . $row['job'] . '<br />';
    }
} 
?>

            </div>

            <?php include_once "sidebar.php";?>

            <div id="footer">
                Copyright © Design A Job

            </div>

        </div>
    </div>
</body></html>
