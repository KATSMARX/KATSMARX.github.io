<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment
session_start();
$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
if ($_SESSION['AdminID'] == "") {
  echo "<script>alert('First Login again to continue!')</script>";
  header('refresh:0;url=../index.php');
}

if (isset($_GET['bUID'])) {
  $id = $_GET['bUID'];
  $buser = "UPDATE logintbl SET UStatus=1 WHERE ID='$id'";
  $rbuser = mysqli_query($connect,$buser);
  if ($rbuser) {
    echo "<script>alert('Selected Farmer has been Blocked')</script>";
    header('refresh:0;url=viewfarmers.php');
  }else{
    echo "<script>alert('Error while Blocking Farmer. Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewfarmers.php');
  }
}
if (isset($_GET['rUID'])) {
  $id = $_GET['rUID'];
  $buser = "UPDATE logintbl SET UStatus=0 WHERE ID='$id'";
  $rbuser = mysqli_query($connect,$buser);
  if ($rbuser) {
    echo "<script>alert('Selected Farmer has been Unblocked')</script>";
    header('refresh:0;url=viewfarmers.php');
  }else{
    echo "<script>alert('Error while Unblocking Farmer. Sorry for any inconviniences.')</script>";
    header('refresh:0;url=viewfarmers.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--================================================================-->
	<title>Admin | View Farmers</title>
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
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a class="active">View Farmers</a></li>
  <li><a href="viewadvisors.php">View Advisors</a></li>
  <li><a href="index.php">Add Sensitization Information</a></li>
</ul>
<hr>
<div class="container">
  <center><table border="2" style="padding:10px; background-color:#f1f1f1; font-size:20px; text-align: center;">
    <tr class="tbhead">
      <td>ID</td>
      <td>Full Name</td>
      <td>Region</td>
      <td>Crop Grown</td>
      <td>Contact</td>
      <td>Action</td>
    </tr>
    <?php
      $ftchqry = "SELECT * FROM farmertbl";
      $ftchdetails = mysqli_query($connect,$ftchqry);
      if (mysqli_num_rows($ftchdetails)==0) {
        echo "<span style='color:red'>No farmer was found!</span>";
      }else{
      while ($data = mysqli_fetch_array($ftchdetails)) {
     ?>
     <tr>
       <td><?php echo $data['ID']; ?></td>
       <td><?php echo $data['Fullname']; ?></td>
       <td><?php echo $data['FRegion']; ?></td>
       <td><?php echo $data['Crop']; ?></td>
       <td><?php echo $data['Contact']; ?></td>
       <td>
         <?php
         $UID = $data['ID']; 
         $chkfarmer = "SELECT UStatus FROM logintbl WHERE ID='$UID'";
         $runchk = mysqli_query($connect,$chkfarmer);
         $userdata = mysqli_fetch_array($runchk);
         if ($userdata['UStatus']==0) {?>
          <a href="viewfarmers.php?bUID=<?php echo $data['ID'];?>">Block</a>
         <?php }else{ ?>
          <a href="viewfarmers.php?rUID=<?php echo $data['ID'];?>">Unblock</a>
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
