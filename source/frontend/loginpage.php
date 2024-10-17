<?php
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../backend/db.php';  // Adjusted path to include db.php file correctly
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Correct SQL syntax
   
    $sql = "SELECT * FROM `users` where username='$username' and password='$password'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
       $num=mysqli_num_rows($result);
       if($num>0){
       
        $login=1;
        session_start();
        $_SESSION['username']=$username;
        header('location:homepage.php');
        // echo "Login successful";
       }else {
        // echo "Invalid data";
        $invalid=1;
    }
    }
    }
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<style>
.container {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
    perspective: 1px;
}

input[type=text], input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

label {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #0C0C0C;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type=submit]:hover {
    background-color: #DDDDDD;
}
</style>

<?php
if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are successfully logged in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}
?>

<?php
if ($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> Invalid credentials.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}
?>

<h1 class="text-center">Login to our website</h1>
<div class="container mt-5">
    <form action="loginpage.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password" name="password">
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

















// $error_message = '';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     require '../backend/db.php'; // Ensure this is the correct path to your database file

//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     try {
//         // Prepare the query using parameterized statements to prevent SQL injection
//         $query = "SELECT id, username, password FROM users WHERE username = ?";
//         $stmt = $con->prepare($query);
//         $stmt->bindParam(1, $username); // Use numeric index for binding
//         $stmt->execute();
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($user && password_verify($password, $user['password'])) {
//             $_SESSION['user_id'] = $user['id']; // Store the user ID in the session
//             header("Location: homepage.php");
//             exit();
//         } else {
//             $error_message = 'Invalid username or password.';
//         }
//     } catch (PDOException $e) {
//         // Handle database errors with more informative message
//         $error_message = 'Database error: ' . $e->getMessage() . ' - Query: ' . $query;
//     }
// }
// ?>
<!-- // <!DOCTYPE html>
// <html>
// <head>
//     <title>Login</title>
//     <link rel="icon" href="C:/xampp/htdocs/ppgss2/logo.ico" type="image/x-icon">
//     <style>
//         body {
//             font-family: Arial, sans-serif;
//             background-color: #f0f0f0;
//             margin: 0;
//             padding: 0;
//             display: flex;
//             justify-content: center;
//             align-items: center;
//             height: 100vh;
//             overflow: hidden;
//             perspective: 1px;
//         }

//         .login-form {
//             position: relative;
//             background-color: white;
//             padding: 20px;
//             border-radius: 8px;
//             box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
//             width: 300px;
//             z-index: 1;
//         }

//         .login-form::before {
//             content: "";
//             position: absolute;
//             background: #007BFF;
//             height: 5px;
//             bottom: 0;
//             left: 0;
//             right: 0;
//         }

//         .login-form img {
//             display: block;
//             width: 150px;
//             height: 150px;
//             margin: -75px auto 20px auto;
//             z-index: 1;
//         }

//         .login-form input {
//             width: calc(100% - 20px);
//             padding: 10px;
//             margin-bottom: 8px;
//             border-radius: 4px;
//             border: 1px solid #ddd;
//         }

//         .login-form button {
//             width: 100%;
//             padding: 10px;
//             border: none;
//             border-radius: 5px;
//             color: white;
//             background: linear-gradient(to right, #007BFF, #00C6FF);
//             box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
//         }

//         footer {
//             position: fixed;
//             left: 0;
//             bottom: 0;
//             width: 100%;
//             text-align: center;
//             padding: 10px;
//             background-color: #f0f0f0;
//         }

//         .parallax::after {
//             content: " ";
//             position: absolute;
//             top: 0;
//             right: 0;
//             bottom: 0;
//             left: 0;
//             transform: translateZ(-1px) scale(2);
//             background-size: 100%;
//             z-index: -1;
//         }
//     </style>
// </head>
// <body>
// <div class="parallax">
//     <div class="login-form">
//         <img src="logo_outline.png" alt="Logo">
//         <?php
//         if (!empty($error_message)) {
//             echo '<p style="color: red;">' . htmlspecialchars($error_message) . '</p>';
//         }
//         ?>
//         <form action="loginpage.php" metho d="POST">
//             <input type="text" id="username" name="username" placeholder="Username" required>
//             <input type="password" id="password" name="password" placeholder="Password" required>
//             <button type="submit">LOGIN</button>
//         </form>
//         <p>Copyright © Zyril Evangelista. 2024. All Rights Reserved.</p>
//     </div>
// </div>

// <footer>
// </footer>
// </body>
// </html> -->
