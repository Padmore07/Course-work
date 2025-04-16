
<?php require "topbar.php";?>

<?php require "sidebar.php";?>

  

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <?php if (isset($_GET['user_deleted']) && $_GET['user_deleted'] == 1): ?>
    <p class="success">User deleted successfully.</p>
<?php endif; ?>

<?php if (isset($delete_error)) { echo "<p class='error'>$delete_error</p>"; } ?>
  
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <?php
       

        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            if ($page == "books") {
                include "manage_books.php"; // Include book management page
            } elseif ($page == "users") {
                include "manage_users.php"; // Include user management page
            }
           
            elseif ($page == "index") {
              include "index.php"; // Include person management page
          } 

          elseif ($page == "requests") {
            include "requests.php"; // Include person management page
        } 

          elseif ($page == "issue_requests") {
            include "issue_requests.php"; // Include person management page
        } 

        elseif ($page == "renew_requests") {
          include "renew_requests.php"; // Include person management page
      } 


      elseif ($page == "return_requests") {
        include "return_requests.php"; // Include person management page
    } 

    elseif ($page == "current") {
      include "current.php"; // Include person management page
  } 

  elseif ($page == "edit") {
    include "edit_book_details.php"; // Include person management page
} 

elseif ($page == "edit_user") {
  include "edit_user_details.php"; // Include person management page
} 


       

          

          elseif ($page == "delete_user") {
            include "delete_user.php"; // Include person management page
        } 
            else {
                echo "<h2>Welcome to the Admin Dashboard!</h2>

                <!-- Left side columns -->
        <div class='col-lg-8'>
          <div class='row'>

            <!-- Sales Card -->
            <div class='col-xxl-4 col-md-6'>
              <div class='card info-card sales-card'>

              

                <div class='card-body'>
                  

                  <div class='d-flex align-items-center'>
                    <div class='card-icon rounded-circle d-flex align-items-center justify-content-center'>
                      <i class='bi bi-book'></i>
                    </div>
                    <div class='ps-3'>
                      <h6></h6>
                      <span class='text-success small pt-1 fw-bold'>12%</span> <span class='text-muted small pt-2 ps-1'>increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

          
      </div>
                "; // Default content
            }
        } else {
            echo "<h2>Welcome to the Admin Dashboard!</h2>

            <!-- Left side columns -->
        <div class='col-lg-8'>
          <div class='row'>

               

              </div>
            </div><!-- End Sales Card -->

          
      </div>
            
            "; // Default content
        }

        $conn->close(); // Close the database connection
        ?>
        
    </section>
<?php require "footer.php";?>
  