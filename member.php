<?php
session_start();
$toplinks = "";
$id = $_GET['id'];

if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
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

include_once "connect_to_mysql.php";
//$toplinks = "";
$id = $_GET['id']; 
$sql = mysql_query("SELECT * FROM mem WHERE id='$id' ");
$count = mysql_num_rows($sql);
if ($count > 1) {
    echo "There is no user with that id here.";
    exit();
}
while ($row = mysql_fetch_array($sql)) {
    $name = $row["username"];
    $country = $row["country"];
    $state = $row["state"];
    $city = $row["city"];
    $accounttype = $row["accounttype"];
    $bio = $row["bio"];
    $signupdate = strftime("%b %d, %Y", strtotime($row['signupdate']));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Project</title>

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
                            

				<div id="aboutusah">

					<div id="singlerespond"><a href="contact.php">Contact</a></div>
					<div id="memberdetails"><?php echo "$name"; ?></div>
					<div id="morememberdetails">Designer</br></br>Location: <?php echo "$city"; ?>, <?php echo "$state"; ?>, <?php echo "$country"; ?></div>
					<div id="propic1"><img src="memberFiles/<?php echo "$id"; ?>/pic1.jpg"></div>
					<div id="lifestory"><strong>About</strong></br><?php echo "$bio"; ?></div>

				</div>
                                
                                 <?php
                                
                                $query = mysql_query(
                                "SELECT project_id, project_name, category, description, pic
                                FROM projects
                                WHERE user_id ='$id'") 
                                or die(mysql_error());

                                while($row = mysql_fetch_array( $query )) {
                                $ppic = $row["project_id"];

                                $proimg = '<img src="memberFiles/projects/'. $ppic .'/project.jpg" />';
                                $proid = '' . $_GET['project_id'] . '';
                                $proname = '<a href="project.php?id='.$row['project_id'].'"> ' . $row['project_name'] . '</a>';
                                $procat = ''.$row['category'].'';
                                $prodes =''.$row['description'].'';
                                
                                ?>
                                
                            
				<div id="projects">
					<div id="userproject">
                                                <div id="projectcoverpic"><?php echo $proimg ?></div>
                                                <div id="singleprojecttitle"><?php echo $proname ?></div>
                                                <div id="projectsummary">
                                                        <div id="projecttitle"><?php echo $prodes ?></a></div>
                                                        <div id="projectcategories"><?php echo $procat ?></div>
                                                </div>
                                            </div>
					</div>
                                    <?php } ?>
                            
                            <?php $result = mysql_query("SELECT * FROM jobs WHERE user_id ='$id'")
                    or die(mysql_error());

                while ($row = mysql_fetch_array($result)) {

                $Jobhy = '<a href="job.php?id=' . $row['job_id'] . '"> ' . $row['job'] . '</a>';
                $viewJob = '<a href="job.php?id=' . $row['job_id'] . '">View Job</a>';
                $category = '' . $row['category'] . '';
                $description = 'description: ' . $row['description'] . '<br />';
                $member = '<a href="client_profile.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';
                $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                ?>


                        <div id="job">
                        <div id="openjobview"><?php echo $viewJob ?></div>
                           <div id="description"><a href="job.php"><?php echo $Jobhy ?></a></br>
                                <div id="prices"><strong>Price: </strong>€</div></div>
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
                                  <?php include_once 'sidebar.php'; ?>

			</div>
                    
                </div>

	<div id="footer">
    Copyright © Design A Job

	</div>
</body>

</html>