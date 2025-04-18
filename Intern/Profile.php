<?php
include 'Components/InternSidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Intern_All_Page.css">
    <link rel="stylesheet" href="CSS/Profile.css">
</head>

<body>
    <div class="PageMargin">
        <div class="InformationContainer">
            <div class="InformationContainerMargin">
                <div class="ContainersProfile">
                    <div class="InternName">
                        <img src="../img/DefaultProfile.png" alt="Profile" class="ProfileImage">
                        <div class="InternFName">
                            <label class="IFullName" for="">Mohammad Alfaiz S. Macalangcom</label>
                            <label class="ICourse" for="">Bacherlor Of Science in Information and Technology</label>
                        </div>
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
                            <div class="MContainer"><input type="text" placeholder="First Name"></div>
                            <div class="MContainer"><input type="text" placeholder="Last Name"></div>
                        </div>
                        <div class="InvisibleDiv">
                            <div class="XSContainer"><input type="text" placeholder="Middle Initial"></div>
                        </div>
                    </div>
                </div>

                <div class="Containers">
                    <div class="Title">
                        <span>Date of Birth</span>
                    </div>
                    <div class="SContainer"><input type="Date"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Gender</span>
                    </div>
                    <div class="SContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Civil Status</span>
                    </div>
                    <div class="SContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="LContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Signature</span>
                    </div>
                    <img src="" alt="">
                    <div class="SignatureAddButton">
                        <button>Download PNG<svg width="24" height="24" fill="#2a5ed4" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 18v3h-15v-3H3v3a1.5 1.5 0 0 0 1.5 1.5h15A1.5 1.5 0 0 0 21 21v-3h-1.5Z">
                                </path>
                                <path
                                    d="m19.5 10.5-1.058-1.057-5.692 5.684V1.5h-1.5v13.627L5.558 9.444 4.5 10.5 12 18l7.5-7.5Z">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT INFORMATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Email</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="divider"></div>
                <h1>EDUCATION</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>School</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Course</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="divider"></div>
                <h1>CONTACT PERSON</h1>
                <div class="Containers">
                    <div class="Title">
                        <span>Name</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Phone Number</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Relationship</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="Containers">
                    <div class="Title">
                        <span>Address</span>
                    </div>
                    <div class="MContainer"><input type="text"></div>
                </div>
                <div class="SaveButton">
                    <button class="SaveBtm">UPDATE<svg width="24" height="24" fill="none" stroke="#fff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.69 20.252H4.5a.75.75 0 0 1-.75-.75v-4.19a.74.74 0 0 1 .216-.526l11.25-11.25a.75.75 0 0 1 1.068 0l4.182 4.181a.75.75 0 0 1 0 1.07l-11.25 11.25a.74.74 0 0 1-.525.215v0Z">
                            </path>
                            <path d="M12.75 6 18 11.25"></path>
                        </svg></button>

                </div>
            </div>
        </div>

    </div>
</body>

</html>