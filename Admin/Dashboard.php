<?php
require_once __DIR__ . '../includes/auth_check.php';
validateAdminSession();

session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: /DICT-MANAGEMENT/');
  exit;
}

// Check user type (admin only for this dashboard)
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
  header("Location: /DICT-MANAGEMENT/");
  exit();
}

// Include components after session check
include 'Components/Header.php';
include 'Components/Sidebar.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/Dashboard.css" />
  <link rel="stylesheet" href="CSS/All_Page.css" />
  <title>Document</title>
</head>

<body>
  <div class="PageMargin">
    <div class="ContainerTop">
      <div class="ContainerLeft">
        <div class="HeaderContainer">
          <div class="Logo">
            <img src="../img/DICT-logo.png" alt="logo" />
          </div>
          <div class="TitleTexts">
            <h1>Welcome to the DICT,</h1>
            <h2>SARGEN DCT Apprentice Monitoring</h2>
            <p>
              You have full control over the OJT system. Manage logs,
              monitor apprentice
              progress, and oversee guest entries efficiently.
            </p>
          </div>
        </div>
        <div class="TotalContainers">
          <div class="TotalApprentice">
            <div class="TotalTitleText">Total Apprentice</div>
            <div class="TotalNumber">
              <svg width="48" height="48" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1h2Z">
                </path>
              </svg>
              <span id="">69</span>
            </div>
          </div>
          <div class="TotalOnline">
            <div class="TotalTitleText">Total Online</div>
            <div class="TotalNumber">
              <svg width="48" height="48" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1h2Z">
                </path>
              </svg>
              <span id="">42</span>
            </div>
          </div>
          <div class="TotalOffline">
            <div class="TotalTitleText">Total Offline</div>
            <div class="TotalNumber">
              <svg width="48" height="48" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1h2Z">
                </path>
              </svg>
              <span id="">27</span>
            </div>
          </div>
        </div>
      </div>
      <div class="ContainerRight">
        <div class="InventoryMargin">
          <div class="TitleInventory">
            <svg width="32" height="32" fill="none" stroke="#222" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1Z"></path>
              <path d="M8.975 12.004h6"></path>
              <path d="m3 6.5 3.5-4h11l3.5 4"></path>
            </svg>
            <span>Inventory</span>
          </div>
          <div class="TotalItemsContainer">
            <div class="ComputerHarderWare">
              <div class="margin">
                <div class="TitleName">
                  <svg width="36" height="36" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4 16h16V5H4v11Zm9 2v2h4v2H7v-2h4v-2H2.992A1 1 0 0 1 2 16.993V4.007C2 3.451 2.455 3 2.992 3h18.016c.548 0 .992.449.992 1.007v12.986c0 .556-.455 1.007-.992 1.007H13Z">
                    </path>
                  </svg>
                  <span>Computer Hardware</span>
                </div>
                <div class="TitleTotal"><span id="">420</span></div>
              </div>
            </div>
            <div class="NetworkingEquipment">
              <div class="margin">
                <div class="TitleName">
                  <svg width="36" height="36" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.364 18.364A9 9 0 1 0 5.635 5.636a9 9 0 0 0 12.729 12.728Z"></path>
                    <path d="M21 12H3"></path>
                    <path d="M12 21c-1.657 0-3-4.03-3-9s1.343-9 3-9"></path>
                    <path d="M12 21c1.657 0 3-4.03 3-9s-1.343-9-3-9"></path>
                  </svg>
                  <span>Networking Equipment</span>
                </div>
                <div class="TitleTotal"><span id="">420</span></div>
              </div>
            </div>
            <div class="Accessories">
              <div class="margin">
                <div class="TitleName">
                  <svg width="36" height="36" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 13H6a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2Z"></path>
                    <path d="M18 13h-1a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2Z"></path>
                    <path d="M4 15v-3a8 8 0 1 1 16 0v3"></path>
                  </svg>
                  <span id="">Peripherals & Accessories</span>
                </div>
                <div class="TitleTotal"><span id="">420</span></div>
              </div>
            </div>
            <div class="Furniture">
              <div class="margin">
                <div class="TitleName">
                  <svg width="36" height="36" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17 10c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H7c-1.1 0-2 .9-2 2v3c0 1.1.9 2 2 2h1v2H7c-1.1 0-2 .9-2 2v7h2v-3h10v3h2v-7c0-1.1-.9-2-2-2h-1v-2h1ZM7 8V5h10v3H7Zm10 8H7v-2h10v2Zm-3-4h-4v-2h4v2Z">
                    </path>
                  </svg>
                  <span id="">Furniture & Other Essentails</span>
                </div>
                <div class="TitleTotal"><span id="">420</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="ContainerBtm">
      <div class="ContainerBtmMargin">
        <div class="TitleStatus">
          <svg width="36" height="36" fill="none" stroke="#316efa" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17 20h5v-2a3 3 0 0 0-5.356-1.857"></path>
            <path d="M7 20h10v-2a4.982 4.982 0 0 0-2.196-4.141A5.002 5.002 0 0 0 7 17.999v2Z"></path>
            <path d="M7.356 16.143A3 3 0 0 0 2 18v2h5"></path>
            <path d="M20.414 11.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
            <path d="M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
            <path d="M6.414 11.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
          </svg>
          <span>Apprentice Status</span>
        </div>
        <div class="SearchbarContainer">
          <div class="SearchBar">
            <svg width="28" height="28" fill="none" stroke="#0866ff" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"></path>
              <path d="m21 21-6-6"></path>
            </svg>
            <input type="text" placeholder="Search name..." />
          </div>
        </div>
        <div class="TableDisplayStatus"></div>
      </div>
    </div>
  </div>
</body>

</html>