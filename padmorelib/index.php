
<?php
//session_start();
include 'conn.php'; // Include the database connection
if(isset($_SESSION['username'])){}
//header("location:index.php?page=home");
if(isset($_SESSION['fullname'])){}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   

    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username =? AND role = ?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $stmt->bind_result($userID, $hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashedPassword)) { // Verify the hashed password
        $_SESSION['user_id'] = $userID;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if ($role == "Admin") {
            header("Location: admin/index.php");
        } else {
            header("Location: student/index.php");
        }
        exit(); // Important: Stop further execution
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Login</title>
    <style>
        body {
            background: url("library.jpeg");
            font-family: sans-serif;
            background-color: #f4f4f4; /* Light gray background */
            margin: 0;
            display: flex; /* Center content horizontally and vertically */
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ensure full viewport height */

            
          
        }

        

        .container {
            background-color: black;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px; /* Adjust as needed */

            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            padding: 1rem;
            position: fixed;
           
            
            tranform: translateX(-50%);
            
            border-radius:  30px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 6px 6px rgba(0, 0, 0, 0.5);
           
        }

        

        h1 {
            text-align: center;
            color: white; /* Darker heading color */
            opacity: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: white; /* Slightly darker label color */
            opacity: 200%;
           
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: calc(100% - 10px); /* Account for padding and border */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            opacity: 100%;
        }

        input[type="submit"] {
            background-color: #007bff; /* Blue button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Make button full width */
            opacity: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
            opacity: 100%;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        /* Registration Container Specific Styles */
        .registration-container {
            margin-top: 20px; /* Space between login and registration */
            border-top: 1px solid #ddd; /* Add a separator line */
            padding-top: 20px;
        }
        /* Admin Dashboard Styles */
        .admin-dashboard-container {
          width: 90%; /* Adjust as needed */
          margin: 20px auto; /* Center the container */
          background-color: white;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .admin-dashboard-container h2, .admin-dashboard-container h3 {
          text-align: left; /* Align headings to the left */
          color: #333;
        }
        .admin-dashboard-container table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 20px;
        }
        .admin-dashboard-container th, .admin-dashboard-container td {
          padding: 8px;
          border: 1px solid #ddd;
          text-align: left;
        }
        .admin-dashboard-container th {
          background-color: #f2f2f2;
        }
        #add-book-form label {
          display: block;
          margin-bottom: 5px;
        }
        #add-book-form input[type="text"],
        #add-book-form input[type="number"] {
          width: calc(100% - 10px);
          padding: 8px;
          margin-bottom: 10px;
          box-sizing: border-box;
          opacity: 100%;
        }
    </style>
</head>
<body>
   
    <div class="container">
      <marquee behavior="" direction=""> <h1>Welcome To Padi's Library Login</h1></marquee> 
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>