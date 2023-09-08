<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';
?>

<!DOCTYPE html>
<html lang="english">

<head>
  <title>Homepage</title>
  <meta property="og:title" content="TAHomepage" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <link rel="stylesheet" href="globals.css" />
  <link rel="stylesheet" href="style.css" />
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

  <div class="HOMEPAGE">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM technician_t");
    $row = mysqli_fetch_array($result);
    ?>

    <?php
    echo '<div class="welcome">';
    echo 'WELCOME BACK, ' . $row['tech_first_name'] . '!';
    ?>

    <!-- dk path -->
    <a href="">
      <div class="raiseTicket">
        <div class="mainMenu">Raise Ticket</div>
        <img class="raiseTicketImg" src="/src/assets/Logos/raise ticket.png" />
    </a>
  </div>

  <a href="/ticket/all_ticket_history.php">
    <div class="ticketHistory">
      <div class="mainMenu">Ticket History</div>
      <img class="ticketHistoryImg" src="/src/assets/Logos/ticket history.png" />
    </div>
  </a>

  <a href="/rounding/view_layout_home.php">
    <div class="viewLabLayout">
      <div class="mainMenu">View Lab Layout</div>
      <img class="viewLabLayoutImg" src="/src/assets/Logos/view lab layout.png" />
    </div>
  </a>

  <a href="/ticket/ticket_to_pending.php">
    <div class="pendingTicket">
      <div class="mainMenu">Pending Ticket</div>
      <img class="pendingTicketImg" src="/src/assets/Logos/pending ticket.png" />
    </div>
  </a>

  </div>
  
</body>

</html>