
<?php
if(isset($_POST['submit'])){
    $to = "katomarkend@gmail.com";
    $from ="orix";
    $subject = "Comment from Orix";
    $contact=$_POST['contact'];
    $message = $_POST['comment'];
    mail($to,$from , $subject, $contact, $message);
    echo "Mail Sent. to " . $to . ", we will contact you shortly Thank you.";
    header('Location:order.html');
	exit();
}
	
?>