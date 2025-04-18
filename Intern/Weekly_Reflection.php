<?php
include 'Components/InternSidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Intern_All_Page.css" />
    <link rel="stylesheet" href="CSS/Weekly_Reflection.css">
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
    <div class="PageMargin">
        <div class="ContainerBtm">
            <div class="ContainerBtmMargin">
                <h1>Weekly Reflection</h1>
                <div class="SearchbarContainer">
                    <div class="SearchBar">
                        <svg width="32" height="32" fill="none" stroke="#0866ff" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"></path>
                            <path d="m21 21-6-6"></path>
                        </svg>
                        <input type="text" placeholder="Search name..." />
                    </div>
                    <button><span>Export</span><svg width="32" height="32" fill="none" stroke="#0866ff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 16h-13v6h13v-6Z"></path>
                            <path d="M2 10h20v9h-3.491v-3H5.49v3H2v-9Z" clip-rule="evenodd"></path>
                            <path d="M19 2H5v8h14V2Z"></path>
                        </svg></button>
                </div>

                <div class="dividerer"></div>
                <div class="TableDisplayStatus">
                    <div class="NoWeek">
                        <label for="">Week1</label>
                    </div>
                    <div class="Description_Learned">
                        <div class="descriptions">
                            <div class="titleRef">Description</div>
                            <div class="para"><label for="">Description of what you learned</label></div>
                        </div>
                        <div class="Learned">
                            <div class="titleRef">Lessons/Skills Learned</div>
                            <div class="para"><label for="">Description of what you learned</label></div>
                        </div>
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
        <div class="addInternModal">
            <button id="AddReflectionBtm" class="AddInternBtn">
                <svg width="100" height="100" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.4 11.398v-5a1 1 0 0 0-2 0v5h-5a1 1 0 0 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5Z">
                    </path>
                </svg>
            </button>
        </div>

        <div id="AddReflectionModal" class="modal-overlay">
            <?php include 'Modals/Add_Reflection.php'; ?>
        </div>

        <script>
            // Get the modal and link elements
            const modal = document.getElementById('AddReflectionModal');
            const AddInternBtm = document.getElementById('AddReflectionBtm');
            const closeModal = document.querySelector('.close');
            const submitButton = document.getElementById('submitAddReflection');

            // Show modal when "Forgot Password?" is clicked
            AddInternBtm.addEventListener('click', function (e) {
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
</body>

</html>