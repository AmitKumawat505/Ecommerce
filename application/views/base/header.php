
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'base.css' ?>">
  <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'common.css' ?>">
  <style>
    button#myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 20px;
      border: none;
      outline: none;
      background-color: #ff0000e6;
      color: white;
      cursor: pointer;
      padding: 12px 15px;
      border-radius: 4px;
    }

    button#myBtn:hover {
      background-color: #e06666;
    }
  </style>
  <script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      var mybutton = document.getElementById("myBtn");
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }

    function closePopup() {
      document.getElementById("popup").style.display = "none";
    }

    // When the user clicks anywhere outside of the popup, close it
    window.onclick = function(event) {
      if (event.target == popup)
        closePopup();
    }

    var isViewUser = false;

    let searchProduct = () => {

      var text = document.getElementById("search").value;
      window.location = "http://localhost/web-programming-e-commerce/?url=filter/findName/" + text;
    }

    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

    function handle(e) {
      if (e.keyCode === 13) {
        e.preventDefault(); // Ensure it is only this code that runs
        searchProduct();
      }
    }
  </script>
</head>

<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top"> &uarr;</button>
  <div style="margin:25px" id="header">

    <nav id="not-response">
      <div class="menu">
        <div class="dropdown"><button class="dropbtn" onclick="window.location='?url=home/view'">Home</button></div>
        <div class="dropdown">
          <button class="dropbtn" onclick="window.location='?url=category/view/top'">Top</button>
          <div class="dropdown-content">
            <a href="?url=category/view/top/shirt">Shirt</a>
            <a href="?url=category/view/top/t-shirt">T-Shirt</a>
            <a href="?url=category/view/top/coat">Coat</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="dropbtn" onclick="window.location='?url=category/view/bottom'">Bottom</button>
          <div class="dropdown-content">
            <a href="?url=category/view/bottom/jeans">Jean</a>
            <a href="?url=category/view/bottom/short">Short</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="dropbtn"><a href="?url=category/view/shoes">Shoes</a></button>

        </div>
      </div>
      <div><img src="<?php echo PATH_URL_IMG_LOGO . "logo.png" ?>" alt="logo" height=150 width=150 /></div>

      <div class="right">
        <div style="margin-right:10px;display: flex"><input class="search-input" placeholder="Search product" id="search" onkeypress="handle(event)" />
          <button class="btn-search" onclick="searchProduct()">Search</button>
        </div>
        <div style="margin-right:15px;display:flex">

          <a href="?url=cart/view"> <img src="<?php echo PATH_URL_IMG_LOGO . "cart.svg"; ?>" width=40 height=40 style="margin-right:15px" /></a>
          <div style=" display: flex;
    justify-content: space-around;">
            <?php if (isset($_SESSION['username'])) : ?>
              <!-- Login -->
              <div class="dropdown">
                <img src="<?php echo PATH_URL_IMG_LOGO . "user.svg"; ?>" class="fa fa-user tooltip" width=40 height=40 />
                <div class="dropdown-content user">
                  <p id="username-header"><?php echo $_SESSION['username']; ?></p>
                  <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) : ?>
                    <a href="?url=admin/manage">Manage</a>
                  <?php endif ?>
                  <a href="?url=cart/history">History</a>
                  <a href="?url=user/logout">Logout</a>
                </div>
              </div>
              <div class="tooltiptext" id="tooltip" style="display:none">

                <ul>
                  <li style="margin-bottom:10px"><?php echo $_SESSION['username']; ?></li>
                  <li style="cursor:pointer" onclick="window.location='?url=user/logout/'">Log out</li>
                </ul>
              </div>
            <?php else : ?>
              <!-- Not logged in -->
              <a href="?url=user/login" class="color-green">Login</a>
              <a href="?url=user/signup" class="color-green">Signup</a>
            <?php endif ?>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div id="popup" class="popup">
    <div class="popup-content">
      <div class="popup-header">
        <span id="close-btn" onclick="closePopup()">&times;</span>
        <h2 id="inner-header"></h2>
      </div>
      <div class="popup-body">
        <p id="response"></p>
      </div>
    </div>

  </div>
</body>
