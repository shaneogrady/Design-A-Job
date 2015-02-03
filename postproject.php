<?php
include_once "connect_to_mysql.php";
session_start();
$errorMsg = "";
if (isset($_SESSION['id'])) {
    
    $id = $_SESSION['id'];
    $newname ="";
    $target = "memberFiles/$id/" .$newname; 
    $target = $target . basename( $_FILES['photo']['name']);
    $toplinks = 
       '<a href="index.php">Home</a> &bull; 
	<a href="member_account.php">Account</a> &bull; 
	<a href="logout.php">Log Out</a>';
} else {
    echo 'Please <a href="login.php">log in</a> to access your account';
}


if (isset($_POST['project'])) {
    $project = $_POST['project'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $pic = ($_FILES['photo']['name']); 
    
    echo 'Your project has been posted <a href="member_account.php">click here</a> to return to your profile.<br /><br />';
   
    if ((!$project) || (!$category) || (!$description)) {
        
        $errorMsg = "You did not submit the following required information!<br /><br />";
        if (!$project) {
           $errorMsg .= "--- project Title";
        } else if (!$category) {
            $errorMsg .= "--- category";
        } else if (!$description) {
            $errorMsg .= "--- description";
        }
    } else {
    
    
    $sql = mysql_query("INSERT INTO projects (project_name, category, description, user_id, pic) 
        VALUES('$project','$category','$description','$id','$pic')") or die(mysql_error());
    
    
    
    $prid = mysql_insert_id();
    mkdir("memberFiles/projects/$prid", 0755);
    $newname = "project.jpg";
    move_uploaded_file($_FILES['fileField']['tmp_name'], "memberFiles/projects/$prid/$newname");
            
    
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload Project</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <script src="script/./jquery.textareaCounter.plugin.js" type="text/javascript"></script>
        <script type="text/javascript">
                var info;
                $(document).ready(function(){

                        var options2 = {
                        'maxCharacterSize': 120,
                        'originalStyle': 'originalTextareaInfo',
                        'warningStyle' : 'warningTextareaInfo',
                        'warningNumber': 40,
                        'displayFormat' : '#input/#max | #words words'
                        };
                        $('#testTextarea2').textareaCount(options2);
                });
        </script>
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

                        <div id="clientuploadpgtitle">Create a project</div>
                        <div id="clientuploadpage">
                                <div id="loginform">


                <form id="clientform" class="form-horizontal" method="POST" enctype="multipart/form-data">


                        <div class="control-group">
                                <label class="control-label" for="inputTitle">Title</label>
                        <div class="controls">
                                <textarea name="project" type="text" id="testTextarea2" placeholder="Your project title.."></textarea>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="inputDesc">Description</label>
                        <div class="controls">
                                <textarea name="description" id="inputDesc" placeholder="A description of what your project is.."></textarea>
                        </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="category">Job Category</label>
                            <div class="controls">
                                        <select name="category" multiple="multiple" type="text" id="jbcategory" placeholder="Category">
                                                <option value = "Animation">Animation</option>
                                                <option value = "Cartooning">Cartooning</option>
                                                <option value = "Drawing">Drawing</option>
                                                <option value = "Fashion">Fashion</option>
                                                <option value = "Graphic">Graphic</option>
                                                <option value = "Illustration">Illusration</option>
                                                <option value = "Painting">Painting</option>
                                                <option value = "Web">Web</option>
                                        </select>
                            </div>
                        </div>
                        <div class="control-group">
                                <label class="control-label" for="imgs">Upload Images</label>
                                <div class="controls">
                                        <input type="file" name="fileField" id="fileField"/>
                                </div>
                        </div>

                        <div class="control-group">
                        <div class="controls">
                                <button type="submit" name="upload" class="btn">Create</button>
                        </div>
                        </div>
                        </form>
                        </div>
        </div>

</div>

<?php include_once "sidebar.php"; ?>

        </div>
<div id="footer">
Copyright © Design A Job

	</div>
</body>

</html>