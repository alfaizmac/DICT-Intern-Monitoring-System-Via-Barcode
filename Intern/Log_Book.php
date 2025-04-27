<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt') {
    header("Location: ../../index.php");
    exit();
}
// Rest of your dashboard code
include 'Components/InternSidebar.php';
?>