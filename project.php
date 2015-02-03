<?php
    session_start();
    $id = $_GET['id'];
    $toplinks = "";
    
    //if ($id == "") {
      //  echo "Missing Data to Run";
        //exit();
    //}

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
    $sql = mysql_query("SELECT * FROM projects WHERE project_id='$id' ");
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
        $profilepic = '<img src="memberFiles/'. $userId .'/pic1.jpg" />';
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
					<div id="propic1"><?php echo $profilepic; ?></div>
					<div id="lifestory"><strong>About</strong></br><?php echo "$bio"; ?></div>

				</div>
                                
                              <?php $query = mysql_query(
                               "SELECT * FROM projects
                                WHERE project_id='$id' LIMIT 1")
                                or die(mysql_error());

                                while($row = mysql_fetch_array( $query )) {
                                $ppic = $row["project_id"];
                                
                                $user_id = 'userid: '.$row['user_id'].'<br />';
                                $proimg = '<img src="memberFiles/projects/'. $ppic .'/project.jpg" />';
                                $proid = '' . $_GET['project_id'] . '';
                                $proname = '<a href="project.php?id='.$row['project_id'].'"> ' . $row['project_name'] . '</a><br />';
                                $procat = 'category: '.$row['category'].'<br />';
                                $prodes =''.$row['description'].'<br />';
                                //echo '<img src="memberFiles/'.$row['project_id'].'"/>';
                                echo '<br />';
                                ?>
                                
                            
				<div id="singleproject">
					<div id="singleprojecthead">
						<div id="singleprojecttitle"><?php echo $proname ?></div>
						<div id="singleprojectdescription"><?php echo $prodes ?></div>
						<div id="singleprojectcats"><?php echo $procat ?></a></div>
                                                <?php echo $user_id ?>
					</div>
					<div id="singleprojectbody">
						<div id="singleprojectimage"><?php echo $proimg ?></div>
					</div>
                                    <?php } ?>
                                    
                         
                                        
          <?php $result = mysql_query("
            SELECT * FROM comments
            WHERE project_id='$id' ")
                or die(mysql_error());

            while ($row = mysql_fetch_array($result)) {
                $compic = $row["user_id"];

               $pictur = '<img src="memberFiles/'. $compic .'/pic1.jpg" />';
                
                
                $commenttext = '' . $row['comment_text'] . '<br />';
                $memlink = '<a href="member.php?id=' . $row['user_id'] . '">'. $row['username'] .'</a><br />';
                ?>
                
            

                    <div id="usercomment"><div id="usercommentdetails">
                            <div id="usercommentname"><a href="#"><?php echo $memlink; ?></a> said:</div>
                            <div id="usercommentstuff"><?php echo $commenttext; ?></div></div>
                            <div id="propic"><?php echo $pictur; ?></div>
                    </div>

                    <?php } ?>
					
                
                    
              <?php   if (isset($_POST['comment'])) {
                $title = $_POST['title'];
                $comment = $_POST['comment'];
                $id = $_POST['id'];
                $username = $_POST['username'];
                
                echo 'Your comment has been posted <a href="index.php">click here</a> to return to the home page.<br /><br />';

                if ((!$title) || (!$comment)) {

                    $errorMsg = "You did not submit the following required information!<br /><br />";
                    if (!$title) {
                        $errorMsg .= "---  Title";
                    } else if (!$comment) {
                        $errorMsg .= "--- comment";
                    }
                } else {

                $sql = mysql_query("INSERT INTO comments (title, comment_text, project_id, user_id, username) 
		VALUES('$title','$comment', '$id', '$userid', '$username')") or die(mysql_error());
                    
                }
            }?>
            
                 <form action="project.php?id=<?php echo $id ?>" method="post">
                        <table width="600" align="center" cellpadding="5">
                            <tr>
                                <td colspan="2"><font color="#FF0000"><?php echo "$errorMsg"; ?></font></td>
                            </tr>
                            <tr>
                                <td width="163"><div align="right">Name:</div></td>
                                <td width="409"><input name="title" type="text" value="<?php echo "$title"; ?>" /></td>
                            </tr>
                            <tr>
                                <td><div align="right">Comment: </div></td>
                                <td><textarea id="comment" name="comment" rows="5" placeholder="Add comment.." type="text" value="<?php echo "$comment"; ?>" </td></textarea>
                            </tr>
                            <td><input type="hidden" name="id" value="<?php echo "$id" ;?>" /></td>
                            <tr>
                                <td><div align="right"></div></td>
                                <td><input type="submit" name="Submit" value="Submit Form" /></td>
                                <td align="center" colspan="2"> <a href="index.php">Home</a></td>
                            </tr>
                        </table>
                
                </form>
                                 <!--   <div id="userinteraction">
						<textarea id="comment" rows="5" placeholder="Add comment.."></textarea></br>
						<div id="userinteractionbtn">
						<button type="submit" class="btn"><img src="img/speech-bubble-2-16.png" width="12px"> Submit</button></div>

					</div> -->
                                    
				</div>

			</div>
                       <?php include_once 'sidebar.php'; ?>

                </div>
	<div id="footer">
    Copyright © Design A Job

	</div>
</body>

</html>