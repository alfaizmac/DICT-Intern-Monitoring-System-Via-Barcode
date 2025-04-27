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
        $_SESSION['logged_in'] = true; // Add this line
        header("Location: /DICT-MANAGEMENT/Admin/Dashboard.php");
        exit();
    }

    // If not admin, check OJT_TABLE_STATUS_CREDENTIAL
    $ojtQuery = "SELECT * FROM OJT_TABLE_STATUS_CREDENTIAL WHERE Username = ? AND Password = ?";
    $ojtParams = array($username, $password);
    $ojtStmt = sqlsrv_query($conn, $ojtQuery, $ojtParams);

    if ($ojtStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $ojtRow = sqlsrv_fetch_array($ojtStmt, SQLSRV_FETCH_ASSOC);

    if ($ojtRow) {
        // OJT credentials matched - check personal data
        $ojtId = $ojtRow['OJT_ID'];

        // Check if OJT exists in personal data table
        $personalDataQuery = "SELECT * FROM OJT_TABLE_PERSONAL_DATA WHERE OJT_ID = ?";
        $personalDataParams = array($ojtId);
        $personalDataStmt = sqlsrv_query($conn, $personalDataQuery, $personalDataParams);

        if ($personalDataStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $personalDataRow = sqlsrv_fetch_array($personalDataStmt, SQLSRV_FETCH_ASSOC);

        // Set session variables
        $_SESSION['user_type'] = 'ojt';
        $_SESSION['username'] = $username;
        $_SESSION['ojt_id'] = $ojtId;

        if ($personalDataRow) {
            // Personal data exists - go to dashboard
            header("Location: /DICT-MANAGEMENT/Intern/Intern_Dashboard.php");
        } else {
            // New OJT - redirect to New_Comer page
            header("Location: /DICT-MANAGEMENT/Intern/New_Comer.php");
        }
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