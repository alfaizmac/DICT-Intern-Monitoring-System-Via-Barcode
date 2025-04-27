<?php
function validateAdminSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in
    if (!isset($_SESSION['logged_in'])) {
        header("Location: /DICT-MANAGEMENT/");
        exit();
    }

    // Check user type (admin only)
    if (!isset($_SESSION['user_type'])) {
        header("Location: /DICT-MANAGEMENT/");
        exit();
    }

    if ($_SESSION['user_type'] !== 'admin') {
        header("Location: /DICT-MANAGEMENT/");
        exit();
    }

    // Optional: Session timeout (30 minutes)
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
        header("Location: /DICT-MANAGEMENT/");
        exit();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}
?>