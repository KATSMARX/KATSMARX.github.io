<?php
?>
<!DOCTYPE html>
<html>
<head>
<!--========================================================================-->
	<title>AgroData IMS | FAQs</title>
	<link rel="stylesheet" type="text/css" href="styles/AgroData.css">
	<link rel="icon" type="image/jpg" href="Images/Carrots.jpg"/>
<!--========================================================================-->
<style>
* {
  box-sizing: border-box;
}
.container{
  text-align: center;
  float: left;
  height: 578px;
  width: 100%;
}
.table{
    width: 90%;
    color: #ffffff;
    margin-left: 52px;
    border: 1px solid grey;
  }
  .table th, td{
    padding:3px;
    border: 1px solid grey;
  }
  td{
    border-bottom:2px;
    
  }
.side{
  height:578px;
  width: 20%; 
  float: left;
  border-right: 1px solid grey;
  background-color:;
  box-shadow: 0 5px 10px 5px rgba(0,0,0,0.3);
}
.FAQ{
  height:578px;
  width:100%;
  float: left;
  background-color:;
  overflow-x: hidden; /* Hide horizontal scrollbar */
  overflow-y: scroll #1B3815; /* Add vertical scrollbar */
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
  <li><a class="active">FAQ</a></li>
  <li><a href="advisorregister.php">Advisor</a></li>
  <li><a href="farmerregister.php">Farmer</a></li>
  <li><a href="Index.php">Home</a></li>
</ul>
<hr>
<div class="container">
  <div class="FAQ">
    <table style="padding:0px; font-size:18px;"  class="table">
    <tr class="tbhead">
      <td>Query</td>
      <td>Response</td>
      <td>Advisor Name</td>
      <td>Contact</td>
      <td>Company</td>
    </tr>
    <?php
      $connect = mysqli_connect("localhost","root","","agrodb"); //connection to the DB
      $ftchqry = "SELECT responsetbl.ID, Query, Response, Fullname, Contact, Company,RStatus FROM queriestbl,responsetbl,agriadvisortbl WHERE (queriestbl.ID=responsetbl.QID AND agriadvisortbl.ID=responsetbl.AAID)";
      $ftchdetails = mysqli_query($connect,$ftchqry);
      if (mysqli_num_rows($ftchdetails)==0) {
        echo "<span style='color:red'>No response found!</span>";
      }else{
      while ($data = mysqli_fetch_array($ftchdetails)) {
     ?>
     <tr>
       <td><?php echo $data['Query']; ?></td>
       <td><?php echo $data['Response']; ?></td>
       <td><?php echo $data['Fullname']; ?></td>
       <td><?php echo $data['Contact']; ?></td>
       <td><?php echo $data['Company']; ?></td>
     </tr>
   <?php } 
    }
   ?>
 </table>
  </div>
</div>
<footer>
<center>All rights are resereved by Agnes Nalubega &copy; <script>document.write(new Date().getFullYear())</script></center>
</footer>
</body>
</html>
