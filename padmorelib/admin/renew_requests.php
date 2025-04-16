
                    <div class="span9">
                        <center>
                        <a href="?page=issue_requests" class="btn btn-warning">Issue Requests</a>
                        <a href="?page=renew_requests" class="btn btn-info">Renew Request</a>
                        <a href="?page=return_requests" class="btn btn-danger">Return Requests</a>
                        </center>
                        <h1><i>Renew Requests</i></h1>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Roll Number</th>
                                      <th>Book Id</th>
                                      <th>Book Name</th>
                                      <th>Renewals Left</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                            $sql="select * from record,books,renew where renew.BookId=books.book_id and renew.RollNo=record.RollNo and renew.BookId=record.book_id";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['book_id'];
                                $rollno=$row['RollNo'];
                                $name=$row['title'];
                                $renewals=$row['Renewals_left'];
                            
                           
                            ?>
                                    <tr>
                                      <td><?php echo strtoupper($rollno) ?></td>
                                      <td><?php echo $bookid ?></td>
                                      <td><b><?php echo $name ?></b></td>
                                      <td><?php echo $renewals ?></td>
                                      <td><center>
                                        <?php
                                        if($renewals > 0)
                                        {echo " <form action='?page=renew_requests' method='POST' class='d-inline'>
                                            <input type='hidden' name='id1' value='$bookid'>
                                            

											  <button type='submit' name='id2' value='$rollno' class=' btn btn btn-success'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Accept </button>
											 </form>

                                            ";}
                                         ?>
                                        <!--a href="rejectrenewal.php?id1=<?php echo $bookid; ?>&id2=<?php echo $rollno; ?>" class="btn btn-danger">Reject</a-->
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


<?php
if(isset($_POST['id2'])){
$bookid=$_POST['id1'];
$rollno=$_POST['id2'];

$sql="select Category from users where RollNo='$rollno'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$category=$row['Category'];



if($category == 'GEN' || $category == 'OBC' )
{$sql1="update record set Due_Date=date_add(Due_Date,interval 60 day),Renewals_left=0 where BookId='$bookid' and RollNo='$rollno'";
 
if($conn->query($sql1) === TRUE)
{$sql3="delete from renew where BookId='$bookid' and RollNo='$rollno'";
 $result=$conn->query($sql3);
 
 $sql5="insert into message (RollNo,Msg,Date,Time) values ('$rollno','Your request for renewal of BookId: $bookid  has been accepted',curdate(),curtime())";
 $result=$conn->query($sql5);
echo "<script type='text/javascript'>alert('Success')</script>";
//header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    //header( "Refresh:0.01; url=renew_requests.php", true, 303);

}
}
else
{$sql2="update record set Due_Date=date_add(Due_Date,interval 180 day),Renewals_left=0 where book_id='$bookid' and RollNo='$rollno'";

if($conn->query($sql2) === TRUE)
{$sql4="delete from renew where BookId='$bookid' and RollNo='$rollno'";
 $result=$conn->query($sql4);
 $sql6="insert into message (RollNo,Msg,Date,Time) values ('$rollno','Your request for renewal of BookId: $bookid has been accepted',curdate(),curtime())";
 $result=$conn->query($sql6);
echo "<script type='text/javascript'>alert('Success')</script>";
//header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    //header( "Refresh:0.01; url=renew_requests.php", true, 303);

}
}
}


?>