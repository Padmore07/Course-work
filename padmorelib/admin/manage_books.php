<?php
// Adding books codes 
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author']; 
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];
    $aveliable = $_POST['aveliable'];
	  $year = $_POST['year'];

   
   
   
        $stmt = $conn->prepare("INSERT INTO books (title, author, isbn, quantity, available, year) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $author, $isbn, $quantity, $aveliable, $year);

        if ($stmt->execute()) {
            echo "<script>alert('Book Added Successfully');</script>";
        } else {
            $add_user_error = "Error adding user: " . $stmt->error;
        }
        $stmt->close();
    }
   

//deletion of books
if(isset($_POST['delete'])){
    $event_id=$_POST['delete'];
    $query ="DELETE FROM books WHERE book_id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        echo "<script>alert('User Deleted Successfully');</script>";

    }else{

        echo "<script>alert('Event Not Deleted ');</script>";


    }
}

//editing of books
if(isset($_POST['book_edit']))
{
    $book_id = $_POST["id"];
    $title = $_POST['title'];
    $author=$_POST['author'];
    $available=$_POST['available'];
    $isbn=$_POST['isbn'];
    $year=$_POST['year'];
    $quantity=$_POST['quantity'];

$sql1="update books set title='$title', author='$author', available='$available', isbn='$isbn', year='$year', quantity='$quantity' where book_id='$book_id'";



if($conn->query($sql1) === TRUE){
echo "<script type='text/javascript'>alert('Success Updated')</script>";

}
else
{
echo "<script type='text/javascript'>alert('Error')</script>";
}
}



?>

<div class="container-fluid" style="padding: 1%;">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					
					<button class="btn btn-outline-primary shadow-none me-lg-2 me-1" data-bs-toggle="modal" data-bs-target="#registerModal"><i class="ri-contacts-book-line"></i> Add Book</button>
				</large>
				
			</div>
			<div class="card-body">
            <div>&nbsp;</div>
            <div class="row ">
				<table class="table table-bordered table-striped" id="loan-list">
                

<?php
// manage_books.php (Example)
echo "<h2>Manage Books</h2>";

// Add user management logic here (display user, add, edit, delete)
// Example: Display books from the database
$sql = "SELECT * FROM books"; // Replace 'users' with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-hover table-striped' id='loan-list'>";
    echo "<tr><th class='text-center'>Tittle</th><th class='text-center'>Author</th><th class='text-center'>ISBN</th><th class='text-center'>Quantity</th><th class='text-center'>Available</th><th class='text-center'>Action</th></tr>"; // Table headers
    while($row = $result->fetch_assoc()) {

        echo "<tr><td class='text-center'>" . $row["title"]. "</td><td class='text-center'>" . $row["author"]. "</td><td class='text-center'>" . $row["isbn"]. "</td><td class='text-center'>" . $row["quantity"]. "</td><td class='text-center'>" . $row["available"]. "</td>";
       
         echo "<td class='text-center'>

         <form action='?page=edit' method='POST' class='d-inline'>

         <button type='submit' name='edit' value='".$row["book_id"]."' class=' btn btn btn-info'  data-toggle='tooltip' data-original-title='Edit' onclick='return confirmEdit(" . $row["book_id"] . ")'> Edit </button>
        </form>

         
         
         

         <form action='' method='POST' class='d-inline'>

         <button type='submit' name='delete' value='".$row["book_id"]."' class=' btn btn btn-danger'  data-toggle='tooltip' data-original-title='Delete' onclick='return confirmDelete(" . $row["book_id"] . ")'> Delete </button>
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




<div>
  
      <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form method="post" action="">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-lines-fill fs-3 me-2"></i>Add Book</h5>
            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <span class="badge rounded-pill bg-success text-warning mb-3 text-wrap  lh-base">
          Note: You must fill all details.
            </span>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3"> 
                <?php if (isset($reg_error)) { echo "<p class='error'>$reg_error</p>"; } ?>
                <?php if (isset($reg_success)) { echo "<p class='success'>$reg_success</p>"; } ?>
                <label class="form-label">Title:</label>
                <input type="text" class="form-control shadow-none" name="title" required>
                </div>
                  
                <div class="col-md-6 ps-0 mb-3">
                 <label for="reg_author">Author:</label>
                <input type="text" name="author" id="reg_author" class="form-control shadow-none" required><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_isbn">ISBN:</label>
                <input type="text" name="isbn" id="reg_isbn" required class="form-control shadow-none"><br>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                <label for="reg_email">Quantity:</label>
                <input type="number" name="quantity" id="reg_quantity" required class="form-control shadow-none"><br>
                </div>

				<div class="col-md-6 ps-0 mb-3">
                <label for="reg_aveliable">Available:</label>
                <input type="number" name="aveliable" id="reg_aveliable" required class="form-control shadow-none"><br>
                </div>

				<div class="col-md-6 ps-0 mb-3">
                <label for="reg_aveliable">Year:</label>
                <input type="number" name="year" id="reg_aveliable" required class="form-control shadow-none"><br>
                </div>

                

            <div class="text-center">
            <div class="modal-footer d-flex align-items-center justify-content-between mb-4">
            <input type="submit" name="add" value="Add Book" class="btn btn-success">
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



