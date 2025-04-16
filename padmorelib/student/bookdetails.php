
                    
                    <div class="card">
                             <div class="card-head">
                                <h3>Book Details</h3>
                            </div>
                            <div class="card-body">
                        <?php
                        if(isset($_POST['id'])){
	
                            
                            $x=$_POST['id'];
                            
                            $sql="select * from PADIILIB.books where book_id='$x'";
                            $result=$conn->query($sql);
                            $row=$result->fetch_assoc();    
                            
                                $bookid=$row['book_id'];
                                $name=$row['title'];
                                $publisher=$row['author'];
                                $year=$row['year'];
                                $avail=$row['available'];
                                echo "<b>Book ID:</b> ".$bookid."<br><br>";
                                echo "<b>Title:</b> ".$name."<br><br>";
                                $sql1="select * from LMS.author where BookId='$bookid'";
                                $result=$conn->query($sql1);
                                echo "<b>Author:</b> ".$publisher."<br><br>";
                                echo "<b>Year:</b> ".$year."<br><br>";
                                echo "<b>Availability:</b> ".$avail."<br><br>";

                                
                        }
                           
                            ?>
                            
                        <a href="?page=books" class="btn btn-primary">Go Back</a>                             
                               </div>
                           </div>
                            </div>
                    <!--/.span3-->
                    <!--/.span9-->
                
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
                    
                    <!--/.span9-->
        