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
<?php 
if ($_SESSION['username']) {
    ?>
			
			<form class="form-horizontal row-fluid" action="?page=books" method="post">
				
                                        <div class="search-container">
                                            <label class="control-label" for="Search"><b>Search:</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Enter Name/ID of Book" class="search-input" required>
                                                <button type="submit" name="submit"class="btn btn-success">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <?php
                                    if(isset($_POST['submit']))
                                        {$s=$_POST['title'];
                                            $sql="select * from PADIILIB.books where book_id='$s' or title like '%$s%'";
                                        }
                                    else
                                        $sql="select * from PADIILIB.books order by Available DESC";

                                    $result=$conn->query($sql);
                                    $rowcount=mysqli_num_rows($result);

                                    if(!($rowcount))
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    else
                                    {

                                    
                                    ?>
                        <table class="table table-hover table-bordered table-striped" id = "tables">
                                  <thead >
                                    <tr>
                                      <th style="color:white; background:red">Book id</th>
                                      <th style="color:black; background:yellow">Book name</th>
                                      <th style="color:white; background:green">Availability</th>
                                      <th style="color:white; background:black">Author</th>
                                      <th style="text-align:center; color:white; background:brown">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                            
                            //$result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['book_id'];
                                $name=$row['title'];
                                $avail=$row['available'];
                                $author=$row['author'];
                            ?>
                                    <tr>
                                      <td><?php echo $bookid ?></td>
                                      <td><?php echo $name ?></td>
                                      <td><b><?php 
                                           if($avail > 0)
                                              echo "<font color=\"green\">AVAILABLE</font>";
                                            else
                                            	echo "<font color=\"red\">NOT AVAILABLE</font>";

                                                 ?>
                                                 	
                                                 </b></td> 
                                                 <td><?php echo $author ?></td>
                                      <td><center>
                                       
										<form action='?page=bookdetails' method='POST' class='d-inline'>

											  <button type='submit' name='id' value="<?php echo $bookid; ?>" class=' btn btn btn-primary'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'> Details </button>
											 </form>
                                      	<?php
                                      	if($avail > 0)
                                      		echo "<form action='' method='POST' class='d-inline'>

											  <button type='submit' name='issue' value='".$row["book_id"]."' class=' btn btn btn-success'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmIssue(" . $row["book_id"] . ")'>Issue</button>
											 </form>";


											
                                        ?>
                                        </center></td>
                                    </tr>
                               <?php }} ?>
                               </tbody>
                                </table>
                            </div>
                    <!--/.span3-->
                    <!--/.span9-->
                
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
                    <!--/.span9-->
                </div>


<?php
//require('dbconn.php');


if(isset($_POST['issue'])){
	
	$roll=$_SESSION['username'];
    $id=$_POST['issue'];

    // Check if the request has already been sent
    $check_query = "SELECT * FROM PADIILIB.record WHERE RollNo = '$roll' AND book_id = '$id'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "<script type='text/javascript'>alert('Request has been Already Sent.');</script>";
    } else {
        // Insert new record
        $query = "INSERT INTO PADIILIB.record (RollNo, book_id, Time) VALUES ('$roll', '$id', CURTIME())";
        if(mysqli_query($conn, $query)) {
            echo "<script type='text/javascript'>alert('Request has been Sent to Admin for approval.');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error sending request.');</script>";
        }
    }
}

?>

				<script>
        function confirmDelete(user_id) {
            return confirm("Are you sure you want to issue this book with ID " + book_id + "?");
        }

        function editRecord(user_id) {
            return confirm("Are you sure you want to edit user with ID " + user_id + "?");
        }
    </script>

<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>