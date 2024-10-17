<?php
require('../backend/essentials.php');
require('../backend/db.php');

session_start();

if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('homepage.php');
}

if (isset($_POST['login'])) {
    $frm_data = filteration($_POST);

    $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
    $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

    $res = select($query, $values, "ss");

    if ($res->num_rows == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['adminLogin'] = true;
        $_SESSION['adminId'] = $row['id_no'];
        redirect('homepage.php');
    } else {
        alert('error', 'Login failed - Invalid Credentials!');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../frontend/logo.png" type="image/x-icon">
    <title>PPGSS</title>
    
    <style>
        body {
            
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
        .login-form img {
             display: block;
             width: 150px;
            height: 150px;
            margin: -75px auto 20px auto;
             z-index: 1;
        }

        .login-form {
            width: 400px;
            position: relative;
            background-color: white;
             padding: 20px;
             border-radius: 8px;
             box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
             width: 300px;
            z-index: 1;
        }

        .login-form::before {
             content: "";
             position: absolute;
             background: #007BFF;
             height: 5px;
        bottom: 0;
             left: 0;
             right: 0;
        }
        
        .login-form input {
            width: calc(100% - 20px);
             padding: 10px;
             margin-bottom: 8px;
             border-radius: 4px;
             border: 1px solid #ddd;
        }
        .login-form button {
            width: 40%;
             padding: 10px;
             border: none;
             border-radius: 5px;
             color: white;
            background: linear-gradient(to right, #007BFF, #00C6FF);
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
           
        }
        footer {
             position: fixed;
             left: 0;
            bottom: 0;
             width: 100%;
           text-align: center;
             padding: 10px;
             background-color: #f0f0f0;
}
    </style>
</head>

<body class="bg-secondary">

  <div>

    <div shadow overflow-hidden>
        
    </div>
    <div class="login-form text-center rounded shadow overflow-hidden">
    <img src="logo_outline.png" alt="Logo">
        <form method="POST">
            <h4 class="text-white">LOGIN</h4>
            <div class="mb-3 px-2">
                <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Username">
            </div>
            <div class="mb-4 px-2">
                <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="submit" class="btn btn-info shadow-none mb-3">LOGIN</button>
        </form>
        <p>Copyright © Zyril Evangelista. 2024. All Rights Reserved.</p>
    </div>
  </div>
  <footer>
</footer>
    <!-- <?php require('inc/scripts.php') ?> -->
</body>

</html>
