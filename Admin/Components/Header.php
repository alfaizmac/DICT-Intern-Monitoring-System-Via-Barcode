<nav class="navbar">
  <ul class="nav-list">
    <button>Record</button>
    <button>Information</button>
    <div class="NotyBtm"><svg width="32" height="32" fill="#222" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M18 16v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2Zm-6 6c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2Zm-4-5h8v-6c0-2.48-1.51-4.5-4-4.5S8 8.52 8 11v6Z"
          clip-rule="evenodd"></path>
      </svg>
    </div>
  </ul>
</nav>

<style>
  * {
    margin: 0;
    padding: 0;
    font-family: "Segoe UI History", Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
  }

  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #fff;
    display: flex;
    justify-content: right;
    align-items: center;
    height: 60px;
    border-bottom: 1px solid #ccc;
  }

  .nav-list {
    display: flex;
    align-items: center;
    list-style-type: none;
    margin-right: 20px;
  }

  .nav-list button {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
    width: 130px;
    border: none;
    background-color: #fff;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
  }

  .nav-list button:hover {
    background-color: #428aff;
    color: #fff;
  }

  .nav-list .NotyBtm {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 50px;
    width: 50px;
    cursor: pointer;
    color: #fff;
    border-radius: 50%;
    margin: 3px;
    background-color: #d6d9dd;
    transition: all 0.3s ease-in-out;
  }

  .nav-list .NotyBtm:hover {
    background-color: #428aff;
  }

  .nav-list .NotyBtm:hover svg {
    fill: #fff;
  }

  .nav-list svg {
    height: 32px;
    width: 32px;
  }


  @media screen and (max-width: 1440px) {
    .navbar {
      height: 50px;
    }

    .nav-list {
      margin-right: 10px;
    }

    .nav-list button {
      height: 50px;
      width: 100px;
      font-size: 16px;
    }

    .nav-list .NotyBtm button {
      height: 50px;
      padding: 15px;
    }

    .nav-list .NotyBtm {
      height: 40px;
      width: 40px;
      cursor: pointer;
      margin: 3px;
      transition: all 0.3s ease-in-out;
    }

    .nav-list .NotyBtm:hover {
      background-color: #428aff;
    }
  }
</style>