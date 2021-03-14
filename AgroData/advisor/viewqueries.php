<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment
session_start();
if ($_SESSION['AID'] == "") {
  echo "<script>alert('First Login again to continue!')</script>";
  header('refresh:0;url=../index.php');
}else{
  $UID = $_SESSION['AID'];
  $connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
  $returnquery = "select * from agriadvisortbl where ID='$UID'";
  $execquery = mysqli_query($connect,$returnquery);
  $data = mysqli_fetch_array($execquery);
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--================================================================-->
	<title>Agricultural Advisor(s) | View Queries</title>
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
  <li style="float: left;"><a href="#">You are Welcome, <?php echo $data['Fullname'];?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="updateprofile.php">Edit Account Details</a></li>
  <li><a class="active">View Queries</a></li>
  <li><a href="adsense.php">Add Sensitization Information</a></li>
  <li><a href="index.php">Home</a></li>
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
      $ftchqry = "SELECT queriestbl.ID,Query,Fullname,Contact FROM queriestbl,farmertbl WHERE (queriestbl.FID=farmertbl.ID AND QStatus=0)"; //AND !(queriestbl.ID=responsetbl.QID)
      $ftchdetails = mysqli_query($connect,$ftchqry);
      if (mysqli_num_rows($ftchdetails)==0) {
        echo "<span style='color:red'>There are no queries added yet!</span>";
      }else{
      while ($data = mysqli_fetch_array($ftchdetails)) {
     ?>
     <tr>
       <td><?php echo $data['ID']; ?></td>
       <td><?php echo $data['Fullname']; ?></td>
       <td><?php echo $data['Contact']; ?></td>
       <td><?php echo $data['Query']; ?></td>
       <td><a href="replyquery.php?QID=<?php echo $data['ID'];?>">Reply</a></td>
     </tr>
   <?php } 
  }
   ?>
 </table></center>
</div>
</body>
</html>
