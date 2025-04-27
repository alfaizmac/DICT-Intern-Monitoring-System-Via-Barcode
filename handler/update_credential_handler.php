<?php
require_once __DIR__ . '/../db_connect.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ojt_id = $_POST['ojt_id'] ?? null;
    $username = $_POST['Username'] ?? '';
    $password = $_POST['Password'] ?? '';
    $required_time = $_POST['Required_Time'] ?? '';

    if (!$ojt_id) {
        echo json_encode(['success' => false, 'message' => 'OJT ID not provided']);
        exit;
    }

    if (empty($username) || empty($password) || empty($required_time)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    $sql = "UPDATE OJT_TABLE_STATUS_CREDENTIAL 
            SET Username = ?, 
                Password = ?, 
                Required_Time = ? 
            WHERE OJT_ID = ?";

    $params = array($username, $password, $required_time, $ojt_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . print_r(sqlsrv_errors(), true)]);
        exit;
    }

    echo json_encode(['success' => true, 'message' => 'Credentials updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

sqlsrv_close($conn);
?>