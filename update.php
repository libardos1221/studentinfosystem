<?php
session_start();
require 'connection.php';
?>

<!doctype html>
<html lang="en">
  <head>
  <style>
 body {
    background:#59ABE3;
    margin:0
}

 .row {
    width:340px;
    height:440px;
    background:#e6e6e6;
    border-radius:8px;
    box-shadow:0 0 40px -10px #000;
    margin:calc(50vh - 220px) auto;
    padding:20px 30px;
    max-width:calc(100vw - 40px);
    box-sizing:border-box;
    font-family:'Montserrat',sans-serif;
    position:relative
}
 input[type=text], select {
  width: 100%;
  padding: 12px 15px;
  margin: 4px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
button[type=submit] {
  width: 50%;
  background-color: #4CAF50;
  color: white;
  padding: 9px 15px;
  margin: 4px 0;
  border: 2px solid #4fff;
  border-radius: 4px;
  cursor: pointer;
}
button[type=submit]:hover {
  background-color: #45a049;
}
h2 {
font-family:'Droid Serif',serif;
text-align: center;
}
.stid {
    color: black;
    font-family: arial;
    padding: 5px 10px;
    font-weight:bold;

}

.btn2 {
    background-color: white;
    font-family: Arial;
    font-size: 13px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    padding: 2px 5px;
    border: 2px solid #2c2c2c;
    color: black;
    margin: 0 5px 0 80px;
}

    </style>
    <title>Student Update</title>
</head>
<body>

    <div class="container mt-5">

        

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Form 
                        </h2>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="update.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-3">
                                        <label>Student ID</label><br>
                                        <div class="stid"><?= $student['id']; ?></div>
                                    </div>
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="fname" value="<?=$student['fname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" value="<?=$student['lname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">

                                    <label>Contact Number</label>
                                        <input type="text" name="contact" value="<?=$student['contact'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Update Info
                                        </button>
                                        
                            <a href="table.php" class="btn2 btn-danger float-end">BACK</a>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No ID Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);

    $query = "UPDATE students SET fname='$fname', lname='$lname', contact='$contact' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Data Updated Successfully";
        header("Location: table.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Error in Updating Data";
        header("Location: table.php");
        exit(0);
    }

}
?>
