<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment sqlite_error_string(error_code)					2
session_start();
$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
if ($_SESSION['AdminID'] == "") {
	echo "<script>alert('First Login again to continue!')</script>";
	header('refresh:0;url=../index.php');
}
if (isset($_GET['dRID'])) {
  $id = $_GET['dRID'];
  $dr = "UPDATE responsetbl SET RStatus=1 WHERE ID='$id'";
  $rundr = mysqli_query($connect,$dr);
  if ($rundr) {
    echo "<script>alert('Selected Response has been Deleted.')</script>";
    header('refresh:0;url=viewresponses.php');
  }else{
    echo "<script>alert('Error while Deleting Response. Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewresponses.php');
  }
}
if (isset($_GET['rRID'])) {
  $id = $_GET['rRID'];
  $dr = "UPDATE responsetbl SET RStatus=0 WHERE ID='$id'";
  $rundr = mysqli_query($connect,$dr);
  if ($rundr) {
    echo "<script>alert('Selected Response has been Restored.')</script>";
    header('refresh:0;url=viewresponses.php');
  }else{
    echo "<script>alert('Error while Restoring Response. Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewresponses.php');
  }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<!--=============================================================-->
	<title>Admin | View Responses</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--===============================================================-->
<style>
* {
  box-sizing: border-box;
}
.container{
  text-align: center;
}
.tbhead td{
  background-color: rgba(255,0,0,0.2);
}
td{
  background-color: rgb(255,255,255);
}
</style>
</head>
<body>
<ul>
  <li style="float: left;"><a href="#">You are Welcome, Admin</a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a class="active">View Responses</a></li>
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a href="viewfarmers.php">View Farmers</a></li>
  <li><a href="viewadvisors.php">View Advisors</a></li>
  <li><a href="index.php">Add Sensitization Information</a></li>
</ul>
<hr>
<div class="container">
  <center><table border="2" style="padding:10px; background-color:#f1f1f1; font-size:20px; text-align: center;">
    <tr class="tbhead">
      <td>Query</td>
      <td>Response</td>
      <td>Advisor Name</td>
      <td>Contact</td>
      <td>Company</td>
      <td>Action</td>
    </tr>
    <?php
      $ftchqry = "SELECT responsetbl.ID, Query, Response, Fullname, Contact, Company,RStatus FROM queriestbl,responsetbl,agriadvisortbl WHERE (queriestbl.ID=responsetbl.QID AND agriadvisortbl.ID=responsetbl.AAID)";
      $ftchdetails = mysqli_query($connect,$ftchqry);
      if (mysqli_num_rows($ftchdetails)==0) {
        echo "<span style='color:red'>No response found!</span>";
      }else{
      while ($data = mysqli_fetch_array($ftchdetails)) {
     ?>
     <tr>
       <td><?php echo $data['Query']; ?></td>
       <td><?php echo $data['Response']; ?></td>
       <td><?php echo $data['Fullname']; ?></td>
       <td><?php echo $data['Contact']; ?></td>
       <td><?php echo $data['Company']; ?></td>
       <td>
         <?php 
         if ($data['RStatus']==0) {?>
          <a href="viewresponses.php?dRID=<?php echo $data['ID'];?>">Delete Response</a>
         <?php }else{ ?>
          <a href="viewresponses.php?rRID=<?php echo $data['ID'];?>">Restore Response</a>
         <?php } ?>
       </td>
     </tr>
   <?php } 
    }
   ?>
 </table></center>
</div>
</body>
</html>
