<?php
    session_start();
    require 'connection.php';
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Student List</title>
    
</head>
<body>
<center>
<!-- <video autoplay muted loop id="myVideo">
  <source src="bvid.mp4" type="video/mp4">
</video>
-->
    <div class="container mt-4">
   <!-- PHP CODE TO SHOW MESSAGE -->
    <?php
                if(isset($_SESSION['message']))
                {
                    ?>
                <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo $_SESSION['message'];   unset ($_SESSION['message']);
                }
                ?>
                </div>
        <div class="row">
            <div class="col-md-12">
              
                <div class="card">
                    <div class="card-header">
                        <h1>STUDENT INFORMATION</h1>
                        <br>
                        
                        <a href="add.php" class="btn3 btn-success btn-sm">Add Student Info</a>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['fname']; ?></td>
                                                <td><?= $student['lname']; ?></td>
                                                <td><?= $student['contact']; ?></td>
                                      
                                                <td>
                                        <form>
                                                <a href="update.php?id= <?= $student['id']; ?>"class="btn1 btn-success btn-sm">Update</a>
                                        </form>
                                                    <form action="delete.php" method="POST">
                                                    <button type="submit" name="delete_student" value=" <?=$student['id']; ?> " 
                                                    class="btn2 btn-link" onclick="if (!confirm('Delete this Record?')) { return false }">
                                                    <span>Delete</span>
                                                    </button>
                                                    </form>
                                                </td>
                                            </tr>
                                       
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</center>    
</body>
</html>