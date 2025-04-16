
<?php
session_start();

if ($_SESSION['username']) {
    ?>
<?php require "topbar.php";?>

<?php require "sidebar.php";?>

  

    <div class="pagetitle">
      <h1>Dashboard</h1>
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
                include "books.php"; // Include book management page
            } 
            
            elseif ($page == "users") {
                include "manage_users.php"; // Include user management page
            }
            elseif ($page == "index") {
              include "index.php"; // Include person management page
          }
          
          elseif ($page == "issue_request") {
            include "request.php"; // Include person management page
        }

        elseif ($page == "message") {
          include "message.php"; // Include person management page
      }

      elseif ($page == "bookdetails") {
        include "bookdetails.php"; // Include person management page
    }

    elseif ($page == "issue") {
      include "current.php"; // Include person management page
  }

  elseif ($page == "renew_request") {
    include "renew.php"; // Include person management page
}
 

    
          
            else {
                echo "<h2>Welcome to the User Page!</h2>

                <!-- Left side columns -->
        <div class='col-lg-8'>
          <div class='row'>

            
          
      </div>
                "; // Default content
            }
        } else {
            echo "<h2>Welcome to the User Page!</h2>

            <!-- Left side columns -->
        <div class='col-lg-8'>
          <div class='row'>

            <!-- Sales Card -->
            <div class='col-xxl-4 col-md-6'>
              <div class='card info-card sales-card'>

                <div class='filter'>
                  
                </div>

                <div class='card-body'>
                 

                  <div class='d-flex align-items-center'>
                    <div class='card-icon rounded-circle d-flex align-items-center justify-content-center'>
                      <i class='bi bi-book'></i>
                    </div>
                   
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

          
      </div>
            
            "; // Default content
        }

        $conn->close(); // Close the database connection
        ?>
        
    </section>
<?php require "footer.php";?>
<?php }
	else {
		echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
	} ?>