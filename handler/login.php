<?php
session_start();
require_once '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check against ADMIN_TABLE first
    $adminQuery = "SELECT * FROM ADMIN_TABLE WHERE Username = ? AND Password = ?";
    $adminParams = array($username, $password);
    $adminStmt = sqlsrv_query($conn, $adminQuery, $adminParams);

    if ($adminStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $adminRow = sqlsrv_fetch_array($adminStmt, SQLSRV_FETCH_ASSOC);

    if ($adminRow) {
        // Admin credentials matched
        $_SESSION['user_type'] = 'admin';
        $_SESSION['username'] = $username;
        header("Location: /DICT-FRONTEND/Admin/Dashboard.php");
        exit();
    }

    // If not admin, check OJT_TABLE_STATUS_CREDENTAIL
    $ojtQuery = "SELECT * FROM OJT_TABLE_STATUS_CREDENTIAL WHERE Username = ? AND Password = ?";
    $ojtParams = array($username, $password);
    $ojtStmt = sqlsrv_query($conn, $ojtQuery, $ojtParams);

    if ($ojtStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $ojtRow = sqlsrv_fetch_array($ojtStmt, SQLSRV_FETCH_ASSOC);

    if ($ojtRow) {
        // OJT credentials matched
        $_SESSION['user_type'] = 'ojt';
        $_SESSION['username'] = $username;
        header("Location: /DICT-FRONTEND/Intern/Intern_Dashboard.php");
        exit();
    }

    // If neither matched, redirect back with error
    $_SESSION['login_error'] = "Invalid username or password";
    header("Location: ../index.php");
    exit();
} else {
    // Not a POST request
    header("Location: ../index.php");
    exit();
}
?>