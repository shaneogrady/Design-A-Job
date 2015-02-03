<?php
session_start();
session_destroy();
if (!$_SESSION['id']) {
    $msg = "You are now logged out";
} else {
    $msg = "<h2>You are now logged out</h2>";
}
?> 
<html>
    <body>
        <?php echo "$msg"; ?><br>
        <p><a href="index.php">Click here</a> to return to our home page </p>
    </body>
</html>