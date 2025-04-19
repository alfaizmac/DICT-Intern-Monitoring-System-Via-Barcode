<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in as OJT
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt' || !isset($_SESSION['ojt_id'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized access',
        'session_data' => $_SESSION
    ]);
    exit();
}

// Check if all required data is present
if (!isset($_POST['signature']) || !isset($_POST['filename']) || !isset($_POST['ojt_id'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode([
        'success' => false,
        'message' => 'Missing required data',
        'post_data' => $_POST
    ]);
    exit();
}

$signatureData = $_POST['signature'];
$filename = $_POST['filename'];
$ojt_id = $_POST['ojt_id'];

// Validate filename - make regex more flexible for debugging
if (!preg_match('/^signature_\d+_ojt.+\..+$/', $filename)) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode([
        'success' => false,
        'message' => 'Invalid filename format: ' . $filename,
        'filename_pattern' => 'Expected format: signature_TIMESTAMP_ojtID.png'
    ]);
    exit();
}

// Extract the base64 data
$signatureData = str_replace('data:image/png;base64,', '', $signatureData);
$signatureData = str_replace(' ', '+', $signatureData);
$imageData = base64_decode($signatureData);

if (!$imageData) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode([
        'success' => false,
        'message' => 'Invalid image data',
        'data_length' => strlen($signatureData)
    ]);
    exit();
}

// Use absolute path to Signatures directory
$signaturesDir = __DIR__ . '/../Signatures/';

// Create directory if it doesn't exist
if (!file_exists($signaturesDir)) {
    if (!mkdir($signaturesDir, 0755, true)) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode([
            'success' => false,
            'message' => 'Could not create signatures directory',
            'directory_path' => $signaturesDir,
            'error' => error_get_last()
        ]);
        exit();
    }
}

// Verify directory is writable
if (!is_writable($signaturesDir)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'success' => false,
        'message' => 'Signatures directory is not writable',
        'directory_path' => $signaturesDir,
        'permissions' => substr(sprintf('%o', fileperms($signaturesDir)), -4)
    ]);
    exit();
}

// Save the image
$filePath = $signaturesDir . $filename;
if (file_put_contents($filePath, $imageData)) {
    echo json_encode([
        'success' => true,
        'filename' => $filename,
        'file_path' => $filePath,
        'file_size' => filesize($filePath)
    ]);
} else {
    $error = error_get_last();
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save signature',
        'error' => $error,
        'file_path' => $filePath,
        'directory_writable' => is_writable($signaturesDir),
        'free_space' => disk_free_space($signaturesDir)
    ]);
}
?>