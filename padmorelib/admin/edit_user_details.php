
        <!--<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">
        <div class="modal-content">-->
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
            $sql = "select * from users where user_id='$bookid'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $password = password_hash($row['password'], PASSWORD_DEFAULT);
            //$name=$row['Title'];
            //$publisher=$row['Publisher'];
            //$year=$row['Year'];
            //$avail=$row['Availability'];

        }
        ?>

    <form action='?page=users' method='POST'>

  <input type="hidden"  class="form-control shadow-none" name="id" value="<?php  echo $row["user_id"];?>">
    <div class="modal-header">
      <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Edit</h5>
      <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row">
      <div class="col-md-6 ps-0 mb-3"> 
       
        <label class="form-label">Full Name</label>
        <input type="text"  class="form-control shadow-none" name="fullname" value="<?php  echo $row["fullname"];?>">
        </div>

        <div class="col-md-6 ps-0 mb-3">
                 <label for="reg_username">Username:</label>
                <input type="text" name="username"   class="form-control shadow-none" required value="<?php  echo $row["username"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_password">Password:</label>
                <input type="text" name="password"  required class="form-control shadow-none" value="<?php  echo $password?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_email">Email:</label>
                <input type="email" name="email"  required class="form-control shadow-none" value="<?php  echo $row["email"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_role">Role:</label>
                <select name="role" id="role" class="form-control shadow-none" value="<?php  echo $row["role"];?>">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
                </select><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <select name="Category" id="Category" class="form-control shadow-none" >
					<option value="GEN" ><?php  echo $row["Category"];?></option>
					<option value="OBC">OBC</option>
					<option value="SC">SC</option>
					<option value="ST">ST</option>
				</select>
                </div>
               

      </div>
    
    <div class="modal-footer d-flex align-items-center justify-content-between mb-4">
      <button type="submit" name="user_edit" class="btn btn-primary">Save</button>
      
      
    </div>
  

 </form>
 </div>

 </div>
 </div>
        
