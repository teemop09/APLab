<!DOCTYPE html>
<html lang="english">
<head>
  <title>Submit ticket</title>
  <meta property="og:title" content="submitTicket" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />

  <style data-tag="reset-style-sheet">
    html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
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
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
  />
  <link rel="stylesheet" href="./style.css" />
  <link href="submitTicket.css" rel="stylesheet" />
</head>

<body>
    <div class="bg">
        <!-- load Header -->
        <div id="headerContainer"></div>
        <script src="loadHeader.js"></script>

        <!-- load Footer -->
        <div id="footerContainer"></div>
        <script src="loadFooter.js"></script>


        <!-- NEW CREATE FORM START HERE -->
        <form method="post" action="submitTicketToDB.php" onsubmit="setDateTime()">
            <span class="submit-ticket-report-an-issue">
                <span>Report An Issue</span>
            </span>
            <span class="submit-ticket-indicates-a-required-field">
                <span class="required-text">*</span>
                <span>indicates a required field</span>
            </span>
            <span class="submit-ticket-submitted-by">
                <span class="submit-ticket-text03">Submitted By</span>
                <span class="required-text">*</span>
            </span>
            <span class="submit-ticket-alternative-email">
                <span>Alternative Email</span>
            </span>
            <span class="submit-ticket-subject">
                <span class="submit-ticket-text07">Subject</span>
                <span class="required-text">*</span>
            </span>
            <span class="submit-ticket-describe-the-problem">
                <span class="submit-ticket-text08">Describe the Problem</span>
                <span class="required-text">*</span>
            </span>
            <span class="submit-ticket-computer-location">
                <span class="submit-ticket-text09">Computer Location</span>
                <span class="required-text">*</span>
            </span>
            <span class="submit-ticket-computer-id-name">
                <span class="submit-ticket-text10">Computer ID / Name</span>
                <span class="required-text">*</span>
            </span>

            <!-- Form inputs -->
            <input type="text" name="user_id" class="submit-ticket-user-id-input" required>
            <!-- FIX user ID AFTER INCLUDE session -->
            <input type="email" name="alt_email_address" class="submit-ticket-alter-email-input" placeholder="  e.g. personal email address">
            <input type="text" name="subject" class="submit-ticket-subject-input" placeholder="  e.g. PC is not booting up / PC freezes randomly" required>
            <textarea name="problem_description" class="submit-ticket-problem-input" placeholder="  e.g. Please provide as much detail as possible regrading your inquiry so we can best provide you the most accurate assistance." required></textarea>
            <select name="techlab_id" id="labSelection" class="submit-ticket-location-input" required>
                <option value="">Please select</option>
                <!-- Get lab name from db -->
                <?php include 'fetchLabName.php'; ?>
            </select>

   
            <!-- Input field and "Mark the Computer" button -->
            <input type="hidden" name="computer_id" id="computerId" class="submit-ticket-comp-name-input" required>
            <button id="markComputerButton" type="button" onclick="openOverlay()" class="submit-ticket-comp-name-input">Mark the Computer</button>

            <!-- Overlay MAP LAYOUT HERE? -->
            <div id="overlay" class="overlay">
              <div class="overlay-content">
                  <div class="overlay-header">
                      <h3>Select Equipment Name</h3>
                      <button type="button" onclick="closeOverlay()">x</button>
                  </div>
                  <br>
                  <ul id="equipmentList">
                      <!-- Equipment names will be populated here using JavaScript -->
                  </ul>
              </div>
            </div>

            <!-- Submit and Reset buttons -->
            <div class="submit-ticket-submit-button">
                <button type="submit" class="submit-ticket-submit-box">
                    <img alt="submitBox" src="/src/users/standard-user/raise-ticket/assets/blueRect.png" class="submit-ticket-submit-img" />
                    <span class="submit-ticket-submit-text">SUBMIT</span>
                </button>
            </div>
            <div class="submit-ticket-cancel-button">
                <button type="reset" class="submit-ticket-cancel-box">
                    <img alt="ResetBox" src="/src/users/standard-user/raise-ticket/assets/whiteRect.png" class="submit-ticket-cancel-img" />
                    <span class="submit-ticket-cancel-text">CANCEL</span>
                </button>
            </div>

<script src="layoutOverlay.js"></script>
</body>
</html>
