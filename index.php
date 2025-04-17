<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Modal styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(45, 45, 45, 0.55);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="TitlePage">
        <div class="LOGODICT">
            <img src="img/DICT-logo-min.png" alt="">
        </div>
        <div class="TitleAdd">
            <h1>Region XII (SOCCSKSARGEN & LAMA)</h1>
        </div>
        <span>Published By</span>
        <div class="SchoolLogo">
            <img src="img/Newbrighton.png" alt="NBSPI">
            <img src="img/MSU.png" alt="MSU">
            <img src="img/Holy.png" alt="Holy">
            <img src="img/STI.png" alt="STI">
        </div>
    </div>
    <div class="LoginPage">
        <div class="FirstContainer">
            <div class="Margin">

                <div class="ProfileIcon"><svg width="100" height="100" fill="none" stroke="#2a5ed4"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"></path>
                        <path d="M2.906 20.25a10.5 10.5 0 0 1 18.188 0"></path>
                    </svg></div>
                <span>USER LOG IN</span>
                <div class="InputContainer"><input type="text" placeholder="Username"></div>
                <div class="InputContainer"><input type="password" placeholder="Password"><svg id="ShowPass" width="24"
                        height="24" fill="#767676" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5A9.76 9.76 0 0 1 12 17.5 9.76 9.76 0 0 1 3.18 12 9.77 9.77 0 0 1 12 6.5Zm0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 5a2.5 2.5 0 0 1 0 5 2.5 2.5 0 0 1 0-5Zm0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5 4.5-2.02 4.5-4.5-2.02-4.5-4.5-4.5Z">
                        </path>
                    </svg></div>
                <div class="ForgotPass">
                    <a href="#" id="forgotPasswordLink">Forgot Password?</a>
                </div>
                <div class="InputButton">
                    <button>Login</button>
                </div>
            </div>
        </div>
    </div>

    <div id="forgotPasswordModal" class="modal-overlay">
        <?php include 'Forgot_Pass_Modal.php'; ?>
    </div>

    <script>
        // Get the modal and link elements
        const modal = document.getElementById('forgotPasswordModal');
        const forgotPasswordLink = document.getElementById('forgotPasswordLink');
        const closeModal = document.querySelector('.close');
        const submitButton = document.getElementById('submitForgotPassword');

        // Show modal when "Forgot Password?" is clicked
        forgotPasswordLink.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'flex';
        });

        // Close modal when X is clicked
        closeModal.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside the modal content
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Handle form submission
        submitButton.addEventListener('click', function () {
            // Add your form submission logic here
            alert('Password reset request submitted!');
            modal.style.display = 'none';
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showPassIcon = document.getElementById('ShowPass');
            const passwordInput = showPassIcon.previousElementSibling;

            showPassIcon.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showPassIcon.setAttribute('fill', '#2a5ed4'); // Change to blue when visible
                } else {
                    passwordInput.type = 'password';
                    showPassIcon.setAttribute('fill', '#767676'); // Revert to original color
                }
            });
        });
    </script>
</body>



</html>