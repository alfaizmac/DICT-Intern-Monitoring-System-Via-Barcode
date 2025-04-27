<?php
session_start();
require_once __DIR__ . '/../db_connect.php';

// Clear any previous output
ob_clean();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Check if user is logged in as OJT
    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt' || !isset($_SESSION['ojt_id'])) {
        throw new Exception('Unauthorized access');
    }

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
    $requiredFields = [
        'First_Name',
        'Last_Name',
        'Date_Birth',
        'Gender',
        'Civil_Status',
        'Address',
        'Phone_Number',
        'Email',
        'School',
        'Course',
        'Contact_Person_Name',
        'Contact_Person_No',
        'Contact_Person_Relation',
        'Contact_Person_Address'
    ];

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            throw new Exception("Missing required field: $field");
        }
    }

    // Prepare file paths
    $profile_image_path = $data['Profile_Image_Path'] ?? '../profile_pictures/profiledefault.jpg';
    $signature_path = $data['Signature'] ?? '../Signatures/DefaultSignature.jpg';

    // SQL query with parameters
    $sql = "INSERT INTO OJT_TABLE_PERSONAL_DATA (
        OJT_ID, First_Name, Middle_Initial, Last_Name, Date_Birth, Gender, 
        Civil_Status, Address, Signature, Phone_Number, Email, School, 
        Course, Contact_Person_Name, Contact_Person_Contact_No, 
        Contact_Person_Relation, Contact_Person_Address, Profile_Image_Path
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = [
        $_SESSION['ojt_id'],
        $data['First_Name'],
        $data['Middle_Initial'] ?? null,
        $data['Last_Name'],
        $data['Date_Birth'],
        $data['Gender'],
        $data['Civil_Status'],
        $data['Address'],
        $signature_path,
        $data['Phone_Number'],
        $data['Email'],
        $data['School'],
        $data['Course'],
        $data['Contact_Person_Name'],
        $data['Contact_Person_No'],
        $data['Contact_Person_Relation'],
        $data['Contact_Person_Address'],
        $profile_image_path
    ];

    // Execute the query
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if (!$stmt) {
        throw new Exception('SQL prepare error: ' . print_r(sqlsrv_errors(), true));
    }

    if (!sqlsrv_execute($stmt)) {
        throw new Exception('SQL execute error: ' . print_r(sqlsrv_errors(), true));
    }

    $response = ['success' => true, 'message' => 'Data saved successfully'];

} catch (Exception $e) {
    http_response_code(500);
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

// Ensure no other output is sent
ob_end_clean();
echo json_encode($response);

if (isset($stmt))
    sqlsrv_free_stmt($stmt);
if (isset($conn))
    sqlsrv_close($conn);
?>