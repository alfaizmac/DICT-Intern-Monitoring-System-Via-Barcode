<?php
require_once __DIR__ . '../includes/auth_check.php';
validateAdminSession();

include 'Components/Header.php';
include 'Components/Sidebar.php';

// Get OJT_ID from URL
$ojt_id = $_GET['ojt_id'] ?? null;

// Fetch intern data from database
require_once __DIR__ . '/../db_connect.php';

$personalData = [];
$statusData = [];

if ($ojt_id) {
    // Fetch personal data
    $personalSql = "SELECT * FROM OJT_TABLE_PERSONAL_DATA WHERE OJT_ID = ?";
    $personalParams = array($ojt_id);
    $personalStmt = sqlsrv_query($conn, $personalSql, $personalParams);

    if ($personalStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $personalData = sqlsrv_fetch_array($personalStmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($personalStmt);

    // Fetch status/credential data
    $statusSql = "SELECT * FROM OJT_TABLE_STATUS_CREDENTIAL WHERE OJT_ID = ?";
    $statusParams = array($ojt_id);
    $statusStmt = sqlsrv_query($conn, $statusSql, $statusParams);

    if ($statusStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $statusData = sqlsrv_fetch_array($statusStmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($statusStmt);
}

sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Intern_Information.css">
    <link rel="stylesheet" href="CSS/All_Page.css" />
</head>

<body>
    <div class="PageMargin">
        <div class="InformationContainer">
            <div class="InformationContainerMargin">
                <div class="ContainersProfile">
                    <label hidden for="" id="OJT_ID"></label>
                    <div class="InternName">
                        <img src="<?php echo htmlspecialchars($personalData['Profile_Image_Path'] ?? '../img/DefaultProfile.png'); ?>"
                            alt="Profile" class="ProfileImage" id="ProfileImage">
                        <div class="InternFName">
                            <label class="IFullName" for="" id="FullName">
                                <?php
                                echo htmlspecialchars($personalData['First_Name'] ?? '') . ' ' .
                                    htmlspecialchars($personalData['Middle_Initial'] ?? '') . ' ' .
                                    htmlspecialchars($personalData['Last_Name'] ?? '');
                                ?>
                            </label>
                            <label class="ICourse" for="" id="ICourse">
                                <?php echo htmlspecialchars($personalData['Course'] ?? ''); ?>
                            </label>
                        </div>
                    </div>

                    <div class="IUploadButton">
                        <div class="SaveButton">
                            <button class="SaveBtm">UPDATE <br> CREDENTAIL<svg width="24" height="24" fill="none"
                                    stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.69 20.252H4.5a.75.75 0 0 1-.75-.75v-4.19a.74.74 0 0 1 .216-.526l11.25-11.25a.75.75 0 0 1 1.068 0l4.182 4.181a.75.75 0 0 1 0 1.07l-11.25 11.25a.74.74 0 0 1-.525.215vv0Z">
                                    </path>
                                    <path d="M12.75 6 18 11.25"></path>
                                </svg></button>
                        </div>
                        <button class="IRemove">REMOVE<svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2ZM9 4h6v2H9V4Zm8 16H7V8h10v12Z">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="divider"></div>
                <h1>USER CREDENTIAL</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Username</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Username" readonly
                            value="<?php echo htmlspecialchars($statusData['Username'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Password</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Password" readonly
                            value="<?php echo htmlspecialchars($statusData['Password'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Required Hours</span>
                    </div>
                    <div class="XSContainer"><input type="text" id="RequiredHours" readonly
                            value="<?php echo htmlspecialchars($statusData['Required_Time'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Signature</span>
                    </div>
                    <div class="SignatureCon">
                        <img src="<?php echo htmlspecialchars($personalData['Signature'] ?? ''); ?>" alt="Signature"
                            id="SignatureImage">
                    </div>
                    <div class="SignatureAddButton">
                        <button onclick="downloadImage('SignatureImage', 'Signature')">Download PNG<svg width="24"
                                height="24" fill="#2a5ed4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 18v3h-15v-3H3v3a1.5 1.5 0 0 0 1.5 1.5h15A1.5 1.5 0 0 0 21 21v-3h-1.5Z">
                                </path>
                                <path
                                    d="m19.5 10.5-1.058-1.057-5.692 5.684V1.5h-1.5v13.627L5.558 9.444 4.5 10.5 12 18l7.5-7.5Z">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Barcode</span>
                    </div>
                    <div class="SignatureCon">
                        <img src="../<?php echo htmlspecialchars($statusData['Barcode_lmage_Path'] ?? ''); ?>"
                            alt="Barcode" id="BarcodeImage">
                    </div>
                    <div class="SignatureAddButton">
                        <button onclick="downloadImage('BarcodeImage', 'Barcode')">Download PNG<svg width="24"
                                height="24" fill="#2a5ed4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 18v3h-15v-3H3v3a1.5 1.5 0 0 0 1.5 1.5h15A1.5 1.5 0 0 0 21 21v-3h-1.5Z">
                                </path>
                                <path
                                    d="m19.5 10.5-1.058-1.057-5.692 5.684V1.5h-1.5v13.627L5.558 9.444 4.5 10.5 12 18l7.5-7.5Z">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="divider"></div>
                <h1>PERSONAL INFORMATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Name</span>
                    </div>
                    <div class="Containersname">
                        <div class="FullName">
                            <div class="MContainer"><input type="text" placeholder="First Name" id="FName" readonly
                                    value="<?php echo htmlspecialchars($personalData['First_Name'] ?? ''); ?>"></div>
                            <div class="MContainer"><input type="text" placeholder="Last Name" id="LName" readonly
                                    value="<?php echo htmlspecialchars($personalData['Last_Name'] ?? ''); ?>"></div>
                        </div>
                        <div class="InvisibleDiv">
                            <div class="XSContainer"><input type="text" placeholder="Middle Initial" id="MName" readonly
                                    value="<?php echo htmlspecialchars($personalData['Middle_Initial'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="Containers">
                    <div class="Title">
                        <span>Date of Birth</span>
                    </div>
                    <div class="SContainer">
                        <input type="date" id="DateBirth" readonly value="<?php
                        if (!empty($personalData['Date_Birth'])) {
                            // If it's a SQL Server DateTime object
                            if ($personalData['Date_Birth'] instanceof DateTime) {
                                echo $personalData['Date_Birth']->format('Y-m-d');
                            }
                            // If it's already a string in Y-m-d format
                            elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $personalData['Date_Birth'])) {
                                echo htmlspecialchars($personalData['Date_Birth']);
                            }
                            // If it's a string in different format
                            else {
                                $date = date_create($personalData['Date_Birth']);
                                echo $date ? htmlspecialchars($date->format('Y-m-d')) : '';
                            }
                        }
                        ?>">
                    </div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Gender</span>
                    </div>
                    <div class="SContainer"><input type="text" id="Gender" readonly
                            value="<?php echo htmlspecialchars($personalData['Gender'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Civil Status</span>
                    </div>
                    <div class="SContainer"><input type="text" id="CivilStatus" readonly
                            value="<?php echo htmlspecialchars($personalData['Civil_Status'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="LContainer"><input type="text" id="Address" readonly
                            value="<?php echo htmlspecialchars($personalData['Address'] ?? ''); ?>"></div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT INFORMATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text" id="ContactNo" readonly
                            value="<?php echo htmlspecialchars($personalData['Phone_Number'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Email</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Email" readonly
                            value="<?php echo htmlspecialchars($personalData['Email'] ?? ''); ?>"></div>
                </div>
                <div class="divider"></div>
                <h1>EDUCATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>School</span>
                    </div>
                    <div class="MContainer"><input type="text" id="School" readonly
                            value="<?php echo htmlspecialchars($personalData['School'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Course</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Course" readonly
                            value="<?php echo htmlspecialchars($personalData['Course'] ?? ''); ?>"></div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT PERSON</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Name</span>
                    </div>
                    <div class="MContainer"><input type="text" id="ContactName" readonly
                            value="<?php echo htmlspecialchars($personalData['Contact_Person_Name'] ?? ''); ?>"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text" id="ContactNo2" readonly
                            value="<?php echo htmlspecialchars($personalData['Contact_Person_Contact_No'] ?? ''); ?>">
                    </div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Relationship</span>
                    </div>
                    <div class="MContainer"><input type="text" id="ContactRelationship" readonly
                            value="<?php echo htmlspecialchars($personalData['Contact_Person_Relation'] ?? ''); ?>">
                    </div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="MContainer"><input type="text" id="ContactAddress" readonly
                            value="<?php echo htmlspecialchars($personalData['Contact_Person_Address'] ?? ''); ?>">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="updateCredentialModal" class="modal-overlay" style="display: none;">
        <?php include 'Modals/Update_Credential_Modal.php'; ?>
    </div>

    <style>
        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>


    <script>

        // In Intern_Information.php, update the script section:
        document.addEventListener('DOMContentLoaded', function () {
            // Get modal and button elements
            const modal = document.getElementById('updateCredentialModal');
            const updateBtn = document.querySelector('.SaveBtm');

            // Update the modal opening code to pass OJT_ID
            updateBtn.addEventListener('click', function (e) {
                e.preventDefault();
                modal.style.display = 'flex';

                // Fetch the current credential data
                const username = document.getElementById('Username').value;
                const password = document.getElementById('Password').value;
                const requiredTime = document.getElementById('RequiredHours').value;

                // These selectors need to target the inputs inside the modal
                const modalUsername = modal.querySelector('#Username');
                const modalPassword = modal.querySelector('#Password');
                const modalRequiredTime = modal.querySelector('#Required_Time');
                const modalOjtId = modal.querySelector('#OJT_ID');

                if (modalUsername && modalPassword && modalRequiredTime && modalOjtId) {
                    modalUsername.value = username;
                    modalPassword.value = password;
                    modalRequiredTime.value = requiredTime;
                    modalOjtId.textContent = ojt_id; // Pass the OJT_ID to the modal
                }
            });

            // Close modal when clicking X button
            modal.querySelector('.close').addEventListener('click', function (e) {
                e.preventDefault();
                modal.style.display = 'none';
            });

            // Close modal when clicking outside modal content
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // OJT ID display logic
            const urlParams = new URLSearchParams(window.location.search);
            const ojtId = urlParams.get('ojt_id');
            if (ojtId) {
                document.getElementById('OJT_ID').textContent = ojtId;
                document.getElementById('OJT_ID').style.fontWeight = 'bold';
                document.getElementById('OJT_ID').style.margin = '10px 0';
            }
        });

        // In Intern_Information.php, add this to the DOMContentLoaded event:
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const ojtId = urlParams.get('ojt_id');

            if (ojtId) {
                // Store the OJT_ID in sessionStorage
                sessionStorage.setItem('selectedOjtId', ojtId);
                document.getElementById('OJT_ID').textContent = ojtId;
                document.getElementById('OJT_ID').style.fontWeight = 'bold';
                document.getElementById('OJT_ID').style.margin = '10px 0';
            } else {
                console.log('No OJT_ID found in URL');
            }
        });

        function downloadImage(imageId, prefix) {
            const image = document.getElementById(imageId);
            if (!image || !image.src) {
                alert('No image available to download');
                return;
            }

            // Get the username from the input field
            const username = document.getElementById('Username').value.trim();
            if (!username) {
                alert('Username not found');
                return;
            }

            // Create a temporary anchor element
            const link = document.createElement('a');
            link.href = image.src;

            // Set the filename in the format "Prefix_Username.png"
            link.download = `${prefix}_${username}.png`;

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>

</html>