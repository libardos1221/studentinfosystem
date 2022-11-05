<?php

$con = mysqli_connect("localhost","root","","joseph");
if ($con->connect_error)
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

  ?>