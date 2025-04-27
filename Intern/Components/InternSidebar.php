<?php
// Remove the duplicate session_start() if it's already called in the parent file
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Correct the path to db_connect.php based on your file structure
require_once __DIR__ . '/../../db_connect.php';
$current_page = basename($_SERVER['PHP_SELF']);

// Check if user is logged in
if (!isset($_SESSION['ojt_id'])) {
  // Redirect to login if not logged in
  header('Location: /DICT-FRONTEND/index.php');
  exit();
}

$ojt_id = $_SESSION['ojt_id'];

// Fetch user data from database
$personalData = [];
$statusData = [];

try {
  // Fetch personal data
  $personalSql = "SELECT * FROM OJT_TABLE_PERSONAL_DATA WHERE OJT_ID = ?";
  $personalParams = array($ojt_id);
  $personalStmt = sqlsrv_query($conn, $personalSql, $personalParams);

  if ($personalStmt === false) {
    throw new Exception(print_r(sqlsrv_errors(), true));
  }

  $personalData = sqlsrv_fetch_array($personalStmt, SQLSRV_FETCH_ASSOC);
  sqlsrv_free_stmt($personalStmt);

  // Set default image path if not found
  $profileImage = $personalData['Profile_Image_Path'] ?? '/DICT-FRONTEND/profile_pictures/profiledefault.jpg';

} catch (Exception $e) {
  // Handle errors gracefully
  error_log("Database error: " . $e->getMessage());
  $profileImage = '/DICT-FRONTEND/profile_pictures/profiledefault.jpg';
  $personalData = ['First_Name' => '', 'Middle_Initial' => '', 'Last_Name' => ''];
}
?>


