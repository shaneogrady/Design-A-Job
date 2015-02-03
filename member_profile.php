<?php
session_start(); // Must start session first thing
$toplinks = "";
$id = $_GET['id'];
$_SESSION['id'] = $id;
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
<?php
$id = $_GET['id']; 
$username = $_GET['username'];
if ($id == "") {
    echo "Missing Data to Run";
    exit();
}
include_once "connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM mem WHERE id='$id' LIMIT 1");
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
    //$accounttype = $row["accounttype"];
    $bio = $row["bio"];
    $signupdate = strftime("%b %d, %Y", strtotime($row['signupdate']));

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Member Profile</title>
        <style type="text/css">
            <!--
            body {margin: 0px}
            -->
        </style></head>
    <body>
        <table style="background-color: #CCC" width="100%" border="0" cellpadding="12">
            <tr>
                <td width="78%"><h1><?php echo "$name"; ?>'s Profile Page</h1></td>
                
                            


                <td width="22%"><?php echo $toplinks; ?></td>
            </tr>
        </table>
        <table width="90%" align="center" cellpadding="5" cellspacing="5" style="line-height:1.5em;">
            <tr>
                <td width="31%" rowspan="2" valign="top">
                    <div align="center"><img src="memberFiles/<?php echo "$id"; ?>/pic1.jpg" alt="Ad" width="250" /></div></td>
                <td width="20%" rowspan="2" valign="top">
                    Name: <?php echo "$name"; ?><br />
                    Country: <?php echo "$country"; ?> <br />
                    State: <?php echo "$state"; ?><br />
                    City: <?php echo "$city"; ?><br />
                </td>
                <td width="49%" valign="top">Bio</td>
            </tr>
            <tr>
                <td valign="top"><?php echo "$bio"; ?></td>
            </tr>
            <tr>
                <td valign="top">&nbsp;</td>
                <td colspan="2" valign="top">Sign up date: <?php echo "$signupdate"; ?></td>
           
            </tr>
        </table>
        
            <?php $query = mysql_query(
                     "SELECT job, category, description
                         FROM jobs
                         WHERE user_id ='$id'") 
           
            or die(mysql_error());  

            while($row = mysql_fetch_array( $query )) {

            echo '<a href="job.php?id='.$row['job_id'].'"> ' . $row['job'] . '</a><br />';
            echo 'category: '.$row['category'].'<br />';
            echo 'description: '.$row['description'].'<br />';
            echo '<br />';
            

            }?>

            <?php $query = mysql_query(
                     "SELECT project_id, project_name, category, description, pic
                         FROM projects
                         WHERE user_id ='$id'") 
                            or die(mysql_error());

            while($row = mysql_fetch_array( $query )) {
            $ppic = $row["project_id"];
            
            echo '<img src="memberFiles/projects/'. $ppic .'/project.jpg" />';
            echo '' . $_GET['project_id'] . '';
            echo '<a href="project.php?id='.$row['project_id'].'"> ' . $row['project_name'] . '</a><br />';
            echo 'category: '.$row['category'].'<br />';
            echo 'description: '.$row['description'].'<br />';
            echo '<br />';
            }?>
        
    </body>
</html>