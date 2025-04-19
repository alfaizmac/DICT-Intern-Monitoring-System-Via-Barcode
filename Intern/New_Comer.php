<?php
session_start();

// Redirect if not logged in as OJT or missing OJT_ID
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt' || !isset($_SESSION['ojt_id'])) {
    header("Location: ../index.php");
    exit();
}

$ojt_id = $_SESSION['ojt_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/New_Comer.css">
    <!-- Add signature pad library -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <style>
        /* Signature Modal Styles */
        .signature-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .SignatureCon img {
            width: auto;
            height: 150px;
        }

        .signature-modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .signature-container {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        #signature-pad {
            width: 100%;
            height: 200px;
            background-color: white;
        }

        .signature-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .signature-buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .clear-btn {
            background-color: #f44336;
            color: white;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-btn {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <div class="FirstContainer">
        <label class="hidden" for="">OJT ID: <?php echo htmlspecialchars($ojt_id); ?></label>
        <div class="TopContainer">
            <div class="TopInnerContainer">
                <img src="../img/DICT-logo.png" alt="logo" class="Logo">

                <div class="WelcomeMessage">
                    <h1>Welcome to the <span>DICT Sargen DCT,</span></h1>
                    <p>Stay on track with your internship progress, log your activities, and manage your status <br>
                        efficiently. Your journey in the tech industry starts here!</p>
                    <p class="FillField">Please fill out the fields to successfully be part of DICT Sargen DCT!</p>
                </div>
            </div>
        </div>
        <div class="InformationContainer">
            <div class="InformationContainerMargin">
                <div class="ContainersProfile">
                    <img id="profile-picture" src="../profile_pictures/profiledefault.jpg" alt="Profile"
                        class="ProfileImage">
                    <div class="UploadButton">
                        <button id="upload-profile-btn">Upload</button>
                        <input type="file" id="Profile_Image_Path" accept="image/*" style="display: none;">
                        <p><svg width="18" height="18" fill="#757575" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-2a8 8 0 1 0 0-16.001A8 8 0 0 0 12 20Zm0-10a1 1 0 0 1 1 1v5a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1Zm0-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z">
                                </path>
                            </svg>Please upload your 2x2 Picture</p>
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
                            <div class="MContainer"><input type="text" placeholder="First Name" id="First_Name"
                                    required></div>
                            <div class="MContainer"><input type="text" placeholder="Last Name" id="Last_Last" required>
                            </div>
                        </div>
                        <div class="InvisibleDiv">
                            <div class="XSContainer"><input type="text" placeholder="Middle Initial" id="Middle_Initial"
                                    required></div>
                        </div>
                    </div>
                </div>

                <div class="Containers">
                    <div class="Title">
                        <span>Date of Birth</span>
                    </div>
                    <div class="SContainer"><input type="Date" id="Date_Birth" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Gender</span>
                    </div>
                    <div class="SContainer"><input type="text" id="Gender" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Civil Status</span>
                    </div>
                    <div class="SContainer"><input type="text" id="Civil_Status" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="LContainer"><input type="text" id="Address" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Signature</span>
                    </div>
                    <div class="SignatureCon">
                        <img id="signature-preview" src="/DICT-FRONTEND/Signatures/DefualtSignature.jpg"
                            alt="Signature Preview">
                    </div>
                    <div class="SignatureAddButton">
                        <button id="open-signature-modal">Add</button>
                    </div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT INFORMATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Phone_Number" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Email</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Email" required></div>
                </div>
                <div class="divider"></div>
                <h1>EDUCATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>School</span>
                    </div>
                    <div class="MContainer"><input type="text" id="School" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Course</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Course" required></div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT PERSON</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Name</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Contact_Person_Name" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Contact_Person_No" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Relationship</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Contact_Person_Relation" required></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="MContainer"><input type="text" id="Contact_Person_Address" required></div>
                </div>
                <div class="SaveButton">
                    <button id="Submit-Info">Save</button>

                </div>
            </div>
        </div>

    </div>
    <!-- Signature Modal -->
    <div id="signature-modal" class="signature-modal">
        <div class="signature-modal-content">
            <h2>Draw Your Signature</h2>
            <div class="signature-container">
                <canvas id="signature-pad"></canvas>
            </div>
            <div class="signature-buttons">
                <button id="clear-signature" class="clear-btn">Clear</button>
                <div>
                    <button id="cancel-signature" class="cancel-btn">Cancel</button>
                    <button id="save-signature" class="save-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal elements
            const modal = document.getElementById('signature-modal');
            const openModalBtn = document.getElementById('open-signature-modal');
            const cancelBtn = document.getElementById('cancel-signature');
            const clearBtn = document.getElementById('clear-signature');
            const saveBtn = document.getElementById('save-signature');
            const canvas = document.getElementById('signature-pad');
            const signaturePreview = document.getElementById('signature-preview');

            // Initialize signature pad
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)'
            });

            // Open modal
            openModalBtn.addEventListener('click', function () {
                modal.style.display = 'block';
                // Resize canvas to maintain quality
                resizeCanvas();
            });

            // Close modal
            cancelBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            // Clear signature
            clearBtn.addEventListener('click', function () {
                signaturePad.clear();
            });

            // Save signature
            saveBtn.addEventListener('click', function () {
                if (signaturePad.isEmpty()) {
                    alert('Please provide a signature first.');
                    return;
                }

                // Generate unique filename
                const ojtId = '<?php echo isset($ojt_id) ? $ojt_id : "unknown"; ?>';
                const filename = 'signature_' + Date.now() + '_ojt' + ojtId + '.png';
                console.log('Generated filename:', filename); // Debugging;

                // Convert signature to image
                const dataURL = signaturePad.toDataURL('image/png');

                // Create a FormData object to send the image
                const formData = new FormData();
                formData.append('signature', dataURL);
                formData.append('filename', filename);
                formData.append('ojt_id', '<?php echo $ojt_id; ?>');

                // Send the image to server
                fetch('save_signature.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(text);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            signaturePreview.src = '../Signatures/' + filename + '?t=' + Date.now();
                            modal.style.display = 'none';
                            signaturePad.clear();
                        } else {
                            alert('Error saving signature: ' + JSON.stringify(data, null, 2));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Detailed error:\n' + error.message);
                    });
            });

            // Handle window resize
            window.addEventListener('resize', function () {
                if (modal.style.display === 'block') {
                    resizeCanvas();
                }
            });

            // Resize canvas function to maintain quality
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                signaturePad.clear(); // otherwise isEmpty() might return incorrect value
            }
        });


        // Profile picture upload functionality
        document.getElementById('upload-profile-btn').addEventListener('click', function () {
            document.getElementById('Profile_Image_Path').click();
        });

        document.getElementById('Profile_Image_Path').addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    return;
                }

                // Show loading indicator
                const profileImg = document.getElementById('profile-picture');
                const originalSrc = profileImg.src;
                profileImg.src = '../img/loading.gif'; // Add a loading spinner image

                const formData = new FormData();
                formData.append('profile_picture', file);
                formData.append('ojt_id', '<?php echo $ojt_id; ?>');

                fetch('upload_profile.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            profileImg.src = '../profile_pictures/' + data.filename + '?t=' + Date.now();
                        } else {
                            profileImg.src = originalSrc;
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        profileImg.src = originalSrc;
                        alert('An error occurred while uploading the picture.');
                    });
            }
        });
    </script>
</body>

</html>