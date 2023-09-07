<!DOCTYPE html>
<html>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

if (
    $_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_GET["lab"]) &&
    !empty($_GET["lab"])
) {
    $lab_name = $_GET["lab"];
} else {
    include $_SERVER["DOCUMENT_ROOT"] . "/src/users/technician/rounding/view_layout_home.php";
    return;
}
?>

<head>
    <title>Lab Layout</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./layout.css" />
    <script src="./importSvgHandler.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="bg">
        <!-- load Header -->
        <div id="headerContainer"></div>
        <script src="/src/users/technician/headerFooter/TaTssHeader/loadTaTssHeader.js"></script>


        <div id="site-name">PENDING TICKET</div>
        <div id="legend">
            <div class="legend-item">
                <div class="legend-color" style="background-color: #6ef0ff;"></div>
                <div class="legend-text">Solved</div>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background-color: #ff0000;"></div>
                <div class="legend-text">Error</div>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background-color: #ffff00;"></div>
                <div class="legend-text">Taken</div>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background-color: #c0a7ff;"></div>
                <div class="legend-text">Require Follow-up</div>
            </div>

        </div>
        <div id="layout-container">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-black md:text-5xl lg:text-6xl"
                id="lab-heading">
                <?= $lab_name ?>
            </h1>
            <object data="/src/components/layouts/<?= $lab_name ?>.php" type="image/svg+xml" id="lab-layout">
            </object>

            <div class="sidebar" id="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeSide()">&times;</a>
                <h2 id="pcIdDisplay" href="#"></h2>
                <div id="ticket-container">
                    <h3 id="pending-ticket" style="display:none">Pending Tickets</h3>
                    <div class="ticket-list" id="pending-ticket-list">
                    </div>
                    <h3 id="past-ticket" style="display:none">Past Tickets</h3>
                    <div class="ticket-list" id="past-ticket-list">
                    </div>
                    <h3 id="no-info" style="display:none">No Ticket</h3>
                </div>
            </div>
        </div>
        <!-- load Footer -->
        <div id="footerContainer"></div>
        <script src="/src/users/technician/headerFooter/TaFooter/loadTAfooter.js"></script>
    </div>
</body>

</html>