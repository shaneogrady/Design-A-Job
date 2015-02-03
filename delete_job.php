<?php
// if this page was requested using a GET request then delete the book
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // if book id is not empty then try to delete the book
    if (!empty($_GET['job'])) {
        // read book id from request
        $jobId = $_GET['job'];

        // define DB connection data and connect to database
        include_once 'connect_to_mysql.php';

        // query string to execute including placeholder '?' for book id
        $sql = "DELETE FROM jobs WHERE job = $jobId";

        // book id to be inserted into placeholder
        $params = array($jobId);

        // prepare and execute the query using parameters
        $stmt = $link->prepare($sql);
        $status = $stmt->execute($params);

        // if update executed ok then redirect the user to the view_books page;
        // redirection is used to prevent the request being accidently
        // resubmitted if the response page is reloaded by the user
        if ($status == true) {
            header("Location: edit_jobs.php");
        }
        // else if update did not execute ok then send the user an error message
        else {
            $error_info = $stmt->errorInfo();
            $error_message = "failed to delete job: {$error_info[2]} - error code {$error_info[0]}";
            require 'error.php';
        }
    }
    // else if book id is empty then send the user back to the view books page
    // with an error message
    else {
        $error_message = "book id not specified";
        require 'edit_jobs.php';
    }
}
// if this page was not requested using a GET request then ignore it
else {
}
?>
