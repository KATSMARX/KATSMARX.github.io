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
	$uqry = "SELECT * FROM logintbl WHERE ID='$UID'";
	$execuqry = mysqli_query($connect,$uqry);
	$udata = mysqli_fetch_array($execuqry);
}
if (isset($_POST['submit'])) {
	$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
	//fullname,farmerregion,farmercrop,farmercontact,username,password,password1,submit
	//Variable declaration and assignment
	$fid = $_POST['farmerID'];
	$fname = $_POST['fullname'];
	$fregion = $_POST['farmerregion'];
	$fcrop = $_POST['farmercrop'];
	$fcontact = $_POST['farmercontact'];
	$uname = $_POST['username'];
	$pswd1 = $_POST['password'];
	$pswd2 = $_POST['password1'];
	//variable declaration ends here

	//validation and saving of the submitted data into the database
	if (!(is_numeric($fcontact))) {
	echo "<script>alert('Invalid Phone Number!')</script>";
	}elseif ((strlen($fcontact) == 10) == false ) {
    echo "<script>alert('The phone number should be 10 digits long!')</script>";
  	}else if ($pswd1 <> $pswd2) {
    echo "<script>alert('The entered passwords do not match!')</script>";
  	} else {
	//Code that update the farmer's details after successfully validating the data
  	$updatedata = "UPDATE farmertbl SET Fullname='$fname',FRegion='$fregion',Crop='$fcrop',Contact='$fcontact' WHERE ID='$fid'";
  	$updateuser = "UPDATE logintbl SET Username='$uname',PSWD='$pswd2' WHERE ID='$fid'";
  	$checkupdated = mysqli_query($connect,$updatedata);
    $checkuserupdate = mysqli_query($connect,$updateuser);
    if ($checkupdated && $checkuserupdate) {
      echo "<script>alert('Account details successfully updated. Use new credentials to login.')</script>";
      header("refresh:0.1; url=profile.php");
    }else {
      echo "<script>alert('Error while updating account details! Please try again.')</script>";
    }
  	}
}
?>
<!DOCTYPE html>
<html>
<head>
<!--===============================================================-->
	<title>Farmers | Update Profile</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--===============================================================-->
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
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
<li><a class="active">Edit Account Details</a></li>
<li><a href="vieworders.php">View Orders</a></li>
<li><a href="viewresponses.php">View Responses</a></li>
<li><a href="addquery.php">Send Query</a></li>
<li><a href="viewcrops.php">View Crop(s)</a></li>
<li><a href="addcrops.php">Add Crop(s)</a></li>
<li><a href="index.php">Home</a></li>
</ul>
<hr>
<div class="container">
	<div class="row">
	<form method="POST" action="profile.php">
		<h1 class="loginhead">Update Account Details</h1>
		<div class="column">
		<div class="form_input1">
			<label>Farmer ID</label>
			<input type="text" name="farmerID" required autocomplete="off" value="<?php echo $data['ID']; ?>" style="width:200px; " readonly>
		</div>
		<div class="form_input">
			<label>Fullname</label>
			<input type="text" name="fullname" required autocomplete="off" value="<?php echo $data['Fullname']; ?>">
		</div>
		<div class="form_input">
			<label>Region</label>
			<input type="text" name="farmerregion" required autocomplete="off" value="<?php echo $data['FRegion']; ?>">
		</div>
		<div class="form_input">
			<label>Main Crop Grown</label>
			<input type="text" name="farmercrop" required autocomplete="off" value="<?php echo $data['Crop']; ?>">
		</div>
		<div class="form_input">
			<label>Contact</label>
			<input type="text" name="farmercontact" required autocomplete="off" maxlength="10" value="<?php echo $data['Contact']; ?>">
		</div>
		
		</div>
		<div class="column">
		<div class="form_input">
			<label>Username</label>
		<input type="text" name="username" required autocomplete="off" value="<?php echo $udata['Username']; ?>">
		</div>
		<div class="form_input">
			<label>Password</label>
			<input type="password" name="password" required value="<?php echo $udata['PSWD']; ?>">
		</div>
		<div class="form_input">
			<label>Confirm Password</label>
			<input type="password" name="password1" required>
		</div>
		<div class="lower">
		<input type="submit" name="submit" value="SUBMIT">
		</div>
		</div>
	</form>
</div>
</div>
</body>
</html>
