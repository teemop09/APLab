<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';
?>

<!DOCTYPE html>
<html lang="english">

<head>
  <title>Homepage</title>
  <meta property="og:title" content="TAHomepage" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <!-- <link rel="stylesheet" href="globals.css" /> -->
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <link rel="stylesheet" href="/src/users/technician/homepage/TAhomepage/taHomepage.css" />
</head>

<body>
  <!--<div class = bg>
     load Header
    <div id="headerContainer"></div>
    <script src="TaTssLoadHeader.js"></script>

    load Footer
    <div id="footerContainer"></div>
    <script src="TaLoadFooter.js"></script>
    </div>-->

  <?php
  $result = mysqli_query($conn, "SELECT * FROM technician_t");
  $row = mysqli_fetch_array($result);

  ?>
  <div class="homepage">
    <div class="greeting">
      <h2>WELCOME BACK,
        <?= strtoupper($row["tech_first_name"]) ?>
      </h2>
    </div>
    <div id="action-container" class="horizontal-menu">
      <!-- dk path -->
      <a href="/src/users/standard-user/raise-ticket/submitTicket.php">
        <div class="raiseTicket mainMenu">
          <div class="">Raise Ticket</div>
          <img class="raiseTicketImg" src="/src/assets/Logos/raise ticket.png" />
        </div>
      </a>

      <a href="/src/users/technician/ticket/ta_ticket_history.php">
        <div class="ticketHistory mainMenu">
          <div class="">Ticket History</div>
          <img class="ticketHistoryImg" src="/src/assets/Logos/ticket history.png" />
        </div>
      </a>

      <a href="/src/users/technician/rounding/view_layout_home.php">
        <div class="viewLabLayout mainMenu">
          <div class="">View Lab Layout</div>
          <img class="viewLabLayoutImg" src="/src/assets/Logos/view lab layout.png" />
        </div>
      </a>

      <a href="/src/users/technician/rounding/pending_ticket.php">
        <div class="pendingTicket mainMenu">
          <div class="">Pending Ticket</div>
          <img class="pendingTicketImg" src="/src/assets/Logos/pending ticket.png" />
        </div>
      </a>
    </div>
  </div>


</html>