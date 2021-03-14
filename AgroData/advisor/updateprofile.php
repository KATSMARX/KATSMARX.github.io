<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//this is used to disable all late variable assignment
session_start();
if ($_SESSION['AID'] == "") {
  echo "<script>alert('First Login again to continue!')</script>";
  header('refresh:0;url=../index.html');
}else{
  $UID = $_SESSION['AID'];
  $connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
  $returnquery = "SELECT * FROM agriadvisortbl WHERE ID='$UID'";
  $execquery = mysqli_query($connect,$returnquery);
  $data = mysqli_fetch_array($execquery);
  $returnuser = "SELECT * FROM logintbl WHERE ID='$UID'";
  $execuquery = mysqli_query($connect,$returnuser);
  $userdata = mysqli_fetch_array($execuquery);
}
if (isset($_POST['submit'])) {
  $connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
  //Variable declaration and assignment
  $aid = $_POST['adid'];
  $fname = $_POST['fullname'];
  $aregion = $_POST['advisorregion'];
  $acompany = $_POST['advisorcompany'];
  $acontact = $_POST['advisorcontact'];
  $uname = $_POST['username'];
  $pswd1 = $_POST['password'];
  $pswd2 = $_POST['password1'];
  //variable declaration ends here

  //validation and saving of the submitted data into the database
  if (!(is_numeric($acontact))) {
  echo "<script>alert('Invalid Phone Number!')</script>";
  }elseif ((strlen($acontact) == 10) == false ) {
    echo "<script>alert('The phone number should be 10 digits long!')</script>";
    }elseif ($pswd1 <> $pswd2) {
    echo "<script>alert('The entered passwords do not match!')</script>";
    } else {
    //$fname,$aregion,$acompany,$acontact,$uname,$pswd1
    $updatedata = "UPDATE agriadvisortbl SET Fullname='$fname', FRegion='$aregion', Company='$acompany', Contact='$acontact' WHERE ID='$aid'";
    $updateuser = "UPDATE logintbl SET Username='$uname', PSWD='$pswd1' WHERE ID='$aid'";
    $checkupdated = mysqli_query($connect,$updatedata);
    $checkuserupdate = mysqli_query($connect,$updateuser);
    if ($checkupdated && $checkuserupdate) {
      echo "<script>alert('Account Details successfully updated. Use your New Credentials to login.')</script>";
      header("refresh:0.1; url=updateprofile.php");
    }else {
      echo "<script>alert('Error while updating account details! Please try again.')</script>";
    }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<!--====================================================================-->
  <title>Agricultural Advisor(s) | Update Profile</title>
  <link rel="stylesheet" type="text/css" href="../styles/AgroData.css">
  <link rel="icon" type="image/jpg" href="../Images/Carrots.jpg"/>
<!--====================================================================-->
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that float next to each other */
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
  <li style="float: left;"><a href="#">You are Welcome, <?php echo $data['Fullname'];?></a></li>
  <li><a href="logout.php">logout</a></li>
  <li><a class="active">Edit Account Details</a></li>
  <li><a href="viewqueries.php">View Queries</a></li>
  <li><a href="adsense.php">Add Sensitization Information</a></li>
  <li><a href="index.php">Home</a></li>
</ul>
<hr>
<div class="container">
  <div class="row">
  <form method="POST" action="updateprofile.php">
    <h1 class="loginhead">Update Account Details</h1>
    <div class="column">
    <div class="form_input1">
      <label>Advisor ID</label>
      <input type="text" name="adid" required autocomplete="off" style="width: 200px;" value="<?php echo $data['ID'];?>" readonly>
    </div>
    <div class="form_input">
      <label>Fullname</label>
      <input type="text" name="fullname" required autocomplete="off" value="<?php echo $data['Fullname'];?>">
    </div>
    <div class="form_input">
      <label>Region</label>
      <input type="text" name="advisorregion" required autocomplete="off" value="<?php echo $data['FRegion'];?>">
    </div>
    <div class="form_input">
      <label>Company</label>
      <input type="text" name="advisorcompany" required autocomplete="off" value="<?php echo $data['Company'];?>">
    </div>
    <div class="form_input">
      <label>Contact</label>
      <input type="text" name="advisorcontact" required autocomplete="off" maxlength="10" value="<?php echo $data['Contact'];?>">
    </div>
    </div>
    <div class="column">
    <div class="form_input">
      <label>Username</label>
      <input type="text" name="username" required autocomplete="off" value="<?php echo $userdata['Username'];?>">
    </div>
    <div class="form_input">
      <label>Password</label>
      <input type="password" name="password" required value="<?php echo $userdata['PSWD'];?>">
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
