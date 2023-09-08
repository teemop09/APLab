<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

?>
<!DOCTYPE html>
<html lang="english">

<head>
  <title>Homepage</title>
  <meta property="og:title" content="userHomepage" />
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
  <link rel="stylesheet" href="./style.css" />
  <link href="userHomepage.css" rel="stylesheet" />
</head>

<body>
  <div class="bg">
    <!-- load Header -->
    <div id="headerContainer"></div>
    <script src="/src/users/standard-user/headerFooter/loadHeader.js"></script>

    <!-- load Footer -->
    <div id="footerContainer"></div>
    <script src="/src/users/standard-user/headerFooter/loadFooter.js"></script>

    <div class="user-homepage-homepage">

      <!-- SUBMIT TICKET -->
      <a href="/src/users/standard-user/raise-ticket/submitTicket.php" target="_top"
        class="user-homepage-submit-ticket-container button">
        <div class="user-homepage-submit-box">
          <img alt="submitIcon" src="/src/assets/header-footer/submitTicket.png" class="user-homepage-submit-icon" />
          <span class="user-homepage-submit-text">Submit a New Ticket</span>
        </div>
      </a>

      <!-- CHECK TICKET (checkTicket.html WILL LINK HERE) -->
      <a href="/src/users/standard-user/ticket/client_ticket_history.php" target="_top"
        class="user-homepage-check-ticket-container button">
        <div class="user-homepage-check-box">
          <img alt="checkIcon" src="/src/assets/header-footer/checkTicket.png" class="user-homepage-check-icon" />
          <span class="user-homepage-check-text">Check Ticket Status</span>
        </div>
      </a>
    </div>

    <img alt="ticketPortal" src="/src/assets/header-footer/ticketPortal.png"
      class="user-homepage-aplab-ticket-portal" />
  </div>
</body>

</html>