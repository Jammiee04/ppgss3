<?php

$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = "ppgss3";

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

if (!function_exists('filteration')) {
    function filteration($data) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }
        return $data;
    }
}

if (!function_exists('select')) {
    function select($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
        } else {
            die("Query cannot be prepared - Select");
        }
    }
}

if (!function_exists('update')) {
    function update($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
    
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Update");
            }
        } else {
            die("Query cannot be prepared - Update");
        }
    }
}

if (!function_exists('insert')) {
    function insert($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }
        } else {
            die("Query cannot be prepared - Insert");
        }
    }
}

if (!function_exists('delete')) {
    function delete($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Delete");
            }
        } else {
            die("Query cannot be prepared - Delete");
        }
    }
}

?>
