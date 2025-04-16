<?php
//session_start();
require('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Padii Library</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/booktree.png" rel="icon">
  <link href="assets/img/bookicon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    header{
     
    }

    body{
      font-family: 'Arial', sans-serif;
      background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab,rgb(70, 8, 16));
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      color: #fff;
      overflow-x: hidden;
    }
    @keyframes gradientBG{
      0% {
        background-position: 0% 50%;
      }
      50%{
        background-position: 100% 50%;
      }
      100%{
        background-position: 0% 50%;
      }
    }

    .marqueecont{
      width: 30%;
      overflow: hidden;
      white-space: nowrap;
      background: linear-gradient(90deg,rgb(16, 17, 17),rgb(7, 95, 51));
      padding: 5px 0;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Marquee text styling */
    .marquee {
      display: inline-block;
      padding-left: 100%; /* Start off-screen */
      animation: marquee 10s linear infinite;
      font-size: 24px;
      font-weight: bold;
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Marquee animation */
    @keyframes marquee {
      0% {
        transform: translateX(100%);
      }
      100% {
        transform: translateX(-100%);
      }
    }

    /* Optional: Add hover effect */
    .marquee-container:hover .marquee {
      animation-play-state: paused;
    }


    /* Footer Styles */
    

   
   

    
   
    
   
    

    

      
  </style>



  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class=" fixed-top d-flex align-items-center" style=" background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(50px);
      padding: 1rem;
      position: fixed;
      width: 100%;
     
      tranform: translateX(-50%);
      
      border-radius:  30px;
      border: 1px solid rgba(255, 255, 255, 0.5);
      box-shadow: 0 6px 6px rgba(0, 0, 0, 0.5);">
<div class="marqueecont">
  <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <marquee behavior="move" direction="left"> <span class="d-none d-lg-block text-white">Welcome to Padii's Library</span></marquee>
       
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

</div>
    
    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            
              <hr class="dropdown-divider">
            </li>

           
            <li>
              <hr class="dropdown-divider">
            </li>

           
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="images/bookread.png" alt="" class="rounded-circle">
                <div>
                 
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

       

          
           
           <h4>Welcome <?php echo $_SESSION["username"];?> as User</h4>
         
            

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
