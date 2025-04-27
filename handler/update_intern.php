<?php
session_start();
require_once __DIR__ . '/../../db_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Get raw POST data
    $json = file_get_contents('php://input');
    if (empty($json)) {
        throw new Exception('No data received');
    }

    $data = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data: ' . json_last_error_msg());
    }

    // Validate required fields
    if (empty($data['ojt_id'])) {
        throw new Exception('Missing OJT ID');
    }

    // Update personal data
    $sqlPersonal = "UPDATE OJT_TABLE_PERSONAL_DATA SET 
        First_Name = ?, 
        Middle_Initial = ?, 
        Last_Name = ?, 
        Date_Birth = ?, 
        Gender = ?, 
        Civil_Status = ?, 
        Address = ?, 
        Phone_Number = ?, 
        Email = ?, 
        School = ?, 
        Course = ?, 
        Contact_Person_Name = ?, 
        Contact_Person_Contact_No = ?, 
        Contact_Person_Relation = ?, 
        Contact_Person_Address = ?
        WHERE OJT_ID = ?";

    $paramsPersonal = [
        $data['First_Name'],
        $data['Middle_Initial'],
        $data['Last_Name'],
        $data['Date_Birth'],
        $data['Gender'],
        $data['Civil_Status'],
        $data['Address'],
        $data['Phone_Number'],
        $data['Email'],
        $data['School'],
        $data['Course'],
        $data['Contact_Person_Name'],
        $data['Contact_Person_Contact_No'],
        $data['Contact_Person_Relation'],
        $data['Contact_Person_Address'],
        $data['ojt_id']
    ];

    $stmtPersonal = sqlsrv_prepare($conn, $sqlPersonal, $paramsPersonal);
    if (!$stmtPersonal || !sqlsrv_execute($stmtPersonal)) {
        throw new Exception('Failed to update personal data: ' . print_r(sqlsrv_errors(), true));
    }

    // Update status credentials
    $sqlStatus = "UPDATE OJT_TABLE_STATUS_CREDENTIAL SET 
        Username = ?, 
        Password = ?, 
        Required_Time = ?
        WHERE OJT_ID = ?";

    $paramsStatus = [
        $data['Username'],
        $data['Password'],
        $data['Required_Time'],
        $data['ojt_id']
    ];

    $stmtStatus = sqlsrv_prepare($conn, $sqlStatus, $paramsStatus);
    if (!$stmtStatus || !sqlsrv_execute($stmtStatus)) {
        throw new Exception('Failed to update status credentials: ' . print_r(sqlsrv_errors(), true));
    }

    $response = ['success' => true, 'message' => 'Intern information updated successfully'];

} catch (Exception $e) {
    http_response_code(500);
    $response = ['success' => false, 'message' => $e->getMessage()];
}

echo json_encode($response);

if (isset($stmtPersonal))
    sqlsrv_free_stmt($stmtPersonal);
if (isset($stmtStatus))
    sqlsrv_free_stmt($stmtStatus);
if (isset($conn))
    sqlsrv_close($conn);
?>