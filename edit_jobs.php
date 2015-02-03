<?php
session_start();

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
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Our Deadly Website</title>
        <style type="text/css">
            <!--
            body {margin: 0px}
            -->
        </style></head>

    <body>
        <table style="background-color: #CCC" width="100%" border="0" cellpadding="12">
            <tr>
                <td width="78%"><h1>Design a Job</h1></td>
            </tr>
        </table>
        <div style="padding:12px">

            <?php
            include_once "connect_to_mysql.php";
            $id = $userid;
            $username = $_GET['username'];


            $result = mysql_query("SELECT * FROM jobs WHERE user_id ='$id'")
                    or die(mysql_error());

            while ($row = mysql_fetch_array($result)) {
                echo '<a href="job.php?id=' . $row['job_id'] . '"> ' . $row['job'] . '</a><br />';
                echo 'category: ' . $row['category'] . '<br />';
                echo 'description: ' . $row['description'] . '<br />';
                echo '<a href="member.php?id=' . $row['userid'] . '">Clients profile</a><br />';
                echo '<br />';?>
            
            <a href="delete_job.php?job_id=<?php echo $row['job_id']; ?>"
                           onclick="return confirm('Are you sure you want to delete this job?');">
                           <img src="images/delete20.png" alt="Delete Job" />
                        </a>
            <?php } ?>
            
            
            

            <td width="20%" rowspan="2" valign="top">

            </td>
        </div>
    </body>
</html>