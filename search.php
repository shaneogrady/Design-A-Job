<?php

if (isset($_POST['searchquery']) && $_POST['searchquery'] != "") {
    $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
    //if ($_POST['filter1'] == "Whole Site") {
      //  $sqlCommand = "SELECT job_id, job, description AS title FROM jobs WHERE job LIKE '%$searchquery%' UNION SELECT project_id, project_name, description AS title FROM projects WHERE project_name LIKE '%$searchquery%'";
    if ($_POST['filter1'] == "Jobs") {

        $sqlCommand = "SELECT job_id, user_id, job, description AS title FROM jobs WHERE job LIKE '%$searchquery%'";
    } else if ($_POST['filter1'] == "Projects") {
        $sqlCommand = "SELECT project_id, project_name, description AS title FROM projects WHERE project_name LIKE '%$searchquery%'";
    }

    include_once("connect_to_mysql.php");
    $id = $_GET['id'];
    $result = mysql_query("
        SELECT * FROM jobs
        ")
           or die(mysql_error());  
    $query = mysql_query($sqlCommand) or die(mysql_error());
    $count = mysql_num_rows($query);
    if ($count > 0) {
        while ($row = mysql_fetch_array($query)) {

            if ($_POST['filter1'] == "Jobs") {
                //$id = $_GET["user_id"];
                $id = $row["job_id"];
                
                $job = '<a href="job.php?id=' . $row['job_id'] . '"> ' . $row['job'] . '</a>';
                $viewJob = '<a href="job.php?id=' . $row['job_id'] . '">View Job</a>';
                $category = '' . $row['category'] . '';
                $pic = '<img src="memberFiles/' . $row['user_id'] . '/pic1.jpg" />';
                $description = 'description: ' . $row['description'] . '<br />';
                $member = '<a href="client_profile.php?id=' . $row['user_id'] . '">' . $row['user_id'] . '</a><br />';

                ?>

                    <table width="100%" border="0" cellspacing="0" cellpadding="6">
                    <div id="job">
                        <div id="openjobview"><?php echo $viewJob ?></div>
                           <div id="description"><a href="job.php"><?php echo $job ?></a></br>
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
                    </table>
                    <?php
                    
                //echo $id;
               
                
                
            } else if ($_POST['filter1'] == "Projects") {
                $id = $row["project_id"];
                $project_name = $row["project_name"];
                $description = $row["title"];
                $search_output = "$id $project_name $description";
            } 
            }
        
    } else {
        $search_output = "<hr />0 results for <strong>$searchquery</strong><hr />$sqlCommand";
    }
    
}
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    

    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    

        
        

                
                    <form action="index.php" method="post">
			Search For: 
  			<input name="searchquery" type="text" size="44" maxlength="88"> 
			Within: 
			<select name="filter1">
				<!--<option value="Whole Site">Whole Site</option>-->
				<option value="Jobs">Jobs</option>
				<option value="Projects">Projects</option>
			</select>
			<input name="myBtn" type="submit">
			<br />
		</form>

                    <ul id="filterlist">
                        <form  name="form" method="post"><li>Filter by:</li>
                            
                        <input type="submit" name="WEB" value="WEB" /> 
                        <input type="submit" name="GRAPHIC" value="GRAPHIC" /> 
                        <input type="submit" name="button3" value="Button 3" /> 
                        <input type="submit" name="button4" value="Button 4" />
                        </form> 
                    </ul>

                
                <?php echo $search_output;?>

                
                
                <?php  if(isset($_POST['WEB'])){
  $webcat = mysql_query("SELECT * FROM jobs 
    WHERE category = 'Web'")
        or die(mysql_error());

    while ($row = mysql_fetch_array($webcat)) {
    echo 'job: ' . $row['job'] . '<br />';
    }
}

  if(isset($_POST['GRAPHIC'])){
  $graphiccat = mysql_query("SELECT * FROM jobs 
    WHERE category = 'Graphic'")
        or die(mysql_error());

    while ($row = mysql_fetch_array($graphiccat)) {
    echo 'job: ' . $row['job'] . '<br />';
    }
} 
?>

            



            

        
        
   
</body></html>
