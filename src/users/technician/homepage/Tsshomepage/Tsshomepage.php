<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Homepage</title>
  <meta property="og:title" content="TssHomepage" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <!-- <link rel="stylesheet" href="globals.css" />
  <link rel="stylesheet" href="style.css" /> -->
  <link rel="stylesheet" href="tssHomepage.css" />
</head>

<body>

  <!--<div class = bg>
    load Header
    <div id="headerContainer"></div>
    <script src="TaTssLoadHeader.js"></script>

    load Footer
    <div id="footerContainer"></div>
    <script src="TssLoadFooter.js"></script>
    </div>-->


  <?php
  $result = mysqli_query($conn, "SELECT * FROM technician_t WHERE tech_id = '$_SESSION[userID]'");
  $row = mysqli_fetch_array($result);

  ?>
  <div class="homepage">
    <div class="greeting">
      <h2>WELCOME BACK,
        <?= strtoupper($row["tech_first_name"]) ?>
      </h2>
    </div>
    <div id="action-container">
      <div class="row">
        <div class="column">
          <a href="/src/users/technician/rounding/pending_ticket.php">
            <div class="overlap-2">
              <div class="pendingTicketText">Pending Tickets</div>
              <img class="pendingTicketImg" src="/src/assets/Logos/pending ticket.png" />
            </div>
          </a>
        </div>
        <div class="column">
          <a href="/src/users/technician/ticket/all_ticket_history.php">
            <div class="ticket-history">
              <div class="overlap-2">
                <div class="ticketHistoryText">Ticket History</div>
                <img class="ticketHistoryImg" src="/src/assets/Logos/ticket history.png" />
              </div>
            </div>
          </a>
        </div>
        <div class="column">
          <a href="/src/users/technician/rounding/view_layout_home.php">
            <div class="view-lab-layout">
              <div class="overlap-2">
                <div class="viewLabLayoutText">View Lab Layout</div>
                <img class="viewLabLayoutImg" src="/src/assets/Logos/view lab layout.png" />
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="column">
          <a href="/src/users/standard-user/raise-ticket/submitTicket.php">
            <div class="raise-ticket">
              <div class="overlap-2">
                <div class="raiseTicketText">Raise Ticket</div>
                <img class="raiseTicketImg" src="/src/assets/Logos/raise ticket.png" />
              </div>
            </div>
          </a>
        </div>

        <div class="column">
          <a href="/src/users/technician/register/RegisterAccountUser.html">
            <div class="register-client">
              <div class="overlap-2">
                <div class="registerClientText">Register Account (Student/Lecturer)</div>
                <img class="registerAccountImg" src="/src/assets/Logos/register account.png" />
              </div>
            </div>
          </a>
        </div>

        <div class="column">
          <a href="/src/users/technician/register/RegisterAccountTechnician.html">
            <div class="resgiter-TA">
              <div class="overlap-2">
                <div class="registerTAText">Register Account (Technical Staff)</div>
                <img class="registerAccountImg" src="/src/assets/Logos/register account.png" />
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
</body>

</html>