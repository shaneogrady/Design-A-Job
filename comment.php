<?php
session_start();
$errorMsg = "";
if (!isset($_SESSION['id'])) {
    echo 'Please <a href="login.php">log in</a> to access your account';
    exit();
}
include_once "connect_to_mysql.php";
$userid = $_SESSION['id'];
//$project_id = ['project_id'];

$id = $_GET['id'];


$pid = mysql_query("
                SELECT * FROM projects
                WHERE project_id='$id' LIMIT 1")
                    or die(mysql_error());

            while ($row = mysql_fetch_array($pid)) {
                echo 'pid: ' . $row['project_id'] . '<br />';
            }


if (isset($_POST['comment'])) {
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    
    
    
    echo 'Your comment has been posted <a href="member_account.php">click here</a> to return to your profile.<br /><br />';
   
    if ((!$title) || (!$comment)) {

        $errorMsg = "You did not submit the following required information!<br /><br />";
        if (!$title) {
            $errorMsg .= "---  Title";
        } else if (!$comment) {
            $errorMsg .= "--- comment";
        }
    } else {

    $sql = mysql_query("INSERT INTO comments (title, comment_text, user_id, project_id) 
		VALUES('$title','$comment','$userid','$pid')") or die(mysql_error());
    
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Comment</title>
    </head>

    <body>
        <table width="600" align="center" cellpadding="4">
            <tr>
                <td width="7%">Comment</td>
            </tr>
        </table>
        <table width="600" align="center" cellpadding="5">
            <form action="comment.php" method="post" enctype="multipart/form-data">
                <tr>
                    <td colspan="2"><font color="#FF0000"><?php echo "$errorMsg"; ?></font></td>
                </tr>
                <tr>
                    <td width="163"><div align="right">title:</div></td>
                    <td width="409"><input name="title" type="text" value="<?php echo "$title"; ?>" /></td>
                </tr>
                
                    

                    <tr>
                        <td><div align="right">comment: </div></td>
                        <td><input name="comment" type="text" value="<?php echo "$comment"; ?>" /></td>
                    </tr>
                    
                    

                    <tr>
                        <td><div align="right"></div></td>
                        <td><input type="submit" name="Submit" value="Submit Form" /></td>
                        <td align="center" colspan="2"> <a href="index.php">Home</a></td>
                    </tr>


            </form>
        </table>
    </body>
</html>