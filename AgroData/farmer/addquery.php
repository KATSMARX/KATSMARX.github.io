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
if (isset($_POST['submit'])) {
  $fid = $_POST['farmerid'];
  $tqry = $_POST['tquery'];
  if ($tqry=="") {
    echo "<script>alert('Please enter a valid Crop Name!')</script>";
  }else {
    $savequery = "INSERT INTO queriestbl(FID, Query) VALUES('$fid','$tqry')";
    $confirmsave = mysqli_query($connect,$savequery);
    if ($confirmsave) {
      echo "<script>alert('You query has been sent. It will be responded to soon.')</script>";
    }else {
      echo "<script>alert('Error while sending query. Try again later!')</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--==================================================================================-->
	<title>Farmers | Send Query</title>
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
textarea{
  font-size: 18px;
  outline: none;
  opacity: 100%;
  width: 400px;
  height: 120px;
  border: 3px solid #cccccc;
  padding-left: 10px;
  margin: 10px;
  margin-left: 18px;
  font-family: "Helvetica Neue", Helvetica, sans-serif;
  background-position: bottom right;
  background-repeat: no-repeat;
  border-radius: 2px;
  box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #f5f7f8;
  -webkit-transition: all .4s ease;
  -moz-transition: all .4s ease;
  transition: all .4s ease;
}
textarea:hover{
  border: 1px solid #b6bfc0;
  box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .7), 0 0 0 5px #f5f7f8;
}
textarea:focus{
  border: 1px solid #a8c9e4;
  box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #e6f2f9;
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
  <li><a class="active">Send Query</a></li>
  <li><a href="viewcrops.php">View Crop(s)</a></li>
  <li><a href="addcrops.php">Add Crop(s)</a></li>
  <li><a href="index.php">Home</a></li>
</ul>
<hr>
<center><div class="container">
	<form method="POST" action="addquery.php">
		<h1 class="loginhead">Send Query</h1>
		<div class="column">
		<div class="form_input1">
			<label>Farmer ID</label>
			<input type="text" name="farmerid" value="<?php echo $data['ID']; ?>" required autocomplete="off" readonly>
		</div>
    <div class="form_input">
      <label>Farmer Name</label>
      <input type="text" name="fname" required autocomplete="off" value="<?php echo $data['Fullname']; ?>" readonly>
    </div>
		<div class="form_input">
			<label>Your Query</label>
			<textarea name="tquery" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" required>Enter your query here...</textarea>
		</div>
    <div class="lower">
      <input type="submit" name="submit" value="SEND QUERY">
    </div>
		</div>
	</form>
</div></center>
</body>
</html>
