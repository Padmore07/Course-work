
        
                    <div class="span9">
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Message</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $rollno=$_SESSION['username'];
                            $sql="select * from PADIILIB.message where RollNo='$rollno' order by Date DESC,Time DESC";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $msg=$row['Msg'];
                                $date=$row['Date'];
                                $time=$row['Time'];
                            
                           
                            ?>
                                    <tr>
                                      <td><?php echo $msg ?></td>
                                      <td><?php echo $date ?></td>
                                      <td><?php echo $time ?></td>
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
