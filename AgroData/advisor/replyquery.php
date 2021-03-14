<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment errors
session_start();
$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
if ($_SESSION['AID'] == "") {
  echo "<script>alert('First Login again to continue!')</script>";
  header('refresh:0;url=../index.html');
}else{
  $UID = $_SESSION['AID'];
  $returnquery = "select * from agriadvisortbl where ID='$UID'";
  $execquery = mysqli_query($connect,$returnquery);
  $data = mysqli_fetch_array($execquery);
}
$qid = $_GET['QID'];
$fetchquery = "SELECT * FROM queriestbl WHERE ID='$qid'";
$qrydetails = mysqli_query($connect,$fetchquery);
$qrydata = mysqli_fetch_array($qrydetails);
if (isset($_POST['submit'])) {
  $qid = $_POST['qid'];
  $aaid = $_POST['aaid'];
  $qresponse = $_POST['qresponse'];
  if ($qresponse=="") {
    echo "<script>alert('Please enter the response to the selected query!')</script>";
  }else{
    $addqry = "INSERT INTO responsetbl(QID,AAID,Response) VALUES('$qid','$aaid','$qresponse')";
    $confirmsave = mysqli_query($connect,$addqry);
    if ($confirmsave) {
      echo "<script>alert('Response has been sent. Thanks for your time')</script>";
      header('refresh:0.1;url=viewqueries.php');
    }else {
      echo "<script>alert('Error while responding to query! Please try again')</script>";
      header('refresh:0.1;url=viewqueries.php');
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<!--====================================================================-->
	<title>Agricultural Advisor(s) | Reply Queries</title>
	<link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--====================================================================-->
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
  <li style="float: left;"><a class="active">You are Welcome, <?php echo $data['Fullname'];?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a href="updateprofile.php">Edit Account Details</a></li>
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a href="adsense.php">Add Sensitization Information</a></li>
  <li><a href="index.php">Home</a></li>
</ul>
<hr>
<div class="container">
	<form method="POST" action="replyquery.php">
		<h1 class="loginhead">Respond to Query</h1>
		<div class="column">
		<div class="form_input1">
      <label>Query ID</label>
      <input type="text" name="qid" value="<?php echo $qrydata['ID']; ?>" required autocomplete="off" readonly>
    </div>
    <div class="form_input">
      <label>Advisor ID</label>
      <input type="text" name="aaid" required autocomplete="off" value="<?php echo $data['ID']; ?>" readonly>
    </div>
    <div class="form_input">
      <label>Your Name</label>
      <input type="text" name="fname" required autocomplete="off" value="<?php echo $data['Fullname']; ?>" readonly>
    </div>
    <div class="form_input">
      <label>Farmer Query</label>
      <textarea name="fquery" readonly><?php echo $qrydata['Query']; ?></textarea>
    </div>
  </div>
    <div class="column">
    <div class="form_input">
      <label>Your Response</label>
      <textarea name="qresponse" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')" required>Enter your query here...</textarea>
    </div>
    <div class="lower">
      <input type="submit" name="submit" value="Send Response">
    </div>
		</div>
  </div>
	</form>
</div>
</body>
</html>
