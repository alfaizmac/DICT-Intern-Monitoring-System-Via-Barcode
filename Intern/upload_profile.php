<?php
session_start();

// Check if user is logged in as OJT
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt' || !isset($_SESSION['ojt_id'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Check if file was uploaded
if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
    exit();
}

// Create profile_pictures directory if it doesn't exist
$upload_dir = __DIR__ . '/../profile_pictures/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Generate unique filename
$extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
$filename = 'profile_' . $_POST['ojt_id'] . '_' . time() . '.jpg'; // Force JPG output for better compression
$target_path = $upload_dir . $filename;

// Process image
try {
    $image = null;
    $mime_type = mime_content_type($_FILES['profile_picture']['tmp_name']);

    // Create image resource based on file type
    switch ($mime_type) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($_FILES['profile_picture']['tmp_name']);
            break;
        case 'image/png':
            $image = imagecreatefrompng($_FILES['profile_picture']['tmp_name']);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($_FILES['profile_picture']['tmp_name']);
            break;
        default:
            throw new Exception('Invalid image type. Only JPG, PNG, and GIF are allowed.');
    }

    // Calculate new dimensions (2x2 aspect ratio)
    $original_width = imagesx($image);
    $original_height = imagesy($image);

    // Target size (adjust as needed)
    $target_size = 500; // 500x500 pixels
    $new_width = $target_size;
    $new_height = $target_size;

    // Create new image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Preserve transparency for PNG
    if ($mime_type == 'image/png') {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
    }

    // Resize and crop to maintain 2x2 aspect ratio
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

    // Save with quality compression (60-80% is good for web)
    $quality = 75; // Adjust quality (0-100)
    imagejpeg($new_image, $target_path, $quality);

    // Free memory
    imagedestroy($image);
    imagedestroy($new_image);

    echo json_encode(['success' => true, 'filename' => $filename]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>