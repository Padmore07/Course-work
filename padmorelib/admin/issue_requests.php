
<!-- rejecting of user codes -->
<?php

if(isset($_POST['reject'])){
	
    $bookid=$_POST['id'];

    $rollno=$_POST['username'];
    $name=$_POST['title'];

    

    
        $query="delete from record where RollNo='$rollno' and book_id='$bookid'";
        //$query ="DELETE FROM record WHERE book_id='$bookid'";
        $query_run = mysqli_query($conn, $query);
    
        if($query_run){
            $sql1="insert into message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid with this name $name has been rejected',curdate(),curtime())";
            $result=$conn->query($sql1);
           echo "<script type='text/javascript'>alert('Success')</script>";
    
        }else{
    
            echo "<script type='text/javascript'>alert('Error')</script>";
        //header( "Refresh:0.01; url=issue_requests.php", true, 303);
    
    
        }
    }
   
?>


<!-- accepting user request codes -->

<?php


if(isset($_POST['accept'])){
	
    $bookid=$_POST['id'];

    $rollno=$_POST['username'];
    $name=$_POST['title'];


$sql="select * from PADIILIB.users where RollNo='$rollno'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$category=$row['Category'];



if($category == 'MAT' || $category == 'BIO' )
{$sql1="update PADIILIB.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 60 day),Renewals_left=1 where book_id='$bookid' and RollNo='$rollno'";
 
if($conn->query($sql1) === TRUE)
{$sql3="update PADIILIB.books set Availability=Availability-1 where book_id='$bookid'";
 $result=$conn->query($sql3);
 $sql5="insert into PADIILIB.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid  has been accepted',curdate(),curtime())";
 $result=$conn->query($sql5);
echo "<script type='text/javascript'>alert('Success')</script>";
//header( "Refresh:0.01; url=issue_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    //header( "Refresh:1; url=issue_requests.php", true, 303);

}
}
else
{$sql2="update PADIILIB.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 180 day),Renewals_left=1 where book_id='$bookid' and RollNo='$rollno'";

if($conn->query($sql2) === TRUE)
{$sql4="update PADIILIB.books set available=available-1 where book_id='$bookid'";
 $result=$conn->query($sql4);
 $sql6="insert into PADIILIB.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid has been accepted',curdate(),curtime())";
 $result=$conn->query($sql6);
echo "<script type='text/javascript'>alert('Success')</script>";
//header( "Refresh:1; url=issue_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    //header( "Refresh:1; url=issue_requests.php", true, 303);

}
}
}

?>

                    <div class="span9">
                        <center>
                        <a href="?page=issue_requests" class="btn btn-warning">Issue Requests</a>
                        <a href="?page=renew_requests" class="btn btn-info">Renew Request</a>
                        <a href="?page=return_requests" class="btn btn-danger">Return Requests</a>
                        </center>
                        <h1><i>Issue Requests</i></h1>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Roll Number</th>
                                      <th>Book Id</th>
                                      <th>Book Name</th>
                                      <th>Availabilty</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                            $sql="select * from PADIILIB.record,PADIILIB.books where Date_of_Issue is NULL and record.book_id=books.book_id order by Time";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['book_id'];
                                $rollno=$row['RollNo'];
                                $name=$row['title'];
                                $avail=$row['available'];
                            
                                
                            ?>
                                    <tr>
                                      <td><?php echo strtoupper($rollno) ?></td>
                                      <td><?php echo $bookid ?></td>
                                      <td><b><?php echo $name ?></b></td>
                                      <td><?php echo $avail ?></td>
                                      <td><center>
                                        <?php
                                        if($avail > 0)
                                        {echo "<form action='' method='POST' class='d-inline'>
                                            <input type='hidden' name='id' value='$bookid'>
                                            <input type='hidden' name='username' value='$rollno'>
                                            <input type='hidden' name='title' value='<?php echo $name?>'>
                                           
											  <button type='submit' name='accept'  class=' btn btn btn-success'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Accept </button>
											 </form>";}
                                         ?>
                                       <!-- <a href="reject.php?id1=<?php //echo $bookid ?>&id2=<?//php echo $rollno ?>" class="btn btn-danger">Reject</a>-->


                                       <form action='' method='POST' class='d-inline'>
                                            <input type="hidden" name="id" value="<?php echo $bookid?>">
                                            <input type="hidden" name="username" value="<?php echo $rollno?>">
                                            <input type="hidden" name="title" value="<?php echo $name?>">
                                           
											  <button type='submit' name='reject'  class=' btn btn btn-danger'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Reject </button>
											 </form>
                                    </center></td>
                                    </tr>
                               <?php } ?>
                               </tbody>
                                </table>
                            </div>
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>



