<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment
session_start();
if ($_SESSION['AID'] == "") {
	echo "<script>alert('First Login again to continue!')</script>";
	header('refresh:0;url=../index.php');
}else{
	$UID = $_SESSION['AID'];
	$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
	$returnquery = "SELECT * FROM agriadvisortbl WHERE ID='$UID'";
	$execquery = mysqli_query($connect,$returnquery);
	$data = mysqli_fetch_array($execquery);
}
  if (isset($_POST['submit'])) {
    $msgTitle = $_POST['infoTitle'];
    $msg = $_POST['finfo'];
    //echo "Message title: ".$msgTitle;
    //echo "<br>Message: ".$msg;
    $savedetails = "INSERT INTO sensitizationtbl(msgTitle,Details) VALUES('$msgTitle','$msg')";
    $savequery = mysqli_query($connect,$savedetails);
    if ($savequery) {
      echo "<script>alert('You have added sensitization information. Thanks for your time.')</script>";
    }else{
      //echo "Error description: ".mysqli_error($connect);
      echo "<script>alert('Error while adding information! Try again later.')</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<!--===================================================================-->
	<title>Agricultural Advisor(s) | Farmer Sensitization</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--====================================================================-->
<style>
* {
  box-sizing: border-box;
}
.container{
  display: flex;
  justify-content: space-around;
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
  <li style="float: left;"><a href="#">You are Welcome, <?php echo $data['Fullname'];?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="updateprofile.php">Edit Account Details</a></li>
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a class="active">Add Sensitization Information</a></li>
  <li><a href="index.php">Home</a></li>
</ul>
<hr>
<div class="container">
  <center><div class="column">
    <form method="POST" action="adsense.php">
    <div class="form_input">
      <label>info Title</label>
      <input type="text" name="infoTitle" required autocomplete="off">
    </div>
    <div class="form_input">
      <label>Message</label>
      <textarea name="finfo" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" required>Type the sensitization message here...</textarea>
    </div>
    <div class="lower">
    <input type="submit" name="submit" value="SUBMIT">
    </div>
    </form>
  </div></center>
</div>
</body>
</html>
