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
	<!--==================================================================================-->
	<title>Agricultural Advisor(s) | Home Page</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--======================================================================================-->
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
.newscontainer{
    background-color: #f0f0f0;
    height: 595px;
    width: 390px;
    margin: 0px;
    padding: 10px;
    font-size: 20px;
    border:1px solid #111;
    /*border-left: 2px solid #00FF00;*/
    text-align: center;
    overflow-x: hidden; /* Hide horizontal scrollbar */
    overflow-y: scroll; /* Add vertical scrollbar */
  }
</style>
</head>
<body>
<ul>
  <li style="float: left;"><a href="#">You are Welcome, <?php echo $data['Fullname'];?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="updateprofile.php">Edit Account Details</a></li>
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a href="adsense.php">Add Sensitization Information</a></li>
  <li><a class="active">Home</a></li>
</ul>
<hr>
<div class="container">
	<center><div class="newscontainer">
    <marquee direction="left" behavior="alternate"><h4>News Updates</h4></marquee>
    <hr>
    <dl>
      <?php
      $connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
      $qry = "SELECT * FROM sensitizationtbl";
      $res = mysqli_query($connect,$qry);
      while($data = mysqli_fetch_array($res)){
        echo "<dt><b><i>".$data['msgTitle']."</b></i></dt><hr>";
        echo "<dd>".$data['Details']."</dd><hr>";
      }
      ?>
    </dl>
  </div></center>
</div>
</body>
</html>
