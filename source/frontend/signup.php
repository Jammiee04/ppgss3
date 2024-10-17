<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../backend/db.php';  // Adjusted path to include db.php file correctly
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Correct SQL syntax
   
    $sql = "SELECT * FROM `users` where username='$username'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
       $num=mysqli_num_rows($result);
       if($num>0){
        // echo "User already exist";
        $user=1;
        session_start();
        $_SESSION['username']=$username;
        header('location:loginpage.php');
       }else {
        
        $sql = "INSERT INTO `users` (username, password) VALUES ('$username', '$password')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
        //    echo "Signup successfully";
        $success=1;
        } else {
            die(mysqli_error($conn));
        }
    }
    }
    } 
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Signup page</title>
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
        align-items: center;
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
if ($user) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Ohh no SORRY </strong> User already exists
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}
?>

<?php
if ($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> Success </strong> You are successfully SIGNED UP.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}
?>


<h1 class="text-center">Sign up page</h1>
<div class="container mt-5 ">
    <form action="signup.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username">   
        </div> 
        
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password" name="password">
        </div>


        <button type="submit" class="btn btn-primary w-100">Sign up</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
