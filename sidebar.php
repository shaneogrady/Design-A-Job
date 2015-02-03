<?php
$id = $_GET['id']; 
include_once "connect_to_mysql.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<div id="sidebar">

                <div id="topblock">

                    <div id="searchbar">

                       <!-- <form method="get" action="#" id="search"> 
                            <input name="search" type="text" size="20" placeholder="Search..." />
                        </form> -->

                    </div>
                    <div id="categories">

                        <ul id="categorylist">
                            <li><a href="animation.php">Animation</a></li>
                            <li><a href="cartooning.php">Cartooning</a></li>
                            <li><a href="drawing.php">Drawing</a></li>
                            <li><a href="fashion.php">Fashion</a></li>
                            <li><a href="graphic.php">Graphic</a></li>
                            <li><a href="illustration.php">Illusration</a></li>
                            <li><a href="painting.php">Painting</a></li>
                            <li><a href="web.php">Web</a></li>
                        </ul>

                    </div>

                </div>

                <div id="bottomblock">
                    
                    <?php
                    $result1 = mysql_query("SELECT * FROM projects tbl LIMIT 3")
                    or die(mysql_error());
                    while ($row = mysql_fetch_array($result1)) {
                        $pro = '<a href="project.php?id=' . $row['project_id'] . '"> ' . $row['project_name'] . '</a>';
                        //echo 'category: ' . $row['category'] . '<br />';
                        $proj = '<a href="project.php?id=' . $row['project_id'] . '">View More</a>';

                        $descrip = '' . $row['description'] . '<br />';
                        $designer = '<a href="member.php?id=' . $row['user_id'] . '">Designers profile</a>';
                    ?>

                    <div id="secondfeed">

                        <div id="secondtime">10 minutes ago</div>
                        <div id="secondname"><?php echo $pro ?></div>
                        <div id="secondtitle"><?php echo $descrip ?></div>
                        <div id="secondview"><?php echo $proj ?></div>
                        <div id="secondname"><?php echo $designer ?></div>


                    </div>

                    <?php } ?>

                </div>
            </div>

</body></html>
