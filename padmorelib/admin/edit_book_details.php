
       
        <div class="container-fluid" style="padding: 1%;">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					
					<button class="btn btn-outline-info shadow-none me-lg-2 me-3" ><i class="fa fa-plus"></i> <h3>Update User Details</h3></button>
				</large>
				
			</div>
            
			<div class="card-body">
            <div>&nbsp;</div>
            <div class="row ">           

       
    
    
        <?php
        if(isset($_POST['edit'])){
            $bookid = $_POST['edit'];
            $sql = "select * from books where book_id='$bookid'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            
          
        }
        ?>

    <form action='?page=books' method='POST'>

  <input type="hidden"  class="form-control shadow-none" name="id" value="<?php  echo $row["book_id"];?>">
    <div class="modal-header">
      <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Edit</h5>
      <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row">
      <div class="col-md-6 ps-0 mb-3"> 
       
        <label class="form-label">Book Name</label>
        <input type="text"  class="form-control shadow-none" name="title" value="<?php  echo $row["title"];?>">
        </div>

        <div class="col-md-6 ps-0 mb-3">
                 <label for="reg_username">Author:</label>
                <input type="text" name="author"   class="form-control shadow-none" required value="<?php  echo $row["author"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_password">ISBN:</label>
                <input type="text" name="isbn"  required class="form-control shadow-none" value="<?php  echo $row["isbn"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_email">Year:</label>
                <input type="numbers" name="year"  required class="form-control shadow-none" value="<?php  echo $row["year"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_role">Quantity:</label>
                <input type="text" name="quantity"  required class="form-control shadow-none" value="<?php  echo $row["quantity"];?>">
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_role">Available:</label>
                <input type="number" name="available"  required class="form-control shadow-none" value="<?php  echo $row["available"];?>">
                </div>
               

      </div>
    
    <div class="modal-footer d-flex align-items-center justify-content-between mb-4">
      <button type="submit" name="book_edit" class="btn btn-primary">Save</button>
      
      
    </div>
  

 </form>
 </div>

 </div>
 </div>
        
