<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment
session_start();
$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
if ($_SESSION['AdminID'] == "") {
  echo "<script>alert('First Login again to continue!')</script>";
  header('refresh:0;url=../index.php');
}
if (isset($_GET['dQID'])) {
  $id = $_GET['dQID'];
  $dqry = "UPDATE queriestbl SET QStatus=1 WHERE ID='$id'";
  $rundqry = mysqli_query($connect,$dqry);
  if ($rundqry) {
    echo "<script>alert('Selected query has been Deleted.')</script>";
    header('refresh:0;url=viewqueries.php');
  }else{
    echo "<script>alert('Error while Deleting selected query! Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewqueries.php');
  }
}
if (isset($_GET['rQID'])) {
  $id = $_GET['rQID'];
  $dqry = "UPDATE queriestbl SET QStatus=0 WHERE ID='$id'";
  $rundqry = mysqli_query($connect,$dqry);
  if ($rundqry) {
    echo "<script>alert('Selected query has been Restored.')</script>";
    header('refresh:0;url=viewqueries.php');
  }else{
    echo "<script>alert('Error while Restoring selected query! Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewqueries.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--================================================================-->
	<title>Admin | View Queries</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--==================================================================-->
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
.container{
  display: flex;
  justify-content: space-around;
}
</style>
</head>
<body>
<ul>
  <li style="float: left;"><a href="#">You are Welcome, Admin</a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="viewresponses.php">View Responses</a></li>
  <li><a class="active">View Queries</a></li>
  <li><a href="viewfarmers.php">View Farmers</a></li>
  <li><a href="viewadvisors.php">View Advisors</a></li>
  <li><a href="index.php">Add Sensitization Information</a></li>
</ul>
<hr>
<div class="container">
  <center><table border="2" style="padding:10px; background-color:#f1f1f1; font-size:20px; text-align: center;">
    <tr class="tbhead">
      <td>Query ID</td>
      <td>Full Name</td>
      <td>Contact</td>
      <td>Query</td>
      <td>Action</td>
    </tr>
    <?php
      $ftchqry = "SELECT queriestbl.ID,Query,Fullname,Contact,QStatus FROM queriestbl,farmertbl WHERE (queriestbl.FID=farmertbl.ID)"; //AND !(queriestbl.ID=responsetbl.QID)
      $ftchdetails = mysqli_query($connect,$ftchqry);
      if (mysqli_num_rows($ftchdetails)==0) {
        echo "<span style='color:red'>No queries were found!</span>";
      }else{
      while ($data = mysqli_fetch_array($ftchdetails)) {
     ?>
     <tr>
       <td><?php echo $data['ID']; ?></td>
       <td><?php echo $data['Fullname']; ?></td>
       <td><?php echo $data['Contact']; ?></td>
       <td><?php echo $data['Query']; ?></td>
       <td>
         <?php 
         if ($data['QStatus']==0) {?>
          <a href="viewqueries.php?dQID=<?php echo $data['ID'];?>">Delete Query</a>
         <?php }else{ ?>
          <a href="viewqueries.php?rQID=<?php echo $data['ID'];?>">Restore Query</a>
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
