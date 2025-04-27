<?php
require_once __DIR__ . '../includes/auth_check.php';
validateAdminSession();

include 'Components/Header.php';
include 'Components/Sidebar.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Intern_Record.css" />
    <link rel="stylesheet" href="CSS/All_Page.css" />

</head>

<body>
    <div class="PageMargin">
        <div class="FirstContainerRecord">
            <div class="RecordContainerMargin">
                <div class="TopRecordContainer">
                    <div class="LeftContainerRecord">
                        <div class="topTwoContainerRecord">
                            <div class="TimeCompleteRecord">
                                <div class="RecordTitle">
                                    <span>Hour Complete</span>
                                </div>
                                <div class="RecordValue">
                                    <svg width="62" height="62" fill="none" stroke="#fff" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2Z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M10 16h4"></path>
                                        <path d="M12 14v4"></path>
                                    </svg><label for="">420</label>
                                </div>
                            </div>
                            <div class="RequiredTimeRecord">
                                <div class="RecordTitle">
                                    <span>Required Time</span>
                                </div>
                                <div class="RecordValue">
                                    <svg width="62" height="62" fill="none" stroke="#fff" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.795 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4">
                                        </path>
                                        <path d="M18 22a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
                                        <path d="M15 3v4"></path>
                                        <path d="M7 3v4"></path>
                                        <path d="M3 11h16"></path>
                                        <path d="M18 16.492v1.504l1 1"></path>
                                    </svg> <label for="">420</label> Hours
                                </div>
                            </div>
                        </div>
                        <div class="WeeklyReflectionRecord">
                            <div class="ReflectionRecordTitle">
                                <h1>Weekly Reflection</h1>
                            </div>
                            <div class="RecordTable"></div>
                        </div>
                    </div>
                </div>

                <div class="InternLogBook">
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
                </div>

                <div class="LogBookRecord">

                </div>
            </div>
        </div>
</body>

</html>