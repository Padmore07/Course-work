<?php
// Add User (Modal Form Handling)
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $Category = $_POST['Category'];

    // Check for duplicate username or email (similar to registration)
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $add_user_error = "Username or email already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, fullName, email, role, Category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $password, $fullname, $email, $role, $Category);

        if ($stmt->execute()) {
            $add_user_success = "User added successfully.";
        } else {
            $add_user_error = "Error adding user: " . $stmt->error;
        }
        $stmt->close();
    }
    $check_stmt->close();
}


if(isset($_POST['delete'])){
    $event_id=$_POST['delete'];
    $query ="DELETE FROM users WHERE user_id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        echo "<script>alert('User Deleted Successfully');</script>";

    }else{

        echo "<script>alert('Event Not Deleted ');</script>";


    }
}


if(isset($_POST['user_edit']))
{
  $user_id = $_POST["id"];
    $fullname = $_POST['fullname'];
    $username=$_POST['username'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $email=$_POST['email'];
    $role=$_POST['role'];
    $Category=$_POST['Category'];

$sql1="update users set fullname='$fullname', username='$username', password='$password', email='$email', Category='$Category', role='$role' where user_id='$user_id'";



if($conn->query($sql1) === TRUE){
echo "<script type='text/javascript'>alert('Success Updated')</script>";
//header( "Refresh:0.01; url=book.php", true, 303);
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
}

   


?>

<div class="container-fluid" style="padding: 1%;">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					
					<button class="btn btn-outline-primary shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal"><i class="fa fa-plus"></i> Add User</button>
				</large>
				
			</div>
            
			<div class="card-body">
            <div>&nbsp;</div>
            <div class="row ">
				<table class="table table-bordered table-striped" id="loan-list">
                

<?php
// manage_books.php (Example)
echo "<h2>Manage Users</h2>";

// Add user management logic here (display user, add, edit, delete)
// Example: Display users from the database
$sql = "SELECT * FROM users"; // Replace 'users' with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-hover table-striped' id='loan-list'>";
    echo "<tr><th class='text-center'>Username</th><th class='text-center'>Fullname</th><th class='text-center'>Email</th><th class='text-center'>Role</th><th class='text-center'>Action</th></tr>"; // Table headers
    while($row = $result->fetch_assoc()) {

        echo "<tr><td class='text-center'>" . $row["username"]. "</td><td class='text-center'>" . $row["fullname"]. "</td><td class='text-center'>" . $row["email"]. "</td><td class='text-center'>" . $row["role"]. "</td>";
       
         echo "
         
         <td class='text-center'>

         
         <form action='?page=edit_user' method='POST' class='d-inline'>

         <button type='submit' name='edit' value='".$row["user_id"]."' class=' btn btn btn-info'  data-toggle='tooltip' data-original-title='Edit' onclick='return confirmEdit(" . $row["user_id"] . ")'> Edit </button>
        </form>
         

         <form action='' method='POST' class='d-inline'>

         <button type='submit' name='delete' value='".$row["user_id"]."' class=' btn btn btn-danger'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmDelete(" . $row["user_id"] . ")'> Delete </button>
        </form>
         </td>";
         echo"</tr>";

        
         
      
        
    // Table Body
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Add forms for adding, editing, and deleting books
?>


<!-- Modal for edit -->
<?php
if(isset($_POST["edit"])){
    $id =$_POST["edit"];
    $sql = "SELECT * FROM users WHERE user_id=$id"; // Replace 'users' with your table name
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
}
            
    ?>

<div>
  
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

<div class="modal-dialog modal-lg">
  <div class="modal-content">
  <form>
  <input type="hidden"  class="form-control shadow-none" name="fullname" value="<?php  echo $row["fullname"];?>">
    <div class="modal-header">
      <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Edit</h5>
      <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row">
      <div class="col-md-6 ps-0 mb-3"> 
        <?php if (isset($reg_error)) { echo "<p class='error'>$reg_error</p>"; } ?>
        <?php if (isset($reg_success)) { echo "<p class='success'>$reg_success</p>"; } ?>
        <label class="form-label">Full Name</label>
        <input type="text"  class="form-control shadow-none" name="fullname" value="<?php  echo $row["fullname"];?>">
        </div>

        <div class="col-md-6 ps-0 mb-3">
                 <label for="reg_username">Username:</label>
                <input type="text" name="username" id="reg_username"  class="form-control shadow-none" required value="<?php  echo $row["username"];?>"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_password">Password:</label>
                <input type="password" name="password" id="reg_password" required class="form-control shadow-none"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_email">Email:</label>
                <input type="email" name="email" id="reg_email" required class="form-control shadow-none"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_role">Role:</label>
                <select name="role" id="role" class="form-control shadow-none">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
                </select><br>
                </div>
               

      </div>
    
    <div class="modal-footer d-flex align-items-center justify-content-between mb-4">
      <button type="submit" class="btn btn-primary">Save</button>
      
      <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
    </div>
  </div>
 </div>
 </div>

 </form>
</div>



<div>
  
      <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form method="post" action="">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-lines-fill fs-3 me-2"></i>Add User</h5>
            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <span class="badge rounded-pill bg-light text-danger mb-3 text-wrap  lh-base">
          Note: You must fill all details.
            </span>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3"> 
                <?php if (isset($reg_error)) { echo "<p class='error'>$reg_error</p>"; } ?>
                <?php if (isset($reg_success)) { echo "<p class='success'>$reg_success</p>"; } ?>
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control shadow-none" name="fullname">
                </div>
                  
                <div class="col-md-6 ps-0 mb-3">
                 <label for="reg_username">Username:</label>
                <input type="text" name="username" id="reg_username" class="form-control shadow-none" required><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_password">Password:</label>
                <input type="password" name="password" id="reg_password" required class="form-control shadow-none"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_email">Email:</label>
                <input type="email" name="email" id="reg_email" required class="form-control shadow-none"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_role">Role:</label>
                <select name="role" id="role" class="form-control shadow-none">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
                </select><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <select name="Category" id="Category" class="form-control shadow-none">
					<option value="GEN">General</option>
					<option value="OBC">OBC</option>
					<option value="SC">SC</option>
					<option value="ST">ST</option>
				</select>
                </div>

            <div class="text-center">
            <div class="modal-footer d-flex align-items-center justify-content-between mb-4">
            <input type="submit" name="register" value="Register" class="btn btn-success">
            </form>
            </div>
              </div>
            
      
  <script>
        function confirmDelete(user_id) {
            return confirm("Are you sure you want to delete user with ID " + user_id + "?");
        }

        function confirmEdit(user_id) {
            return confirm("Are you sure you want to edit user with ID " + user_id + "?");
        }
    </script>



