<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Path to your autoload.php
require_once __DIR__ . '/../../db_connect.php'; // Database connection

// Initialize variables
$barcodeNumber = mt_rand(100000000, 999999999);
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcodeImageData = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128);
$barcodeImage = 'data:image/png;base64,' . base64_encode($barcodeImageData);

function generatePassword($length = 8)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}
$autoPassword = generatePassword();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'] ?? '';
    $password = $_POST['Password'] ?? '';
    $requiredTimeInput = $_POST['Required_Time'] ?? '';

    // Validate inputs
    if (empty($username) || empty($password) || empty($requiredTimeInput)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;
    }

    // Validate required time is numeric
    if (!is_numeric($requiredTimeInput)) {
        echo "<script>alert('Please input a valid number for Required Time.');</script>";
        exit;
    }

    // Check if username already exists
    $checkSql = "SELECT Username FROM OJT_TABLE_STATUS_CREDENTIAL WHERE Username = ?";
    $checkParams = array($username);
    $checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

    if ($checkStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($checkStmt)) {
        echo "<script>
                alert('Username already exists. Please choose a different username.');
                window.history.back();
              </script>";
        exit;
    }

    // If storing as VARCHAR (e.g., "450:00:00")
    $requiredTime = sprintf($requiredTimeInput);

    // Save barcode image to file
    $barcodeDir = __DIR__ . '/../../barcodes/';
    if (!file_exists($barcodeDir)) {
        mkdir($barcodeDir, 0777, true);
    }

    $barcodeFilename = 'barcode_' . $barcodeNumber . '.png';
    $barcodeFilePath = $barcodeDir . $barcodeFilename;
    file_put_contents($barcodeFilePath, $barcodeImageData);

    // Relative path for database storage
    $relativeBarcodePath = 'barcodes/' . $barcodeFilename;

    // Update SQL query to remove the Barcode column
    $sql = "INSERT INTO OJT_TABLE_STATUS_CREDENTIAL 
            (Username, Password, Required_Time, Barcode_lmage_Path) 
            VALUES (?, ?, ?, ?)";

    $params = array(
        $username,
        $password,
        $requiredTime,
        $relativeBarcodePath
    );

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "<script>
                alert('Intern added successfully!');
                window.parent.location.href = '/DICT-MANAGEMENT/Admin/Apprentice.php';
              </script>";
        exit;
    }
}
?>


