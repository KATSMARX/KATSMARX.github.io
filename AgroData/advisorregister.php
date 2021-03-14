<?php
if (isset($_POST['submit'])) {
	$connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
	//Variable declaration and assignment
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
  	//Preventing users from having similar accounts
  	$accqry = "SELECT * FROM logintbl WHERE Username='$uname' AND PSWD='$pswd1'";
  	$chkqry = mysqli_query($connect,$accqry);
  	if (mysqli_num_rows($chkqry)>0) {
  	echo "<script>alert('An account with the same credentials already exists! Please consider changing either the Username or Password. Thank you.')</script>";
  	}else{
  	//Assigning ID depending on the one in the database
  	$fetchID = mysqli_query($connect,"SELECT max(ID) AS originalID FROM logintbl");
  	$originalID = mysqli_fetch_array($fetchID);
  		if (is_null($originalID['originalID'])) {
    	$newID = 1;
  		} else {
    	$newID = $originalID['originalID'];
    	$newID = $newID + 1;
  	}//$fname,$aregion,$acompany,$acontact,$uname,$pswd1
  	$savedata = "insert into agriadvisortbl(ID,Fullname,FRegion,Company,Contact) values('$newID','$fname','$aregion','$acompany','$acontact')";
  	$saveuser = "insert into logintbl(ID,Username,PSWD,Role) values('$newID','$uname','$pswd1','Advisor')";
  	$checksaved = mysqli_query($connect,$savedata);
    $checkuser = mysqli_query($connect,$saveuser);
    if ($checksaved && $checkuser) {
      echo "<script>alert('Account successfully created. You can now login.')</script>";
      header("refresh:0.1; url=advisorregister.php");
    }else {
      echo "<script>alert('Error while creating account! Please try again.')</script>";
    }
  	}
  	}
}
?>
<!DOCTYPE html>
<html>
<head>
<!--========================================================================-->
	<title>AgroData IMS |Advisor Register</title>
	<link rel="stylesheet" type="text/css" href="styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="Images/Carrots.jpg"/>
<!--========================================================================-->
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  margin:0px;
  width: 100%;
  padding: 3px;
  /*height: 300px; /* Should be removed. Only for demonstration */
}
.form_input{
margin:0px;
  width: 60%;
  padding: 0px;
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
	height: 578px;
  	width: 100%;
}
.name{
	font-size: 15px;
}
.in{
	height:50px;
  	width: 30px;
}
.main{
		float: left;
		background-color:transparent;
  		height: 578px;
  		width: 20%;
  		margin: 0px;
  		border-right:2px  grey; 
  		}
.middle{
		background-color:transparent;
		float: left;
  		height: 578px;
  		width: 39%;
  		margin: 0px;
  		border-left:1px, grey; 
}
.form{
		float: left;
		background-color:transparent;
  		height: 578px;
  		width: 27%;
  		margin: 0px;
}
.realform{
		background-color:transparent;
  		height: 540px;
  		width: 97%;
  		margin-left: : 50px;
  		font-size: 20px;
  		border:3px solid white;
  		border-radius:5px; 
  		box-shadow: 0 5px 8px 5px rgba(0,0,0,0.3);
  		text-align:left;
  		overflow-x: hidden; /* Hide horizontal scrollbar */
    	overflow-y: scroll; /* Add vertical scrollbar */
}
.videopart{
	height:50%;
  	width: 50%;
  	padding-left: 35px;
}
.success{
	height:50%;
  	width: 100%;

}
.Welcome{
height:50%;
width: 100%;
margin-left:10px;		
}
.benefits{
height:50%;
width: 100%;	
margin-left:10px;
}
u{
	color: white;
}

footer{
	float:left;
		height:34px; 
  		width: 100%;
  		margin: 0px;
  		font-size: 15px;
  		color:white; 
  		border:1px; 
  		box-shadow: 0 5px 10px 5px rgba(0,0,0,0.7);
  		text-align: center;	
  		background-color: #1B3815;
	}
</style>
</head>
<body>
<ul>
  <li style="float: left;"><a href="#">Agro &amp; Farmers' Marketing & Sensitization Management System</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="searchcrops.php">Search For Crops</a></li>
  <li><a href="faq.php">FAQ</a></li>
  <li><a class="active">Advisor</a></li>
  <li><a href="farmerregister.php">Farmer</a></li>
  <li><a href="Index.php">Home</a></li>
</ul>
<hr>
<div class="container">

		<div class="main">
			<div class="Welcome">
				<u><h3 style="color: white;">Welcome!</h3></u>
			<p>
			Get a chance of registering as an advisor!
			Here you get a chance to connect with experts <br> in Agriculture and Advise farmers accordingly
				
			</p>
			<h4>...........Give Them advice!...........</h4>
			</div>
			<div class="benefits">
			<u><h3 style="color: white;">Benefits,Signup now!</h3></u>&nbsp
			<ol>
				<li>Exposure to farmers' request.
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Access to Succes stories &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Free advice for experts &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Access to Succes stories &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Connect with experts &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Access to Succes stories &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
				<li>Free advice for experts &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li><br>
			</ol>
			</div>
		</div>

		<div class="middle">
			<u><center><h3 style="color: white;">A message for the  Minister!</h3></center></u>
			<div class="videopart">
				<video width="460" height="240" controls>
					<source src="farmer/uploads/Agriculture Minister Sempijja advises farmers on better agro-economic practices.mp4" type="video/mp4">
				</video>
			</div>
			<hr>
			<div class="success">
			<u><center><h3 style="color: white;">Sucess stories!</h3></center></u>
			<p>
			Livelihood through farming 21 dependents.
			Eastof Arua district in Rhino camp sub county,you find Mr.Shaban Juma a soft spoken 42 years old
			Juma is married to three wives and 18 children have married and started their own families while eight(8)
			are still in school. About two years ago Juma was worried about feeding his family.
			</p>
			</div>
		</div>
		<div class="form">
			&nbsp
			<div class="realform">
				<center><h3 style="color: white;">Register here as advisor!</h3></center>
				<hr>
			<form method="POST" action="advisorregister.php">
	
			<label class="name">Fullname</label>
			<input type="text" name="fullname" required autocomplete="off">
		
			<label class="name">Region</label>
			<input type="text" name="advisorregion" required autocomplete="off">
		
			<label class="name">Company</label>
			<input type="text" name="advisorcompany" required autocomplete="off">

			<label class="name">Contact</label>
			<input type="text" name="advisorcontact" required autocomplete="off" maxlength="10">
		
			<label class="name">Username</label>
			<input type="text" name="username" required autocomplete="off">
		
			<label class="name">Password</label>
			<input type="password" name="password" required>
		
			<label class="name">Confirm Password</label>
			<input type="password" name="password1" required>
		<input type="submit" name="submit" value="SUBMIT">
	</div>
	</form>
</div>
</div>
</div>
<footer>
<center>All rights are resereved by Agnes Nalubega &copy; <script>document.write(new Date().getFullYear())</script></center>
</footer>
</body>
</html>
