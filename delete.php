<?php
session_start();
require 'connection.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Data Deleted Successfully";
        header("Location: table.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Error in Deleting Data";
        header("Location: table.php");
        exit(0);
    }
}
?>