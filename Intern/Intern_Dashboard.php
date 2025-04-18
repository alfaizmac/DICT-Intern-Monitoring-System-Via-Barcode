<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ojt') {
    header("Location: ../../index.php");
    exit();
}
// Rest of your dashboard code
include 'Components/InternSidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Intern_All_Page.css">
    <link rel="stylesheet" href="CSS/Intern_Dashboard.css">
</head>

<body>
    <div class="PageMargin">
        <div class="MainContainer">
            <div class="TopContainer">
                <div class="TopInnerContainer">
                    <img src="../img/DICT-logo.png" alt="logo" class="Logo">

                    <div class="WelcomeMessage">
                        <h1>Welcome to the <span>DICT Sargen DCT,</span></h1>
                        <h2 class="InternName">Mohammad Alfaiz Macalangcom</h2>
                        <p>
                            Stay on track with your internship progress, log your activities, <br>
                            and manage your status efficiently. Your journey in the tech industry starts here!
                        </p>
                    </div>
                    <div class="divider"></div>
                    <div class="TimeComplete">
                        <div class="TimeCompleteMargin">
                            <span class="Hcom">Hours Complete</span>
                            <label class="Hours" for="">420 Hours</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ButtomContainer">
                <div class="TimeTackerContainer">
                    <div class="BottomContainerMargin">
                        <div class="TimeTrackerComponent">
                            <h2>Time Tracker</h2>
                            <div class="TrackerContainerList">
                                <div class="First">
                                    <span class="title">Date</span>
                                    <div class="data">
                                        <label for="">January 4, 2025</label>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="First">
                                    <span class="title">Morning Shift</span>
                                    <div class="dataseason">
                                        <div class="season">Time in: <label for=""></label></div>
                                        <div class="season">Time out: <label for=""></label></div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="First">
                                    <span class="title">Afternoon Shift</span>
                                    <div class="dataseason">
                                        <div class="season">Time in: <label for=""></label></div>
                                        <div class="season">Time out: <label for=""></label></div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="First">
                                    <span class="title">Hour Complete</span>
                                    <div class="data">
                                        <label for="">8 Hours</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="DocumentContainer">
                    <div class="BottomContainerMargin">
                        <div class="DocumentComponent">
                            <h2>Document</h2>
                            <div class="DocumentContainerList">
                                <div class="DocTitle"><label for="">Medical</label></div>
                                <div class="DocStatus"><label for="">Pending</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>