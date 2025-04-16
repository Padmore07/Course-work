<?php require "conn.php"; ?>
<style>
    .search-container{
        display: top;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .search-input {
        width: 500px;
        padding: 10px 15px;
        font-size: 16px;
        border: 2px solid #ccc;
        border-radius: 25px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-button:focus{
        border-color: #007BFF;
    }

    .search-button{
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color:#007BFF;
        border: none;
        border-radius:25px;
        margin-left:10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover{
        background-color: #0056b3;
    }
</style>

                       
<div class="span9">
                        <form class="form-horizontal row-fluid" action="current.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Search"><b>Search:</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Enter Book Name/Book Id." class="span8" required>
                                                <button type="submit" name="submit"class="btn">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <?php
                                    $rollno = $_SESSION['username'];
                                    if(isset($_POST['submit']))
                                        {$s=$_POST['title'];
                                            $sql="select * from record,books where RollNo = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and books.book_id = record.book_id and (record.book_id='$s' or Title like '%$s%')";

                                        }
                                    else
                                        $sql="select * from record,books where RollNo = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and books.book_id = record.book_id";

                                    $result=$conn->query($sql);
                                    $rowcount=mysqli_num_rows($result);

                                    if(!($rowcount))
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    else
                                    {

                                
                                    ?>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Book id</th>
                                      <th>Book name</th>
                                      <th>Issue Date</th>
                                      <th>Due date</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                <?php

                            
                            //$result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['book_id'];
                                $name=$row['title'];
                                $issuedate=$row['Date_of_Issue'];
                                $duedate=$row['Due_Date'];
                                $renewals=$row['Renewals_left'];
                            
                            ?>

                                    <tr>
                                      <td><?php echo $bookid ?></td>
                                      <td><?php echo $name ?></td>
                                      <td><?php echo $issuedate ?></td>
                                      <td><?php echo $duedate ?></td>
                                        <td><center>
                                        <?php 
                                         if($renewals)
                                            echo "
                                            <form action='?page=issue' method='POST' class='d-inline'>

											  <button type='submit' name='id' value='" . $row["book_id"] . "' class=' btn btn btn-success'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Renew </button>
											 </form>";
                                        ?>

                                        <form action='?page=issue' method='POST' class='d-inline'>

                                        <button type='submit' name='return' value="<?php echo $row["book_id"]; ?> " class=' btn btn btn-primary'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" <?php echo $row["book_id"]; ?> ")'>Return</button>
                                        </form>
                                        
                                        </center></td>
                                    </tr>
                            <?php }} ?>
                                    </tbody>
                                </table>
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>

        
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>

</html>

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

if(isset($_POST['return'])){
$id=$_POST['return'];

$roll=$_SESSION['username'];

$sql="insert into GABILMS.return (RollNo,BookId) values ('$roll','$id')";

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