<div class="BackgroundSidebar">
  <div class="MarginSidebar">
    <label for="" id="OJT_ID"></label>
    <div class="AdminLogo">
      <img
        src="<?php echo htmlspecialchars($personalData['Profile_Image_Path'] ?? '/DICT-FRONTEND/profile_pictures/profiledefault.jpg'); ?>" " alt="
        Profile" id="ProfileImage">
      <label class="UserName" id="FullName"> <?php
      echo htmlspecialchars($personalData['First_Name'] ?? '') . ' ' .
        htmlspecialchars($personalData['Middle_Initial'] ?? '') . ' ' .
        htmlspecialchars($personalData['Last_Name'] ?? '');
      ?>
      </label></label>
    </div>
    <div class="dividerSidebar"></div>
    <div class="ButtonSeparator">
      <div class="ButtonUpperSidebar">
        <a href="Intern_Dashboard.php" class="<?php echo $current_page === 'Intern_Dashboard.php' ? 'active' : ''; ?>">
          <button>
            <svg width="30" height="30" fill="#0a66ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M19 5v2h-4V5h4ZM9 5v6H5V5h4Zm10 8v6h-4v-6h4ZM9 17v2H5v-2h4ZM21 3h-8v6h8V3ZM11 3H3v10h8V3Zm10 8h-8v10h8V11Zm-10 4H3v6h8v-6Z">
              </path>
            </svg><span>DASHBOARD</span>
          </button>
        </a>
        <a href="Profile.php" class="<?php echo $current_page === 'Profile.php' ? 'active' : ''; ?>">
          <button>
            <svg width="30" height="30" fill="#0a66ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 15.375a4.125 4.125 0 1 0 0-8.25 4.125 4.125 0 0 0 0 8.25Z"></path>
              <path
                d="M12 2.25A9.75 9.75 0 1 0 21.75 12 9.769 9.769 0 0 0 12 2.25Zm6.169 15.225a7.624 7.624 0 0 0-2.297-2.156 5.597 5.597 0 0 1-7.744 0 7.622 7.622 0 0 0-2.297 2.156 8.25 8.25 0 1 1 12.338 0Z">
              </path>
            </svg><span>PROFILE</span>
          </button>
        </a>
        <a href="Log_Book.php" class="<?php echo $current_page === 'Log_Book.php' ? 'active' : ''; ?>">
          <button>
            <svg width="30" height="30" fill="none" stroke="#0a66ff" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M20.5 5h-14v17h14V5Z"></path>
              <path d="M17.5 5V2H4a.5.5 0 0 0-.5.5V19h3"></path>
              <path d="M10.5 11h6"></path>
              <path d="M10.5 15h6"></path>
            </svg><span>LOG BOOK</span>
          </button>
        </a>
        <a href="Weekly_Reflection.php"
          class="<?php echo $current_page === 'Weekly_Reflection.php' ? 'active' : ''; ?>">
          <button>
            <svg width="30" height="30" fill="none" stroke="#0a66ff" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 3v18h13V3H2Z"></path>
              <path d="M6 21V3"></path>
              <path d="M22 3h-4v16l2 2 2-2V3Z"></path>
              <path d="M18 6h4"></path>
              <path d="M15 3H2"></path>
              <path d="M15 21H2"></path>
              <path d="M18 3v8"></path>
              <path d="M22 3v8"></path>
            </svg><span>WEEKLY REFLECTION</span>
          </button>
        </a>
      </div>
      <div class="ButtonSignOut">
        <a href="../index.php">
          <button>
            <svg width="30" height="30" fill="#0a66ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                d="m17 8-1.41 1.41L17.17 11H9v2h8.17l-1.58 1.58L17 16l4-4-4-4ZM5 5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h7v-2H5V5Z">
              </path>
            </svg>SIGN OUT
          </button>
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  * {
    margin: 0;
    padding: 0;
    font-family: "Segoe UI History", Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
  }

  /* Active state now on the anchor tag */
  .ButtonUpperSidebar a.active button {
    background-color: #428aff;
    color: #fbfbfb;
    border: 1px solid #fbfbfb;
  }

  /* SVG fill for active buttons (1st and 2nd buttons) */
  .ButtonUpperSidebar a.active:nth-child(1) button svg,
  .ButtonUpperSidebar a.active:nth-child(2) button svg {
    fill: #fbfbfb;
  }

  /* SVG stroke for active buttons (3rd and 4th buttons) */
  .ButtonUpperSidebar a.active:nth-child(3) button svg,
  .ButtonUpperSidebar a.active:nth-child(4) button svg {
    stroke: #fbfbfb;
  }

  .ButtonSignOut a,
  .ButtonUpperSidebar a {
    text-decoration: none;
  }

  .BackgroundSidebar {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 350px;
    background: linear-gradient(180deg,
        rgba(8, 102, 255, 1) 0%,
        rgba(8, 102, 255, 1) 50%,
        rgba(5, 71, 178, 1) 100%);
    z-index: 40;
  }

  .MarginSidebar {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    width: 100%;
    margin: 30px 30px 50px 30px;
    z-index: 40;
  }

  .AdminLogo {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fbfbfb;
    font-size: 24px;
    font-weight: 500;
    width: 100%;
    gap: 5px;
  }

  .AdminLogo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
  }

  .UserName {
    text-align: center;
    font-size: 18px;
    font-weight: 400;
    color: #fbfbfb;
  }

  .UserCouser {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 500;
    color: #fbfbfb;
    width: 100%;

  }

  .dividerSidebar {
    width: 80%;
    height: 3px;
    margin-top: 20px;
    background-color: #fbfbfb;
    border-radius: 100px;
  }

  .ButtonSeparator button,
  .ButtonSeparator button svg {
    transition: all 0.3s ease-in-out;
  }

  .ButtonSeparator {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
  }

  /* Hover states */
  .ButtonSeparator a:hover button {
    background-color: #428aff;
    color: #fbfbfb;
    border: 1px solid #fbfbfb;
  }

  .ButtonSeparator a:hover:nth-child(1) button svg,
  .ButtonSeparator a:hover:nth-child(2) button svg {
    fill: #fbfbfb;
  }

  .ButtonSeparator a:hover:nth-child(3) button svg,
  .ButtonSeparator a:hover:nth-child(4) button svg {
    stroke: #fbfbfb;
  }

  .ButtonSignOut button:hover {
    background-color: #428aff;
    color: #fbfbfb;
    border: 1px solid #fbfbfb;
  }

  .ButtonSignOut a:hover button svg {
    fill: #fbfbfb;
  }


  .ButtonUpperSidebar {
    display: flex;
    flex-direction: column;
    height: auto;
    margin-top: 30px;
    gap: 15px;
  }

  .ButtonUpperSidebar button {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    background-color: #fbfbfb;
    color: #0a66ff;
    width: 290px;
    height: 60px;
    border: 0;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
  }

  .ButtonUpperSidebar svg {
    position: absolute;
    margin-left: 20px;
    left: 30px;
  }

  .ButtonSignOut {
    display: flex;
    justify-content: center;
    align-items: end;
    height: 100%;
    width: 100%;
  }

  .ButtonSignOut button {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    background-color: #fbfbfb;
    color: #0a66ff;
    width: 290px;
    height: 60px;
    border: 0;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
  }

  .ButtonSignOut svg {
    position: absolute;
    margin-left: 20px;
    left: 30px;
  }


  @media screen and (max-width: 1440px) {
    .BackgroundSidebar {
      width: 300px;
    }

    .MarginSidebar {
      margin: 35px 20px 35px 20px;
    }



    .divider {
      width: 80%;
      height: 2px;
      margin-top: 10px;
    }


    .ButtonUpperSidebar {
      display: flex;
      flex-direction: column;
      height: auto;
      margin-top: 20px;
      gap: 10px;
    }

    .ButtonUpperSidebar button {
      width: 250px;
      height: 50px;

      border-radius: 8px;
      font-size: 15px;
      font-weight: 500;
    }

    .ButtonUpperSidebar svg {
      position: absolute;
      margin-left: 20px;
      left: 30px;
    }

    .ButtonSignOut {
      display: flex;
      justify-content: center;
      align-items: end;
      height: 100%;
      width: 100%;
    }

    .ButtonSignOut button {

      width: 250px;
      height: 50px;

      border-radius: 8px;
      font-size: 15px;
      font-weight: 500;

    }

    .ButtonSignOut svg {
      position: absolute;
      margin-left: 20px;
      left: 30px;
    }

    .ButtonSignOut svg {
      width: 25px;
      height: 25px;
    }

    .ButtonUpperSidebar svg {
      width: 25px;
      height: 25px;
    }
  }
</style>