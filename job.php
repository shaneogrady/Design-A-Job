<?php
session_start();
$id = $_GET['id'];
$toplinks = "";

if ($id == "") {
    echo "Missing Data to Run";
    exit();
}

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
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM jobs WHERE job_id='$id' ");
$count = mysql_num_rows($sql);
if ($count > 1) {
    echo "There is no user with that id here.";
    exit();
}

while ($row = mysql_fetch_array($sql)) {
    $userId = $row["user_id"];
}


$sql2 = mysql_query("SELECT * FROM mem WHERE id='$userId' ");
$count = mysql_num_rows($sql2);
if ($count > 1) {
    echo "There is no user with that id here.";
    exit();
}

while ($row = mysql_fetch_array($sql2)) {
    $profilepic = '<img src="memberFiles/' . $userId . '/pic1.jpg" />';
    $name = '<a href="member.php?id=' . $row["id"] . '">' . $row['username'] . '</a><br />';
    $country = $row["country"];
    $state = $row["state"];
    $city = $row["city"];
    $bio = $row["bio"];
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
                        <div id="propic1"><?php echo $profilepic; ?></div>
                        <div id="lifestory"><strong>About</strong></br><?php echo "$bio"; ?></div>

                    </div>
                    <div id="feed">
                        <?php
                        $result = mysql_query(
                                "SELECT * FROM jobs
                                WHERE job_id='$id' LIMIT 1")
                                or die(mysql_error());

                        while ($row = mysql_fetch_array($result)) {
                            $Jobhy = '<a href="job.php?id=' . $row['job_id'] . '"> ' . $row['job'] . '</a>';
                            $viewJob = '<a href="contact.php?id=' . $row['job_id'] . '">Message</a>';
                            $category = '' . $row['category'] . '';
                            $description = '' . $row['description'] . '<br />';
                            $member = '<a href="client_profile.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';
                            $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                            ?>


                            <div id="job">
                                <div id="openjobview"><?php echo $viewJob ?></div>
                                <div id="description"><a href="job.php"><?php echo $Jobhy ?></a></br>
                                <div id="prices"><strong><?php echo $description; ?> </strong></div>
                                <div id="prices"><strong></strong></div></div>
                                <div id="deets">
                                    <ul id="deetslist">
                                        <li>Posted in:</li>
                                        <li><?php echo $category ?></a> - </li>
                                        <li>2 hours ago</a> - </li>
                                        <li>Dublin City</a> - </li>
                                        <li>By <?php echo $member ?> </a></li>
                                    </ul>
                                </div>
                                <div id="propic"><?php echo $pic ?></div>
                            </div>
<?php } ?>











                    </div>

                </div>
<?php include_once 'sidebar.php'; ?>

            </div>

            <div id="footer">
                Copyright © Design A Job

            </div>
    </body>

</html>