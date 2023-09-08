<!DOCTYPE html>
<html lang="english">

<head>
  <title>Notification</title>
  <meta property="og:title" content="Notification" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }
  </style>
  <style>
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);
    }
  </style>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
  <link rel="stylesheet" href="/src/users/standard-user/raise-ticket/style.css" />
  <link href="notification.css" rel="stylesheet" />
</head>

<body>
  <div class="bg">
    <!-- load Header -->
    <div id="headerContainer"></div>
    <script src="loadHeader.js"></script>

    <div class = "contxt" >
      <div class="pageName">
        <h1>Notifications</h1>
      </div>

      <div class="notifications-container">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

        // FIXED user_id (WILL BASED ON SESSION LATER)
        //$user_id = 'TP065210'; //user_id FOR TESTING
        $user_id = 'TP064985'; //user_id FOR TESTING
        
        $query = "SELECT * FROM ticket_t WHERE user_id = '$user_id' ORDER BY tic_id DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $ticId = $row['tic_id'];
          $openDate = $row['tic_open_date'];
          $ticStatus = $row['tic_status'];

          echo '<div class="wrapper">';
          echo '<div class="content">';
          echo '<img src="/src/users/standard-user/notification/assets/notiBell.png">';
          echo "<b>Your ticket #$ticId issued on $openDate is now: $ticStatus.</b>";
          echo '<br><br>';

          if ($ticStatus === "Pending") {
            echo "<span class='small-text grey-text'>$openDate</span>";
          } elseif ($ticStatus === "Pending (Taken)" || $ticStatus === "Solved") {
            echo "<span class='small-text grey-text'>" . date("Y-m-d H:i:s") . "</span>";
          }
          echo '</div>';
          echo '</div>';
        }
        mysqli_close($conn);
        ?>
      </div>
    </div>

  <!-- load Footer -->
  <div id="footerContainer"></div>
  <script src="loadFooter.js"></script>

</body>

</html>