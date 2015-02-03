<html>
    <body>
        <h2>ACTIVATION RESULTS</h2> 
        <?
        include_once "connect_to_mysql.php";

        $id = $_REQUEST['id'];
        $id = ereg_replace("[^0-9]", "", $id);
        if (!$id) {
            echo "Missing Data to Run";
            exit();
        }

        $sql = mysql_query("UPDATE members SET emailactivated='1' WHERE id='$id'");
        $sql_doublecheck = mysql_query("SELECT * FROM members WHERE id='$id' AND emailactivated='1'");
        $doublecheck = mysql_num_rows($sql_doublecheck);

        if ($doublecheck == 0) {
            print "<br /><br /><div align=\"center\"><h3><strong><font color=red>Your account could not be activated!</font></strong><h3><br /></div>";
        } elseif ($doublecheck > 0) {
            print "<br /><br /><h3><font color=\"#0066CC\"><strong>Your account has been activated!<br /><br />
    </strong></font><a href=\"http://www.somewebsite.com/login.php\">Click Here</a> to log in now.</h3>";
        }
        ?>
    </body>
</html>