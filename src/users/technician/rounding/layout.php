<!DOCTYPE html>
<html>

<head>
    <title>Lab Layout</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./layout.css" />
    <script src="./layout.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div id="mySidebar" class="sidebar">

    </div>
    <div id="content">
        <figure id=lab-layout-figure>
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1082 1408">
                <title>lab-layout-illustrator</title>
                <image width="100%" height="100%" xlink:href="./assets/Lab%20layout.png" />
                <g class="map-marker" data-id="2">
                    <path id="Shape" class="cls-1"
                        d="M188.55,235.94c15.71,0,28.45,11.47,28.45,25.61,0,23.09-28.45,47.55-28.45,47.55s-28.45-24.26-28.45-47.55C160.1,247.41,172.84,235.94,188.55,235.94Z" />
                    <circle id="Oval" class="cls-2" cx="188.55" cy="264.39" r="14.22" />
                </g>
            </svg>
        </figure>
    </div>


    </div>

    <div class="sidebar" id="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeSide()">&times;</a>
        <a id="pcIdDisplay" href="#">hello</a>
        <h2>Open Tickets</h2>

        <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');
        $sql = "SELECT `tic_id`, `tic_description`, `tic_priority`, `tic_status`, `tic_open_date`, `tic_close_date` FROM `ticket_t` WHERE tic_status = 'open'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ticket_element = "<a href='#' class='bg-slate-500' data-id='" . $row["tic_id"] . "'>" . $row["tic_description"] . "</a>";
                echo $ticket_element;
            }
        } else {
            echo "<a>No ticket entries</a>";
        }
        $conn->close();
        ?>

        <!-- <a href="#">Assignment</a>
        <a href="#">is</a>
        <a href="#">da best</a> -->
    </div>
</body>

</html>