<?php
if(isset($_POST['id'])){
	

$id=$_POST['id'];

$roll=$_SESSION['username'];

$sql="insert into GABILMS.renew (RollNo,BookId) values ('$roll','$id')";

if($conn->query($sql) === TRUE)
{
echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
//header( "Refresh:0.01; url=current.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    //header( "Refresh:0.01; url=current.php", true, 303);

}

}


?>