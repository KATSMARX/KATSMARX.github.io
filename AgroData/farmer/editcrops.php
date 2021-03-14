<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment errors
session_start();
if ($_SESSION['FID'] == "") {
	echo "<script>alert('First Login again to continue!')</script>";
	header('refresh:0;url=../index.html');
}else{
	$UID = $_SESSION['FID'];
	$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
	$returnquery = "select * from farmertbl where ID='$UID'";
	$execquery = mysqli_query($connect,$returnquery);
	$data = mysqli_fetch_array($execquery);
}
$cpid = $_GET['cropid'];
$fetchcrop = "SELECT * FROM cropupload WHERE ID='$cpid'";
$cropqry = mysqli_query($connect,$fetchcrop);
$cropdata = mysqli_fetch_array($cropqry);
if (isset($_POST['submit'])) {
  $cid = $_POST['cropid'];
  $cname = $_POST['cropname'];
  $qty = $_POST['qty'];
  $uprc = $_POST['unitprice'];
  $loc = $_POST['location'];
  if (is_numeric($cname)) {
    echo "<script>alert('Please enter a valid Crop Name!')</script>";
  }elseif (!is_numeric($qty)) {
    echo "<script>alert('Invalid entry for the quantity!')</script>";
  }elseif (!is_numeric($uprc)) {
    echo "<script>alert('Invalid entry for the Unit Price!')</script>";
  }else {
    $updatequery = "UPDATE cropupload SET CropName='$cname', Quantity='$qty', UnitPrice='$uprc', CLocation='$loc' WHERE ID='$cid'";
    $confirmupdate = mysqli_query($connect,$updatequery);
    if ($confirmupdate) {
      echo "<script>alert('Crop Details updated in the database.')</script>";
      header('refresh:0.1;url=viewcrops.php');
    }else {
      echo "<script>alert('Error while updating crop details!')</script>";
      header('refresh:0.1;url=viewcrops.php');
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--==================================================================================-->
	<title>Farmers | Edit Crops</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--======================================================================================-->
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  margin-top: -20px;
  float: left;
  width: 50%;
  padding: 10px;
  /*height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.container{
  display: flex;
  justify-content: space-around;
}
</style>
</head>
<body>
<ul>
  <li style="float: left;"><a href="#">You are Welcome, <?php echo $data['Fullname']; ?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="profile.php">Edit Account Details</a></li>
  <li><a href="vieworders.php">View Orders</a></li>
  <li><a href="viewresponses.php">View Responses</a></li>
  <li><a href="addquery.php">Send Query</a></li>
  <li><a href="viewcrops.php">View Crop(s)</a></li>
  <li><a href="addcrops.php">Add Crop(s)</a></li>
  <li><a href="index.php">Home</a></li>
</ul>
<hr>
<div class="container">
	<form method="POST" action="editcrops.php">
		<h1 class="loginhead">Update <?php echo $cropdata['Crop']; ?> Details</h1>
		<div class="column">
		<div class="form_input1">
			<label>Crop ID</label>
			<input type="text" name="cropid" value="<?php echo $cropdata['ID']; ?>" required autocomplete="off" readonly>
		</div>
		<div class="form_input">
			<label>Crop Name</label>
			<input type="text" name="cropname" required autocomplete="off" value="<?php echo $cropdata['Crop']; ?>">
		</div>
		<div class="form_input">
			<label>Quantity (In kgs)</label>
			<input type="text" name="qty" required style="width: 50px;" value="<?php echo $cropdata['Quantity']; ?>">
		</div>
		<div class="form_input">
			<label>Unit Price (per kg)</label>
			<input type="text" name="unitprice" required autocomplete="off" style="width:150px;" value="<?php echo $cropdata['UnitPrice']; ?>">
		</div>
		<div class="form_input">
			<label>Location</label>
			<input type="text" name="location" required autocomplete="off" value="<?php echo $cropdata['Location']; ?>">
		</div>
    <div class="lower">
      <input type="submit" name="submit" value="Update Details">
    </div>
		</div>
	</form>
</div>
<!--<footer>
<h2>AgroData Collection and Farmer Sensitisation Information Management System</h2>
</footer>-->
</body>
</html>
