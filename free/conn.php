<?php

$conn=mysqli_connect("myprj.cipcikz0lkkc.ap-south-1.rds.amazonaws.com","db_expert","khuljasimsim","myprj");
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>