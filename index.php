<?php
session_start();

if (isset($_SESSION['login_error'])) {
    echo '<div id="login-error" class="error-message">'
        . htmlspecialchars($_SESSION['login_error'])
        . '<button class="error-close-btn" onclick="dismissError()">&times;</button>'
        . '</div>';
    unset($_SESSION['login_error']);
}
?>


<!DOCTYPE html>
<html lang="en">
<!-- Rest of your file remains the same -->
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

        .error-message {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #e74c3c;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            text-align: center;
            max-width: 80%;
            width: max-content;
            min-width: 300px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .error-message.show {
            top: 30px;
            opacity: 1;
        }

        .error-close-btn {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.5rem;
            line-height: 1;
            margin-left: 15px;
            padding: 0 0 3px 8px;
            transition: transform 0.2s;
        }

        .error-close-btn:hover {
            transform: scale(1.2);
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
        <form method="POST" action="handler/login.php">
            <div class="FirstContainer">
                <div class="Margin">
                    <div class="ProfileIcon"><svg width="100" height="100" fill="none" stroke="#2a5ed4"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"></path>
                            <path d="M2.906 20.25a10.5 10.5 0 0 1 18.188 0"></path>
                        </svg></div>
                    <span>USER LOG IN</span>
                    <div class="InputContainer"> <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="InputContainer"><input type="password" name="password" placeholder="Password"
                            required><svg id="ShowPass" width="24" height="24" fill="#767676" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5A9.76 9.76 0 0 1 12 17.5 9.76 9.76 0 0 1 3.18 12 9.77 9.77 0 0 1 12 6.5Zm0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 5a2.5 2.5 0 0 1 0 5 2.5 2.5 0 0 1 0-5Zm0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5 4.5-2.02 4.5-4.5-2.02-4.5-4.5-4.5Z">
                            </path>
                        </svg></div>
                    <div class="ForgotPass">
                        <a href="#" id="forgotPasswordLink">Forgot Password?</a>
                    </div>
                    <div class="InputButton">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </div>
        </form>
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

    <script>
        // Show error message with animation
        document.addEventListener('DOMContentLoaded', function () {
            const errorMessage = document.getElementById('login-error');

            if (errorMessage) {
                // Trigger animation
                setTimeout(() => {
                    errorMessage.classList.add('show');
                }, 50);

                // Auto-dismiss after 5 seconds
                const autoDismiss = setTimeout(() => {
                    dismissError();
                }, 5000);

                // Clear timeout if user manually dismisses
                errorMessage.addEventListener('click', function (e) {
                    if (e.target.classList.contains('error-close-btn')) {
                        clearTimeout(autoDismiss);
                    }
                });
            }
        });

        // Dismiss error message
        function dismissError() {
            const errorMessage = document.getElementById('login-error');
            if (errorMessage) {
                errorMessage.classList.remove('show');
                setTimeout(() => {
                    errorMessage.remove();
                }, 400); // Match transition duration
            }
        }
    </script>
</body>



</html>