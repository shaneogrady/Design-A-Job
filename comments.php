<?php
//Form already sent?
if (isset($_POST['add'])) {

$db_host = "localhost";
$db_username = "root";
$db_pass = "password";
$db_name = "mem";
    
//If so, connect to database
$connection = mysql_connect("$db_host", "$db_username", "$db_pass");
//$link=mysql_select_db("$db_name") 
//or die("no database by that name");

if ( ! $connection ) 
die ("connection failed"); 
$link="mem"; 
mysql_select_db($link) or die ("no connection");

// Create variables
    $title = $_POST['title'];
    $comment = $_POST['comment_text'];

//Check if all the info is there and send it
    if (isset($title) AND $title != "" && isset($comment) AND $comment != "") {
        mysql_query("INSERT INTO comments (title, comment_text)
VALUES ('$title', '$comment')");
    }
    
//Close connection
mysql_close($connection);
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

        <FORM method=post action="index.php">
            <table>

                <tr>
                    <td>
                        Title&nbsp;:&nbsp;
                    </td>
                    <td>
                        <INPUT type=text name="title">
                    </td>
                </tr>
                <tr>
                    <td>
                        Comment&nbsp;:&nbsp;
                    </td>
                    <td>
                        <TEXTAREA cols=50 rows=15 name="comment"></TEXTAREA>
                    </td>
                </tr>
                <tr>
                    <td>
                        <td><input type="submit" name="Submit" value="Submit Form" /></td>
                        <td align="center" colspan="2"> <a href="index.php">Home</a></td>
                    </td>
                </tr>
            </table>
        </FORM>



        </div>
    </body>
</html>