<div class="body">
    <div class="ModalContainer">
        <form action="/DICT-MANAGEMENT/Admin/Modals/Add_Intern_Modal.php" method="POST">
            <div class="FirstContainer">
                <div class="head">
                    <div class="title">
                        <h1>Add New Intern</h1>
                    </div>
                    <div class="ContainerClose">
                        <svg class="close" width="32" height="32" fill="none" stroke="#222" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" onclick="window.parent.location.href = 'Apprentice.php'">
                            <path d="m18.75 5.25-13.5 13.5"></path>
                            <path d="M18.75 18.75 5.25 5.25"></path>
                        </svg>
                    </div>
                </div>
                <div class="SecondContainer">
                    <label for="Username">Username</label>
                    <div class="InputContainer"><input type="text" name="Username" id="Username" required></div>
                </div>
                <div class="SecondContainer">
                    <label for="Password">Password</label>
                    <div class="InputContainer">
                        <input type="text" id="Password" name="Password"
                            value="<?php echo htmlspecialchars($autoPassword); ?>" required>
                    </div>
                </div>
                <div class="SecondContainer">
                    <label for="Required_Time">Required Hour</label>
                    <div class="InputHourContainer">
                        <input type="text" name="Required_Time" id="Required_Time" required>
                    </div>
                </div>
                <div class="SecondContainer">
                    <label for="barcode-image">Barcode</label>
                    <div class="barcode-container">
                        <!-- Display the barcode image dynamically with PHP -->
                        <div class="barcode-number">
                            <img src="<?php echo $barcodeImage; ?>" alt="Barcode" class="barcode-image"
                                id="barcode-image">
                            <!-- Display the barcode number below the image -->
                            <p><?php echo $barcodeNumber; ?></p> <!-- Display the barcode number -->
                        </div>
                        <div class="div">
                            <div class="SignatureAddButton">
                                <button type="button" id="download-barcode">Download PNG
                                    <svg width="20" height="20" fill="#2a5ed4" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.5 18v3h-15v-3H3v3a1.5 1.5 0 0 0 1.5 1.5h15A1.5 1.5 0 0 0 21 21v-3h-1.5Z">
                                        </path>
                                        <path
                                            d="m19.5 10.5-1.058-1.057-5.692 5.684V1.5h-1.5v13.627L5.558 9.444 4.5 10.5 12 18l7.5-7.5Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <p class="initial">Input the username first.<svg width="18" height="18" fill="#757575"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-2a8 8 0 1 0 0-16.001A8 8 0 0 0 12 20Zm0-10a1 1 0 0 1 1 1v5a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1Zm0-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z">
                                    </path>
                                </svg></p>
                        </div>
                    </div>
                </div>
                <div class="ButtonContainer">
                    <button type="submit" id="submit-btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('download-barcode').addEventListener('click', function () {
        // Get the barcode image element
        const barcodeImage = document.getElementById('barcode-image');

        // Get username or use barcode number as fallback
        const username = document.getElementById('Username')?.value.trim();
        const barcodeNumber = '<?php echo $barcodeNumber; ?>';
        const fileName = username ? `Barcode_${username}.png` : `Barcode_${barcodeNumber}.png`;

        if (!barcodeImage || !barcodeImage.src) {
            alert('No barcode image available to download');
            return;
        }

        if (!username && !barcodeNumber) {
            alert('Could not determine filename for download');
            return;
        }

        // Create a canvas to add text to the image
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const img = new Image();

        img.onload = function () {
            // Set canvas dimensions (adding space for text at bottom)
            canvas.width = img.width;
            canvas.height = img.height + 30; // Extra space for text

            // Draw the original barcode
            ctx.drawImage(img, 0, 0);

            // Add text (barcode number) at the bottom
            ctx.fillStyle = '#000';
            ctx.font = '12px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('<?php echo $barcodeNumber; ?>', canvas.width / 2, canvas.height - 10);

            // Create download link with the new filename format
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = fileName;

            // Trigger download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        img.src = barcodeImage.src;
    });

    // Add a refresh button functionality if you want to allow generating new passwords
    document.addEventListener('DOMContentLoaded', function () {
        // You could add a refresh button next to the password field if desired
        const refreshPassword = () => {
            const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let password = '';
            for (let i = 0; i < 8; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('Password').value = password;
        };
    });

    document.getElementById("submit-btn").addEventListener("click", function (event) {
        var requiredTime = document.getElementById("Required_Time").value;
        // Check if Required Time is a number
        if (isNaN(requiredTime) || requiredTime.trim() === "") {
            alert("Please input a valid number for Required Time.");
            event.preventDefault(); // Prevent form submission
        }
    });

    // Validate form input before submitting
    document.getElementById('addInternForm').addEventListener('submit', function (e) {
        const requiredTime = document.getElementById('Required_Time').value;

        // Check if Required Time is numeric
        if (isNaN(requiredTime) || requiredTime === '') {
            e.preventDefault(); // Prevent form submission
            alert("Please enter a valid number for Required Time.");
        }
    });
</script>

<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    .body {
        background-color: #f5f5f5;
        font-family: "Segoe UI History", Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
        width: 100%;
        height: 100vh;
        background-color: rgb(60, 60, 60, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .head {
        display: flex;
        width: 100%;
        height: auto;
    }

    .barcode-number {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .ModalContainer {
        width: auto;
        height: auto;
        border-radius: 8px;
        background: #fff;

    }

    .FirstContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        width: 100%;
        height: auto;
        /* padding: 35px 0px 0px 45px; */
        gap: 20px;
    }

    .SecondContainer {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 63px;
        margin-left: 80px;
        align-items: center;
    }

    .SecondContainer label {
        width: 137px;
        font-size: 16px;
    }

    .SecondContainer .InputContainer {
        width: 100%;
        height: 100%;
        display: flex;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
        font-size: 24px;
        font-weight: 600;
        margin-left: 70px;
        margin-right: 90px;
    }

    .SecondContainer .InputHourContainer {
        width: 90px;
        height: 100%;
        display: flex;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
        font-size: 24px;
        font-weight: 600;
        margin-left: 12px;
        margin-right: 90px;
    }

    .ButtonContainer {
        display: flex;
        width: 100%;
        height: auto;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .FirstContainer .ButtonContainer button {
        display: flex;
        width: 150px;
        height: 60px;
        font-weight: 500;
        background: #428aff;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-radius: 12px;
        border: none;
        font-size: 15px;
    }

    .title {
        display: flex;
        justify-content: start;
        width: 100%;
        height: auto;
        margin-bottom: 30px;
        margin-top: 30px;
    }

    .ContainerClose {
        display: flex;
        justify-content: start;
        align-items: start;
        height: 100%;
        width: auto;
    }

    .close {
        display: flex;
        margin: 10px 10px 0 0;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .close:hover {
        stroke: #428aff;
    }

    h1 {
        display: flex;
        font-size: 24px;
        font-weight: Medium;
        color: #1b1b1b;
        padding-left: 40px;
    }

    .SignatureAddButton {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
        height: auto;
    }

    .div {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
        width: 100%;
        height: auto;
        gap: 3px;
    }

    .div p {
        display: flex;
        justify-content: start;
        align-items: center;
        font-size: 12px;
        color: #757575;
        gap: 3px;
    }

    .SignatureAddButtonIcon {
        display: flex;
        flex-direction: column;
    }

    .SignatureAddButton button {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 3px;
        background: transparent;
        color: #0651cc;
        font-size: 14px;
        font-weight: 400;
        cursor: pointer;
        border: none;
    }

    .SignatureAddButton button:hover {
        background: transparent;
        color: #0866ff;
    }

    .SignatureAddButton button:hover svg {
        background: transparent;
        fill: #0866ff;
    }

    .SecondContainer input {
        width: 100%;
        height: 100%;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 400;
        padding-left: 20px;
    }

    .SecondContainer input:focus {
        outline: none;
        box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .ButtonContainer button:hover {
        background: #649fff;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        font-weight: 600;
    }

    .barcode-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .barcode-image {
        height: 30px;
        width: auto;
        border: 1px solid #ddd;
        padding: 5px;
        background: white;
        margin-left: 12px;
    }
</style>