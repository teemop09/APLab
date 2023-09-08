<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';
?>

<!DOCTYPE html>
<html lang="english">

<head>
    <title>Submit ticket</title>
    <meta property="og:title" content="submitTicket" />
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
    <link rel="stylesheet" href="/src/users/standard-user/raise-ticket/style.css"/>
    <link rel="stylesheet" href="./layout.css" />
    <link href="submitTicket.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
<div class="bg">
        <!-- load Header -->
        <div id="headerContainer"></div>
        <script src="loadHeader.js"></script>

        <p class="st-top">SUBMIT A NEW TICKET</p>

        <!-- NEW CREATE FORM START HERE -->
        <form method="post" action="submitTicketToDB.php" onsubmit="setDateTime()" class="flex-column">

            <div class="st-title flex-row">
                <p class="st-header">Report An Issue</p>
                <p><span class="red">*</span> indicates a required field</p>
            </div>

            <div class="flex-row form-container">
                <div class="flex-column input-labels">
                    <div class="short-labels">
                        <p class="">Submitted By
                            <span class="red">*</span>
                        </p>
                    </div>
                    <div class="short-labels">
                        <p>Alternative Email</p>
                    </div>
                    <div class="short-labels">
                        <p class="">Subject <span class="red">*</span></p>
                    </div>
                    <div class="tall-labels">
                        <p class="">Describe the Problem <span class="red">*</span></p>
                    </div>
                    <div class="short-labels">
                        <p class="">Computer Location <span class="red">*</span></p>
                    </div>
                    <div class="short-labels">
                        <p class="">Computer ID / Name <span class="red">*</span></p>
                    </div>
                </div>

                <div class="flex-column input-fields">

                    <!-- Form inputs -->
                    <div class="short-labels">
                        <input type="text" name="user_id" required>
                    </div>
                    <div class="short-labels">
                        <!-- FIX user ID AFTER INCLUDE session -->
                        <input type="email" name="alt_email_address" placeholder="e.g. personal email address">
                    </div>
                    <div class="short-labels">
                        <input type="text" name="subject" placeholder="e.g. PC is not booting up / PC freezes randomly" required>
                    </div>
                    <div class="tall-labels">
                        <textarea name="problem_description" placeholder="e.g. Please provide as much detail as possible regrading your inquiry so we can best provide you the most accurate assistance." required></textarea>

                    </div>
                    <div class="short-labels">
                        <select name="techlab_id" id="labSelection" required>
                            <option value="">Please select</option>
                            <!-- Get lab name from db -->
                            <?php include 'fetchLabName.php'; ?>
                        </select>
                    </div>
                    <div class="short-labels">
                        <!-- Input field and "Mark the Computer" button -->
                        <input type="hidden" name="computer_id" id="computerId" class="submit-ticket-comp-name-input" required>
                        <button id="markComputerButton" type="button" onclick="openOverlay()" class="submit-ticket-comp-name-input mark-button">Mark a Computer</button>

                        <!-- Overlay MAP LAYOUT HERE? -->
                        <div id="overlay" class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-header">
                                    <h3 id="lab-layout-name"></h3>
                                    <button type="button" onclick="closeOverlay()">X</button>
                                </div>

                                <object data="" type="image/svg+xml" id="lab-layout">
                                </object>
                                <div class="overlay-bottom">
                                    <button id="overlay-cancel" type="button" onclick="closeOverlay()">Cancel</button>
                                    <button id="overlay-confirm" type="button" onclick="closeOverlay()">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


            <!-- Submit and Reset buttons -->
            <div class="flex-row button-box">

                <button type="submit" class="submit">
                    SUBMIT
                </button>

                <button type="reset" class="cancel">
                    CANCEL
                </button>

            </div>
        </form>

        <!-- load Footer -->
        <div id="footerContainer"></div>
        <script src="loadFooter.js"></script>

        <script src="layoutOverlay.js"></script>
</body>

</html>