
                    <div class="container">
                        <center>
                        <a href="?page=issue_requests" class="btn btn-warning">Issue Requests</a>
                        <a href="?page=renew_requests" class="btn btn-info">Renew Request</a>
                        <a href="?page=return_requests" class="btn btn-danger">Return Requests</a>
                        </center>
                        <h1><i>Return Requests</i></h1>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Roll Number</th>
                                      <th>Book Id</th>
                                      <th>Book Name</th>
                                      <th>Dues</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                            $sql="select return.BookId,return.RollNo,Title,datediff(curdate(),Due_Date) as x from PADIILIB.return,PADIILIB.books,PADIILIB.record where return.BookId=books.book_id and return.BookId=record.book_id and return.RollNo=record.RollNo";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['BookId'];
                                $rollno=$row['RollNo'];
                                $name=$row['Title'];
                                $dues=$row['x'];
                                
                            
                           
                            ?>
                                    <tr>
                                      <td><?php echo strtoupper($rollno) ?></td>
                                      <td><?php echo $bookid ?></td>
                                      <td><b><?php echo $name ?></b></td>
                                      <td><?php 
                                      if($dues > 0)
                                          echo $dues;
                                          else
                                          echo 0; ?></td>
                                      <td><center>
                                                                                
                                        


                                        <form action='?page=return_requests' method='POST' class='d-inline'>
                                            <input type="hidden" name="id1" value="<?php echo $bookid?>">
                                            <input type="hidden" name="id2" value="<?php echo $rollno?>">
                                            <input type="hidden" name="id3" value="<?php echo $dues?>">
                                           
											  <button type='submit' name='accept'  class=' btn btn btn-success'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Accept </button>
											 </form>
                                        <!--a href="rejectreturn.php?id1=<?php echo $bookid; ?>&id2=<?php echo $rollno; ?>" class="btn btn-danger">Reject</a-->
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
if(isset($_POST['accept'])){

$bookid=$_POST['id1'];
$rollno=$_POST['id2'];
$dues=$_POST['id3'];





$sql1="update PADIILIB.record set Date_of_Return=curdate(),Dues='$dues' where book_id='$bookid' and RollNo='$rollno'";
 
if($conn->query($sql1) === TRUE)
{$sql3="update PADIILIB.books set Available=Available+1 where book_id='$bookid'";
 $result=$conn->query($sql3);
 $sql4="delete from PADIILIB.return where BookId='$bookid' and RollNo='$rollno'";
 $result=$conn->query($sql4);
 $sql6="delete from PADIILIB.renew where BookId='$bookid' and RollNo='$rollno'";
 $result=$conn->query($sql6);
 $sql5="insert into PADIILIB.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for return of BookId: $bookid  has been accepted',curdate(),curtime())";
 $result=$conn->query($sql5);
echo "<script type='text/javascript'>alert('Success')</script>";
//header( "Refresh:0.01; url=return_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    //header( "Refresh:1; url=return_requests.php", true, 303);

}


}


?>